<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tweets}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $text
 * @property string $image
 * @property string $publish_timestamp
 *
 * @property User $user
 */
class Tweets extends \yii\db\ActiveRecord
{
    const IMAGE_DIR='../../frontend/web/images/';
    //const IMAGE_DIR='../../../../images/';
    const IMAGE_PATH='/images/';

    const TWEET_MODE_UNKNOWN = 0;
    const TWEET_MODE_TEXT = 1;
    const TWEET_MODE_IMAGE = 2;
    const TWEET_MODE_TEXTIMAGE = self::TWEET_MODE_TEXT & self::TWEET_MODE_IMAGE;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tweets}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['text'], 'string'],
            [['publish_timestamp'], 'safe'],
            [['image'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'text' => 'Text',
            'image' => 'Image',
            'publish_timestamp' => 'Publish Timestamp',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return null|string image directory if exist
     */
    public static function getImageDir()
    {
        if(!is_dir(self::IMAGE_DIR))
        {
            if (!mkdir(self::IMAGE_DIR))
            {
                return null;
            }
        }
        return self::IMAGE_DIR;
    }

    public function getContent()
    {
        $result = new \stdClass();
        $result->id = $this->id;
        $result->mode = 0;
        $result->publish_timestamp = $this->publish_timestamp;
        $result->published_by = $this->user->username;

        if($this->image)
        {
            $result->image = $this->image;
            $result->mode |= self::TWEET_MODE_IMAGE;
        }

        if($this->text)
        {
            $result->text = $this->text;
            $result->mode |= self::TWEET_MODE_TEXT;
        }
        return $result;
    }
}

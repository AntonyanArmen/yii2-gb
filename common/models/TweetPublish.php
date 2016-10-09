<?php

namespace common\models;

use common\models\Tweets;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 *
 */
class TweetPublish extends Model
{
    public $text;
    public $image;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['image'], 'string','max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'text' => 'Текст твита',
            'image' => 'Картинка',
        ];
    }

    public function createTweet()
    {
        if (!$this->validate())
        {
            return null;
        }
        $tweet = new Tweets();
        $tweet->text = $this->text;
        $tweet->image = $this->image;
        $tweet->user_id = Yii::$app->user->id;
        return $tweet->save() ? $tweet : null;
    }

    /**
     * @param $picture UploadedFile
     * @return null|string saved path
     */
    public static function uploadImage($picture)
    {
        $picture_filename = Tweets::getImageDir();
        if(!$picture_filename)
        {
            return null;
        }
        $picture_filename .= $picture->name;

        if ($picture->saveAs($picture_filename))
        {
            return Tweets::IMAGE_PATH . $picture->name;
        }
        else
        {
            return null;
        }
    }
}

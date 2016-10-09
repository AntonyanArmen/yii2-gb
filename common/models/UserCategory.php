<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%userCategory}}".
 *
 * @property integer $id
 * @property integer $value
 * @property string $description
 *
 * @property User[] $users
 */
class UserCategory extends \yii\db\ActiveRecord
{
    protected static $Admin = null, $User =null;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%userCategory}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value'], 'required'],
            [['value'], 'integer'],
            [['description'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value' => 'Value',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['category_id' => 'id']);
    }

    /**
     * @return UserCategory
     */
    public static function getAdmin()
    {
        if (self::$Admin === null)
        {
            self::$Admin = self::findOne(['description' => 'Admin']);
        }
        return self::$Admin;
    }

    /**
     * @return UserCategory
     */
    public static function getUser()
    {
        if (self::$User === null)
        {
            self::$User= self::findOne(['description' => 'User']);
        }
        return self::$User;
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property string $username
 * @property string $firstname
 * @property string $surnamename
 * @property string $patronymic
 * @property string $password
 * @property string $phone
 * @property string $email
 *
 * @property WorkingShift[] $workingShifts
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */

    public $password_repeat = null;

    public static function tableName()
    {
        return 'user';
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }

    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public function getId()
    {
        return $this->username;
    }

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'firstname', 'surname', 'patronymic', 'phone', 'password', 'email'], 'required'],
            [['phone'], 'string', 'max' => 20],
            [['username', 'firstname', 'surname', 'patronymic', 'password'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 100],
            [['email'], 'email'],
            [['username'], 'unique'],
            [['password'], 'string', 'min' => 6],
            [['password_repeat'], 'compare', 'compareAttribute' => 'password'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'firstname' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'phone' => 'Телефон',
            'password' => 'Пароль',
            'email' => 'Почта',
            'password_repeat' => 'Повторите пароль'
        ];
    }

    /**
     * Gets query for [[WorkingShifts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorkingShifts()
    {
        return $this->hasMany(WorkingShift::class, ['user_id' => 'id']);
    }
}
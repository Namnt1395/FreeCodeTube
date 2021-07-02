<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "admins".
 *
 * @property int $user_id
 * @property string|null $avatar
 * @property string|null $full_name
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string|null $mobile
 * @property string|null $birthday
 * @property string|null $address
 * @property string $role ADMIN | USER
 * @property int|null $change_pass_time
 * @property int $status
 * @property int $created_at
 * @property int $created_by
 * @property int|null $modified_at
 * @property int|null $modified_by
 */
class Admin extends ActiveRecord implements IdentityInterface
{

    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @var mixed|null
     */

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admins';
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'avatar' => 'Avatar',
            'full_name' => 'Full Name',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'mobile' => 'Mobile',
            'birthday' => 'Birthday',
            'address' => 'Address',
            'role' => 'Role',
            'change_pass_time' => 'Change Pass Time',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'modified_at' => 'Modified At',
            'modified_by' => 'Modified By',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['user_id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }


    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }
}

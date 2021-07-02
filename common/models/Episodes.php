<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "episodes".
 *
 * @property int $id
 * @property int $film_id Id của film
 * @property string $name
 * @property string $name_slug
 * @property int|null $size Size video(bytes)
 * @property int|null $part Số phần
 * @property int $type_audio 1: dub, 2 :sub, 3: raw
 * @property int|null $order_admin
 * @property int $status 0:offline, 1: online
 * @property string|null $description Mô tả
 * @property int $created_at Thời gian tạo
 * @property int|null $updated_at Thời gian update
 */
class Episodes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'episodes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['film_id', 'name', 'name_slug', 'status', 'created_at'], 'required'],
            [['film_id', 'size', 'part', 'type_audio', 'order_admin', 'status', 'created_at', 'updated_at'], 'integer'],
            [['description'], 'string'],
            [['name', 'name_slug'], 'string', 'max' => 255],
            [['film_id', 'name_slug'], 'unique', 'targetAttribute' => ['film_id', 'name_slug']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'film_id' => 'Film ID',
            'name' => 'Name',
            'name_slug' => 'Name Slug',
            'size' => 'Size',
            'part' => 'Part',
            'type_audio' => 'Type Audio',
            'order_admin' => 'Order Admin',
            'status' => 'Status',
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return EpisodesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EpisodesQuery(get_called_class());
    }
}

<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "films".
 *
 * @property int $id
 * @property string $name
 * @property string $name_slug slug
 * @property string|null $name_other
 * @property int|null $total_episode Số tập
 * @property string $thumbnail Link ảnh thumbnail
 * @property int|null $view Số view
 * @property int|null $released Năm xuất bản
 * @property int $ongoing 1: đang làm, 2 đã kết thúc
 * @property string|null $description Mô tả
 * @property int $status 0: offline, 1: online
 * @property int|null $created_at Thời gian tạo
 * @property int|null $updated_at Thời gian update
 */
class Films extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'films';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'name_slug', 'thumbnail', 'ongoing'], 'required'],
            [['total_episode', 'view', 'released', 'ongoing', 'status', 'created_at', 'updated_at'], 'integer'],
            [['description'], 'string'],
            [['name', 'name_slug', 'thumbnail'], 'string', 'max' => 255],
            [['name_other'], 'string', 'max' => 2047],
            [['name_slug'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'name_slug' => 'Name Slug',
            'name_other' => 'Name Other',
            'total_episode' => 'Total Episode',
            'thumbnail' => 'Thumbnail',
            'view' => 'View',
            'released' => 'Released',
            'ongoing' => 'Ongoing',
            'description' => 'Description',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return FilmsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FilmsQuery(get_called_class());
    }
}

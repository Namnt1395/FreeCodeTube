<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "videos".
 *
 * @property int $id
 * @property int $episode_id id của tập
 * @property int $server_store Server lưu trữ: 1: google driver, 2...
 * @property string|null $driver_id Id video khi upload file lên server store
 * @property string|null $driver_id_new
 * @property string|null $driver_origin_id
 * @property string|null $driver_preload_id
 * @property string|null $driver_preload_new
 * @property string|null $user_upload tài khoản dùng để upload
 * @property string $link_origin
 * @property string|null $resolution Độ phân giải
 * @property int|null $size bytes
 * @property string|null $ip Ip của server tạo ra video
 * @property int|null $convert_hls không còn sử dụng
 * @property int $is_download 1: chưa tải xuống, 2: đã xong; 3: lỗi; 4: trên local, chờ upload
 * @property int $processing 1:chưa xử lý, 2: đang xử lý: 3: đã xong
 * @property int $is_hls 1: chưa xử lý; 2: đang xử lý; 3: đã xong(áp dụng với video google)
 * @property int $is_preload 1: chưa xử lý, 2: đang xử lý, 3 : done
 * @property int|null $is_meta 1:pending, 2: process; 3: done
 * @property int $sync_aer 1: chưa đồng bộ, 2: đã đồng bộ
 * @property int $created_at Thời gian tạo
 * @property int|null $updated_at Thời gian update
 */
class Video extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'videos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['episode_id', 'server_store', 'link_origin', 'created_at'], 'required'],
            [['episode_id', 'server_store', 'size', 'convert_hls', 'is_download', 'processing', 'is_hls', 'is_preload', 'is_meta', 'sync_aer', 'created_at', 'updated_at'], 'integer'],
            [['driver_id', 'driver_id_new', 'driver_origin_id', 'driver_preload_id', 'driver_preload_new'], 'string', 'max' => 255],
            [['user_upload'], 'string', 'max' => 100],
            [['link_origin'], 'string', 'max' => 2047],
            [['resolution'], 'string', 'max' => 50],
            [['ip'], 'string', 'max' => 31],
            [['episode_id', 'server_store'], 'unique', 'targetAttribute' => ['episode_id', 'server_store']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'episode_id' => 'Episode ID',
            'server_store' => 'Server Store',
            'driver_id' => 'Driver ID',
            'driver_id_new' => 'Driver Id New',
            'driver_origin_id' => 'Driver Origin ID',
            'driver_preload_id' => 'Driver Preload ID',
            'driver_preload_new' => 'Driver Preload New',
            'user_upload' => 'User Upload',
            'link_origin' => 'Link Origin',
            'resolution' => 'Resolution',
            'size' => 'Size',
            'ip' => 'Ip',
            'convert_hls' => 'Convert Hls',
            'is_download' => 'Is Download',
            'processing' => 'Processing',
            'is_hls' => 'Is Hls',
            'is_preload' => 'Is Preload',
            'is_meta' => 'Is Meta',
            'sync_aer' => 'Sync Aer',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\VideoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\VideoQuery(get_called_class());
    }

    public function getLinkEpisode($episodeId)
    {
        return "https://stream1.7anime.cc/api/watch?episode_id=" . $episodeId . "&key=84043fb63277515";
    }
}

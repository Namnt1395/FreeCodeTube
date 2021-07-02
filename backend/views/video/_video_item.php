<?php
/** @var $model \common\models\Video */

use yii\helpers\StringHelper;
use yii\helpers\Url;

?>

<div>
    <a href="<?php echo Url::to(['video/update', 'id' => $model->id]) ?>">
        <div class="embed-responsive embed-responsive-16by9 mb-3">
            <video class="embed-responsive-item"
                   src="<?php echo $model->getLinkEpisode($model->episode_id) ?>" controls></video>
        </div>
    </a>

<!--    <div class="media-body">-->
<!--        <h5 class="mt-0">--><?php //echo $model->na ?><!--</h5>-->
<!--        <p>--><?php //echo StringHelper::truncateWords($model->description, 10) ?><!--</p>-->
<!--    </div>-->
</div>
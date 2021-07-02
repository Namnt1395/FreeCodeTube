<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Episodes]].
 *
 * @see Episodes
 */
class EpisodesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Episodes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Episodes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

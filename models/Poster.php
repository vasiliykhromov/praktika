<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "poster".
 *
 * @property int $id_poster
 * @property int $name
 * @property int $tickets
 *
 * @property Orders[] $orders
 */
class Poster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'poster';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'tickets'], 'required'],
            [['name', 'tickets'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_poster' => 'Id Poster',
            'name' => 'Наименование',
            'tickets' => 'Количество билетов',
        ];
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::class, ['id_poster' => 'id_poster']);
    }
}

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Poster $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Афиша', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="poster-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- <p>
        <?= Html::a('Update', ['update', 'id_poster' => $model->id_poster], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_poster' => $model->id_poster], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p> -->

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id_poster',
            'name',
            'tickets',
            [
                'format' => 'raw',
                'label' => 'Заказать',
                'value' => function ($model) {
                    return Html::beginForm(['/poster/order', 'post'])
                        . Html::hiddenInput('id_poster', $model->id_poster)
                        . Html::textInput('tickets', 0)
                    . Html::submitButton(
                        'Заказать билеты',
                    )
                    . Html::endForm();
                }
            ]
        ],
    ]) ?>

</div>

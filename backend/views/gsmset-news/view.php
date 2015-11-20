<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\GsmsetNews */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Gsmset News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gsmset-news-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title:ntext',
            'notice:ntext',
            'message:ntext',
            'date',
            'first',
            'published',
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\GsmsetPage */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Gsmset Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gsmset-page-view">

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
            'category_id',
            'title',
            'slug',
            'meta_desc',
            'meta_key',
            'img',
            'anounce:ntext',
            'full_text:ntext',
            'created_at',
            'updated_at',
            'enabled',
            'tags',
        ],
    ]) ?>

</div>

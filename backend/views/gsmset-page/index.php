<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\GsmsetPageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gsmset Pages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gsmset-page-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Gsmset Page', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'category_id',
            'title',
            'slug',
            'meta_desc',
            // 'meta_key',
            // 'img',
            // 'anounce:ntext',
            // 'full_text:ntext',
            // 'created_at',
            // 'updated_at',
            // 'enabled',
            // 'tags',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\GsmsetNewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gsmset News';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gsmset-news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Gsmset News', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title:ntext',
            'notice:ntext',
            'message:ntext',
            'date',
            // 'first',
            // 'published',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

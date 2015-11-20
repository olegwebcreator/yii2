<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\GsmsetNews */

$this->title = 'Create Gsmset News';
$this->params['breadcrumbs'][] = ['label' => 'Gsmset News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gsmset-news-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

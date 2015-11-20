<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\GsmsetPage */

$this->title = 'Update Gsmset Page: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Gsmset Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gsmset-page-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

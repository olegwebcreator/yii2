<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\GsmsetPageCategory */

$this->title = 'Update Gsmset Page Category: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Gsmset Page Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gsmset-page-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

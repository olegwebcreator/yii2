<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\GsmsetPage */

$this->title = 'Create Gsmset Page';
$this->params['breadcrumbs'][] = ['label' => 'Gsmset Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gsmset-page-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
/* @var $this yii\web\View */
/* @var $model common\models\GsmsetNews */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gsmset-news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'notice')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'message')->widget(CKEditor::className(),[
	        	'editorOptions' => [
		        	'rows' => 6,
	        		'preset' => 'full',
	        		'language' => 'ru',
	        		'inline' => false,
					
				]
			]) ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'first')->textInput() ?>

    <?= $form->field($model, 'published')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

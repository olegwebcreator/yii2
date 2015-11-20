<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
/* @var $this yii\web\View */
/* @var $model common\models\GsmsetPage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gsmset-page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_id')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_desc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'img')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'anounce')->widget(CKEditor::className(),[
	        	'editorOptions' => [
		        	'rows' => 6,
	        		'preset' => 'full',
	        		'language' => 'ru',
	        		'inline' => false,
					
				]
			]) ?>


    <?= $form->field($model, 'full_text')->widget(CKEditor::className(),[
	        	'editorOptions' => [
		        	'rows' => 6,
	        		'preset' => 'full',
	        		'language' => 'ru',
	        		'inline' => false,
					
				]
			]) ?>


    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'enabled')->textInput() ?>

    <?= $form->field($model, 'tags')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

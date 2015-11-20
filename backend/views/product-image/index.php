<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Products;
use common\models\UpdateImages;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductImageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $form backend\models\MultipleUploadForm */

$this->title = $searchModel->model;
$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['/gsmset-catalog-products']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="image-index">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
    <table class="table table-stripped">
	    <tr>
	    	<td>Модель</td><td><?=$searchModel->model?></td>
    	</tr>
    	<tr>
	    	<td>ID</td><td><?=$searchModel->product_id?></td>
    	</tr>
    	<tr>
		    <td>UID</td><td><?=$searchModel->uid?></td>
    	</tr>
    	<tr>
		    <td>Картинка</td><td><?=Html::img($searchModel->getUrl(),['class'=>'preview']);?></td>
    	</tr>
    	
    	
    </table>
    <?php $form = ActiveForm::begin();?>
    
	    <?= $form->field($updateForm, 'update')->checkbox()->label('Синхронизация картинок и каталога?'); ?>
	    <div class="form-group">
	        <?= Html::submitButton('Обновить', ['class' => 'btn btn-primary']) ?>
	    </div>

	<?php ActiveForm::end(); ?>
	<?=$searchModel->checked?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	
    <?php if ($searchModel->product_id) : ?>
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

            <?= $form->field($uploadForm, 'files[]')->fileInput(['multiple' => true]) ?>

            <button class="btn btn-primary">Добавить фото</button>
        <?php ActiveForm::end() ?>
    <?php endif ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'product_id',
            'uid',
            [
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    /** @var $model common\models\ProductImage */
                    return Html::img($model->getUrl(),['class'=>'preview']);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
            ],
        ],
    ]); ?>

</div>

<?php
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Markdown;
?>
<?php /** @var $model \common\models\GsmsetCatalogProducts */ ?>
	
	<div class="well col-md-12 card">
		
   		<?php 
	   		
		
	
	   		$images = $model->images;
	   		
	   		if (isset($images[0])) {
            	//echo Html::img($images[0]->getUrl(), ['class' => 'img-responsive  preview pull-left']);            
        	 	   			
				Modal::begin([
		   			"header" => "<h2 class='title'>".Html::encode($model->model)."</h2>",
		   			'toggleButton' => [
				        'tag' => 'img',
				        'class' => 'img-responsive preview pull-left',
				        'src' => $images[0]->getUrl(),
				    ]
		   		]);
	
		   		echo Html::img($images[0]->getUrl(), ['class' => 'img-responsive']);
	
		   		Modal::end();
	   		
	   		} else {
		   		echo "<img src='/img/no-photo2.jpg' class='img-responsive  preview pull-left no-pointer'>";
	   		}
   		?>
   		<a href='<?=$model->link?>'><h5><?= Html::encode($model->model) ?></h5></a>
   		<hr>
        			<?= Markdown::process($model->uid) ?>
		<div class='pull-right'>	
			<div class="price"><?=round($model->price,0)?><span class="currency"> руб.</span> </div>
			<div><?= Html::a('Купить', ['cart/add', 'id' => $model->id], ['class' => 'btn btn-danger'])?></div>
		</div>
    </div>

<?php
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Markdown;

	/* @var $this yii\web\View */

	$images = $post->images;

?>

						<h1><?=$post->model?></h1>
						<?php
										
										if ($post) {
											$this->params['breadcrumbs'][] = ['label' => 'Каталог '.Yii::$app->name, 'url' => ['/catalog/list']];
											$this->params['breadcrumbs'][] = ['label' => $post->category, 'url' => ['#']];
											$this->params['breadcrumbs'][] = $post->model;
											//echo "<pre>";
											//	print_r( $post->getCategory());
											//echo "</pre>";
									?>
										<hr>
										<div class="row">
											<div class="col-md-6">
												<div class="news-title">артикул: <?=$post->uid;?></div>
												<div class="news-title">Категория: <?=$post->category;?></div>
												<div class="news-title">Цена: <?=round($post->price,0);?></div>
												<div class="news-title">Мелкий опт: <?=round($post->price_1,0);?></div>
												<div class="news-title">Средний опт: <?=round($post->price_2,0);?></div>
												<div class="news-title">Крупный опт: <?=round($post->price_3,0);?></div>
												<div class="news-body"></div>
												
											</div>
											<div class="col-md-6">
											<?php
												if (isset($images[0])) {
									            	//echo Html::img($images[0]->getUrl(), ['class' => 'img-responsive  preview pull-left']);            
									        	 	   			
													Modal::begin([
											   			"header" => "<h2 class='title'>".Html::encode($post->model)."</h2>",
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
									   			<div style="clear:both">	
													<div class="price"><?=round($post->price,0)?><span class="currency"> руб.</span> </div>
													<div><?= Html::a('Купить', ['cart/add', 'id' => $post->id], ['class' => 'btn btn-danger'])?></div>
												</div>
											</div>
										</div>

			<?php 
				
				}
			?>


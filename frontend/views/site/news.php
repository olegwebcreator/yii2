<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $model common\models\GsmsetNews */
/* @var $form ActiveForm */

$this->title = 'Новости '.Yii::$app->name;

$this->registerMetaTag([
	'name' => "description",
	'content' => 'Новости '.Yii::$app->name,
]);

$this->registerMetaTag([
	'name' => 'keywords',
	'content' => 'Новости '.Yii::$app->name,
]);

?>
			<?php
				
				if ($post) {
					$this->params['breadcrumbs'][] = ['label' => 'Новости '.Yii::$app->name, 'url' => ['/site/news']];
					$this->params['breadcrumbs'][] = $post->title;

			?>
				<hr>
				<div class="news-title"><?=$post->title;?></div>
				<div class="news-body"><?=$post->message;?></div>
			
			<?php 
				
				} else { 
				
			?>
			
				<hr>
				<div class="row">
					<div class="col-md-6">
						<strong>сортировка по:</strong>
					</div>
					<div class="col-md-6">
						<strong>отображать рубрики:</strong>
					</div>
				</div>
				
				<hr>
				
			<?php  
			
					$this->params['breadcrumbs'][] = $this->title;
					if (isset($posts)) {
						foreach ($posts as $post) { 
							if ($post->published == 1) { 			
								echo "<a class='title_news' href='".$post->link."'>".
									 "<div class='bg-info text-center'>".
									 $post->title.
									 "</div>".
									 "</a>".
									 "<span class='date'>дата создания: ".$post->date."</span>";
							}
						}  
					}
					
			?>
				<hr>
				
				<?=LinkPager::widget([
					'pagination'=>$pagination,
					'firstPageLabel' => '&laquo;',
					'lastPageLabel' => '&raquo;'	
				])?>
				
				<br>
				<span class="pager">Страница <?=$active_page?> из <?=$count_pages?></span>
			
			<?php 
				} 
			?>
		</div>	


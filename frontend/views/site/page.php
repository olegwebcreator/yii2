<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\ListView;
use yii\widgets\Menu;

/* @var $this yii\web\View */

?>
<div class="site">
	
	<?php
		
		if ($category) {
			$title = $category === null ? 'Каталог продукции' : $category->name;
			$this->title = Html::encode($title);
			$this->params['breadcrumbs'][] = $this->title;
	?>

			<h1><?= Html::encode($title) ?></h1>
			<span class="orange">Информация о наличии товара обновляется в реальном времени</span>
			
			<div class="container-fluid">
			  <div class="row">
			      <div class="col-xs-4">
			          
			      </div>
			      <div class="col-xs-8">
			          <?= ListView::widget([
			              'dataProvider' => $productsDataProvider,
			              'itemView' => '_product',
			          ]) ?>
			      </div>
			  </div>
			</div>
    <?php
				
			} elseif ($page) {
				
				echo "<h1 class='page-title'>".Html::encode($page->title)."</h1>".
					 "<hr>";
				
				if ($page->id == 7) { 
					$this->title = 'Карта сайта '.Yii::$app->name;
					$this->params['breadcrumbs'][] = $this->title;
						
					echo "<ul>";
						echo "<li>";
							echo "Главная";
							echo "<ul>";
								foreach ($pages as $page) {
									if ($page->category_id == 1) {
										echo "<li>".
										     	"<a href='".$page->link."'>".
											 		$page->title.
											    "</a>".
											 "</li>";
									}
								}
							echo "</ul>";
						echo "</li>";
					echo "</ul>";
					
				
				} else {	
					
					//$this->params['breadcrumbs'][] = ['label' => 'Карта сайта '.Yii::$app->name, 'url' => ['/site/page']];
					$this->params['breadcrumbs'][] = $page->title;

					echo "<div class='page-body'>".$page->full_text."</div>";
						
				} 
				
			} else { 
					
					if ($posts) {
						
						$this->title = 'Новости '.Yii::$app->name;
						$this->params['breadcrumbs'][] = $this->title;
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
						echo "<hr>";
				
						echo LinkPager::widget([
							'pagination'=>$pagination,
							'firstPageLabel' => '&laquo;',
							'lastPageLabel' => '&raquo;'	
							]);
				
						echo "<br>";
						echo "<span class='pager'>Страница ".$active_page." из ".$count_pages."</span>";
						
					} else {
						
						$this->title = 'Карта сайта '.Yii::$app->name;
						$this->params['breadcrumbs'][] = $this->title;

						echo "<h1 class='page-title'>".Html::encode($this->title)."</h1>".
							 "<hr>";
						echo "<ul>".
							 "<li>Главная</li>".
							 "<ul>";
			
								foreach ($pages as $page) {
									if ($page->category_id == 1) {
										echo "<li><a href='".$page->link."'>";
										echo $page->title;
										echo "</a>";
										echo "</li>";
									}
								}
					    echo "</ul>";
					}
			}
		?>
			<?php 
				
			?>
 
</div>

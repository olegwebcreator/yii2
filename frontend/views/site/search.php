<?php
	use yii\helpers\Html;
	use yii\widgets\LinkPager;

	/* @var $this yii\web\View */

	$this->title = "Поиск ".$q;
	
	$this->registerMetaTag([
		'name' => "description",
		'content' => "Поиск ".$q
	]);

	$this->registerMetaTag([
		'name' => 'keywords',
		'content' => "Поиск ".$q
	]);
?>

<?php 
	$this->title = "Поиск";
	$this->params['breadcrumbs'][] = $this->title;
	
	if ($q=="") { 
		echo "<h2>Вы задали пустой поисковый запрос</h2>";
	} else { 
		echo "<h2>Результаты поиска: ".$q."</h2>";
		
		if (!$posts) {
			echo "<p>Ничего не найдено</p>";
		} else {
			foreach ($posts as $post) {
				echo "<a href='".$post->link."'>";
				echo $post->model;
				echo "</a>";
				echo "<hr>";
			}
		}
	} 
?>
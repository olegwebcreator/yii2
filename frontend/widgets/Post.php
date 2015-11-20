<?php
	namespace frontend\widgets;
	use Yii;
	use yii\base\Widget;
	use yii\helpers\Html;
	use common\models\GsmsetNews;
	
	class Post extends Widget {
		public $id;
		
		public function run() {
			$query = GsmsetNews::find()->where(['published' => 1])->limit(10)->all();
			
			$title = Html::tag('h5', 'Новости '.Yii::$app->name);
			$date = new \DateTime();
			$monthes = [
				1 => 'Января',
				2 => 'Февраля',
				3 => 'Марта',
				4 => 'Апреля',
				5 => 'Мая',
				6 => 'Июня',
				7 => 'Июля',
				8 => 'Августа',
				9 => 'Сентября',
				10 => 'Октября',
				11 => 'Ноября',
				12 => 'Декабря'
			];
			
			$date = $date->format('d')." ".$monthes[$date->format('m')]." ".$date->format('Y');
			
			$date  = Html::tag('div', $date,  ['class'=>'date']);
			
			$link  = Yii::$app->urlManager->createUrl(['site/news']);
			
			$button = Html::tag('a','Все новости &raquo;',['href'=> $link, 'class' => 'pull-right btn btn-default btn-news']);	
					
			
			$post_block = $title.$date;
			
			foreach ($query as $post) {
				
				$a = Html::tag('a', $post->title,['href' => $post->link]);
				$post_block .= Html::tag('div',$a,['class'=>'news-title']);
				
			}
			$post_block .= $button;
			$post_block = Html::tag('div',$post_block,['class'=>'news-block']);
			
			return $post_block;
		}
	}
?>
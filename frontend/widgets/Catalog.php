<?php
	namespace frontend\widgets;
	use Yii;
	use yii\base\Widget;
	use yii\helpers\Html;
	use common\models\Category;
	
	class Catalog extends Widget {
		public $id;
		
		public function run() {
			$query = Category::find()->all();
			
			$title = Html::tag('h5', 'Каталог '.Yii::$app->name);
			$title = Html::tag('a', $title, ['href' => '/site/page?id=1']);
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
			
			$post_block = $title.$date;
			
			foreach ($query as $post) {
				
				$a = Html::tag('a', $post->name,['href' => $post->link]);
				$post_block .= Html::tag('div',$a,['class'=>'catalog-title']);
				
			}
			
			$post_block = Html::tag('div',$post_block,['class'=>'catalog-block']);
			
			return $post_block;
		}
	}
?>
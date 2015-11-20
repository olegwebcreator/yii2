<?php
	namespace frontend\widgets;
	use Yii;
	use yii\base\Widget;
	use yii\helpers\Html;
	use common\models\Product;
	
	class MainPageBrand extends Widget {
		public $id;
		
		public function run() {
			$query = Product::find()->groupBy('producer')->all();
			
			$title = Html::tag('h2', 'Каталог оборудования по производителям', ['class'=>'ttl']);
			$title = Html::tag('a', $title, ['href' => '/site/page?id=1']);
			
			$post_block = $title;
			
			foreach ($query as $post) {
				$a = Html::tag('a', $post->producer,['href' => '/catalog/brand?id='.$post->id]);
				$post_block .= Html::tag('span',$a)." | ";
				
			}
			
			$post_block = Html::tag('div',$post_block,['class'=>'row cat-wrapper']);
			
			return $post_block;
		}
	}
?>
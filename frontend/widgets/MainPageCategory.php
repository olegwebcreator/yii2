<?php
	namespace frontend\widgets;
	use Yii;
	use yii\base\Widget;
	use yii\helpers\Html;
	use common\models\Category;
	
	class MainPageCategory extends Widget {
		public $id;
		
		public function run() {
			$query = Category::find()->all();
			
			$title = Html::tag('h2', 'Каталог оборудования по рубрикам', ['class'=>'ttl']);
			$title = Html::tag('a', $title, ['href' => '/site/page?id=1']);
			
			$post_block = $title;
			
			foreach ($query as $post) {
				$a = Html::tag('a', $post->name,['href' => $post->link]);
				$post_block .= Html::tag('span',$a)." | ";
				
			}
			
			$post_block = Html::tag('div',$post_block,['class'=>'row cat-wrapper']);
			
			return $post_block;
		}
	}
?>
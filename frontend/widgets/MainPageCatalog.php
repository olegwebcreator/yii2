<?php
	namespace frontend\widgets;
	use Yii;
	use yii\base\Widget;
	use yii\helpers\Html;
	use common\models\Category;
	
	class MainPageCatalog extends Widget {
		public $id;
		
		public function run() {
			$query = Category::find()->limit(8)->all();
			
			$title = Html::tag('h2', 'Некоторые категории товаров для сотовых телефонов '.Yii::$app->name, ['class'=>'ttl']);
			$title = Html::tag('a', $title, ['href' => '/site/page?id=1']);
			
			$post_block = $title;
			
			foreach ($query as $post) {
				
				$images = $post->images;
				
		        if (isset($images[0])) {
		            $img = Html::img($images[0]->getUrl(), ['class' => 'img-responsive preview']);
		        } else {
			        $img = NULL;
		        }
				$a = Html::tag('a', $post->name.$img,['href' => $post->link]);
				$post_block .= Html::tag('div',$a,['class'=>'col-md-3 product']);
				
			}
			
			$post_block = Html::tag('div',$post_block,['class'=>'row cat-wrapper']);
			
			return $post_block;
		}
	}
?>
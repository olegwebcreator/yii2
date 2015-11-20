<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Menu;

/* @var $this yii\web\View */
$title = $category === null ? 'Каталог' : $category->name;
$this->title = Html::encode($title);
$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['/catalog/list']];
$this->params['breadcrumbs'][] = $this->title;

?>

<h1><?= Html::encode($title) ?></h1>
<?= ListView::widget([
              'dataProvider' => $productsDataProvider,
              'itemView' => '_product',
])?>

<?php /*
<div class="container-fluid">	
  <div class="row">
	  
      <div class="col-xs-4">
          <?= Menu::widget([
              'items' => $menuItems,
              'options' => [
                  'class' => 'menu',
              ],
          ]) ?>
      </div>
      <div class="col-xs-8">
          <?= ListView::widget([
              'dataProvider' => $productsDataProvider,
              'itemView' => '_product',
          ])?>
      </div>
     
  </div>
</div>
 */ ?>
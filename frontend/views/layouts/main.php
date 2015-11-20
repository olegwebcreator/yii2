<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\widgets\ActiveForm;
use frontend\assets\AppAsset;
use common\widgets\Alert;

use frontend\models\SearchForm;
use frontend\widgets\Post;
use frontend\widgets\Catalog;
use yii\widgets\ListView;
use yii\widgets\Menu;
$model = new SearchForm();

//use common\models\GsmsetPage;

AppAsset::register($this);

$action = Yii::$app->controller->action->id;
$actionId = NULL;
foreach (Yii::$app->controller->actionParams as $actionParams) {
	$actionId = $actionParams;
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
	
	<header>
		<div class="container">
		    <div class="row header-top">
	    		<div class="col-md-3 login">
		    		<div>Личный Кабинет</div>
		    		<hr>
		    		<?php 
			    		if (Yii::$app->user->isGuest) {
				    ?>
		    			<ul class="list-unstyled list-inline enterForm">
			    			<li><a class='btn btn-default' href='/site/login'>Вход</a></li>
			    			<li><a class='btn btn-default' href='/site/signup'>Регистрация</a></li>
			    		</ul>
					<?php			
						} else {
					?>
						<li><a data-method="post" href='/site/logout'>Выход (<?=Yii::$app->user->identity->username?>)</a></li>
					<?php
						}
					?>
						
	    		</div>	
					
				<div class="col-md-6 h_po_saitu_off">
				<?php 
					
					$form = ActiveForm::begin([
						'options' => ['class' => 'form-inline'],
					]);
				?>
				<?= $form->field($model, 'q')->textInput(['id' => 'search', 'class' => 'form-control', 'placeholder' => 'Поиск..'])->label('Поиск по сайту'); ?>
					<?= Html::submitButton('Искать', ['class' => 'btn btn-default btn-search']) ?>
				<?php ActiveForm::end();?>
				</div>
				<div class="col-md-3 cart">
					<div>Корзина</div>
		    		<hr>
		    			<?php 
			    			
			    			$itemsInCart = Yii::$app->cart->getCount();
			    			
			    			if ($itemsInCart) {
			    				echo "<a class='btn btn-default' href='/cart/list'>Товаров в корзине: " .$itemsInCart."</a>";
							} else {
								echo "<span class='btn btn-default'>Товаров в корзине нет</span>";
							}
							
						?>
		    			
					</div>
	    		</div>
				<div class="row header">
	    			<div class="col-md-12 banner">
		    			<a href="/">
		    				<img src="/images/header_banner.png" class="img-responsive" style="opacity:1;">
		    			</a>
	    			</div>
	    		</div>
	    	</div>
	    </header>

	    <?php
	    NavBar::begin([
	        'brandLabel' => Yii::$app->name,
	        'brandUrl' => Yii::$app->homeUrl,
	        'options' => [
	            'class' => 'navbar-inverse',
	        ],
	    ]);
	    
	    $menuItems[] = ['label' => '<span class="glyphicon glyphicon-home"></span>', 'url' => ['/site/index']];
	    
	    $pages = common\models\GsmsetPage::find()->indexBy('id')->orderBy('id')->all();
		
		foreach ($pages as $page) {
			    	if ($page->category_id == 1) {
			    	
			    		$menuItems [] = ['label' => $page->title, 'url' => [Yii::$app->urlManager->createUrl(["site/page","id"=>$page->id])]];
			    		
			    	}
		}
		
	    echo Nav::widget([
	        'options' => ['class' => 'navbar-nav navbar-right'],
	        'items' => $menuItems,
	        'encodeLabels' => false,
	    ]);
	    NavBar::end();
	    $post_id = NULL;
	    ?>

	    <div class="container">
		    <div class="row wrapper">
			    <div class="col-md-4">
				    <?php 
					    if ($action == 'list') {
						    echo Catalog::widget(['id' => $post_id]);
					    } elseif ($action == 'page' && $actionId == 1) {
						    echo Catalog::widget(['id' => $post_id]);
					    } elseif ($action == 'view') {
						    echo Catalog::widget(['id' => $post_id]);
					    } else {
						    echo Post::widget(['id' => $post_id]);
					    }
					    
					?>
				</div>
			    <div class="col-md-8">
					<?= Breadcrumbs::widget([
						'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
					]) ?>
					
					<?= Alert::widget() ?>
					<?= $content ?>
			    </div>
		    </div>
	    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<?php
use frontend\widgets\MainPageCatalog;
use frontend\widgets\MainPageCategory;
use frontend\widgets\MainPageBrand;
/* @var $this yii\web\View */
$post_id = NULL;
$this->title = 'My Yii Application';
?>
<div class="site-index">
    <h1>Интернет-магазин запчастей для сотовых телефонов</h1>


    <div class="body-content">
	    <div class="container-fluid" style="margin-top:-20px;">
			<?=MainPageCatalog::widget(['id' => $post_id]);?>
			<?=MainPageCategory::widget(['id' => $post_id]);?>
			<?=MainPageBrand::widget(['id' => $post_id]);?>
	    </div>
    </div>
    
</div>

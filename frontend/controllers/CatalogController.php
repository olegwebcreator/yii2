<?php

namespace frontend\controllers;
use Yii;
use common\models\Category;
use common\models\Product;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

class CatalogController extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            Url::remember();
            return true;
        } else {
            return false;
        }
    }

    public function actionList($id = null)
    {
        /** @var GsmsetCategory $category */
        $category = null;

        $categories = Category::find()->indexBy('id')->orderBy('id')->all();
        
        //$categories = GsmsetCategory::find()->indexBy('name')->orderBy('name')->all();

		$productsQuery = Product::find();        

        if ($id !== null && isset($categories[$id])) {
            $category = $categories[$id];
            //$productsQuery->where(['category_id' => $this->getCategoryIds($categories, $id)]);
            $productsQuery->where(['category' => $this->getCategoryNames($categories, $id)]);
            $productsQuery->andWhere(['published'=>'1']);
        } 

        $productsDataProvider = new ActiveDataProvider([
            'query' => $productsQuery,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('list', [
            'category' => $category,
            'menuItems' => $this->getMenuItems($categories, isset($category->id) ? $category->id : null),
            'productsDataProvider' => $productsDataProvider,
        ]);
    }
    
	public function actionBrand($id = null)
    {
    	/** @var GsmsetCatalogProducts $producer */
    	
        $product = null;
		$categories = Product::find()->indexBy('producer')->orderBy('producer')->all();
        return $this->render('brand', [
        	'product' => $product,  
       
        ]);
    }

    public function actionView()
    {
	    $model = new \common\models\Product();
	    
	    $post = $model::find()->where(['id' => Yii::$app->getRequest()->getQueryParam('id')])->one();
	    
	    return $this->render('view', [
	        'post' => $post,
	    ]);
	}

    /**
     * @param Category[] $categories
     * @param int $activeId
     * @param int $parent
     * @return array
     */
    private function getMenuItems($categories, $activeId = null, $parent = null)
    {
        $menuItems = [];
        foreach ($categories as $category) {
            if ($category->parent_id === $parent) {
                $menuItems[$category->id] = [
                    'active' => $activeId === $category->id,
                    'label' => $category->name,
                    'url' => ['catalog/list', 'id' => $category->id],
                    'items' => $this->getMenuItems($categories, $activeId, $category->id),
                ];
            }
        }
        return $menuItems;
    }


    /**
     * Returns IDs of category and all its sub-categories
     *
     * @param Category[] $categories all categories
     * @param int $categoryId id of category to start search with
     * @param array $categoryIds
     * @return array $categoryIds
     */
    private function getCategoryIds($categories, $categoryId, &$categoryIds = [])
    {
        foreach ($categories as $category) {
            if ($category->id == $categoryId) {
                $categoryIds[] = $category->id;
            }
            elseif ($category->parent_id == $categoryId){
                $this->getCategoryIds($categories, $category->id, $categoryIds);
            }
        }
        return $categoryIds;
    }
	private function getCategoryNames($categories, $categoryId, &$categoryIds = [])
    {
        foreach ($categories as $category) {
            if ($category->id == $categoryId) {
                $categoryNames[] = $category->name;
            }
        }
        return $categoryNames;
    }
	
}

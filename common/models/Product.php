<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yz\shoppingcart\CartPositionInterface;
use yz\shoppingcart\CartPositionTrait;

/**
 * This is the model class for table "gsmset_catalog_products".
 *
 * @property integer $id
 * @property integer $uid
 * @property integer $model
 * @property integer $category
 
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property integer $category_id
 * @property string $price
 *
 * @property ProductImage[] $images
 * @property Order[] $orderItems
 * @property Category $category
 */
class Product extends \yii\db\ActiveRecord implements CartPositionInterface
{
    use CartPositionTrait;

	public $link;
	public function afterFind() {
		$this->link    = Yii::$app->urlManager->createUrl(["/catalog/view","id"=>$this->id]);
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gsmset_catalog_products';
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'uid',
            ]
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
	        [['uid'], 		'integer'],
	        [['category'], 	'string'],
	        [['producer'], 	'string'],
	        [['model'], 	'string'],
	        [['price'], 	'number'],
	        [['price_1'], 	'number'],
	        [['price_2'], 	'number'],
	        [['price_3'], 	'number'],
	        [['id_status'], 'integer'],
	        [['count'], 	'integer'],
	        [['zag_information'], 	'string'],
	        [['information'], 	'string'],
	        [['published'], 	'integer'],
	        [['compability'], 	'string'],
            [['compabilityPN'], 	'string'],
            [['searchname'], 	'string'],
            [['datepost'], 	'string'],
            [['action'], 	'integer'],
            [['no_discount'], 	'integer'],
            [['main_id'], 	'integer'],
            [['original'], 	'integer'],
            [['description'], 'string'],
            [['category_id'], 'integer'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' 	   => 'ID',
            'uid' 	   => 'Штрих-код товара',
            'model'    => 'Наименование товара',
            'category' => 'Каталог (уровень 1)',
            'producer' => 'Каталог (уровень 2)',
            'price'    => 'Цена розничная',
            'price_1'    => 'Цена (опт2)',
            'price_2'    => 'Цена (опт3)',
            'price_3'    => 'Цена (опт1)',
            'title' => 'Title',
            'slug' => 'Slug',
            'description' => 'Description',
            'category_id' => 'Category ID',
            
        ];
    }

    /**
     * @return ProductImage[]
     */
    public function getImages()
    {
        return $this->hasMany(ProductImage::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(Order::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        //return $this->hasOne(Category::className(), ['id' => 'category_id']);
        return $this->hasOne(Category::className(), ['name' => 'category']);
    }

    /**
     * @inheritdoc
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }
}

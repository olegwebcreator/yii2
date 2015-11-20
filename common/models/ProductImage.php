<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "gsmset_catalog_product_image".
 *
 * @property integer $id
 * @property integer $product_id
 *
 * @property Products $product
 */
class ProductImage extends \yii\db\ActiveRecord
{
	public $model;
	public $checked;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gsmset_catalog_product_image';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'uid' => 'Product UID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getProductUid()
    {
        return $this->hasOne(Products::className(), ['uid' => 'uid']);
    }
    /**
     * @return string image hash
     */
    protected function getHash()
    {
        return md5($this->product_id . '-' . $this->id);
    }

    /**
     * @return string path to image file
     */
    public function getPath()
    {
        return Yii::getAlias('@frontend/web/img/' . $this->uid . '.jpg');
    }
    /*
    public function getPath()
    {
        return Yii::getAlias('@frontend/web/images/' . $this->getHash() . '.jpg');
    }
	*/
    /**
     * @return string URL of the image
     */
    
    public function getUrl()
    {
        return Yii::getAlias('http://yii2.local/img/' . $this->uid . '.jpg');
    }
    /*
    public function getUrl()
    {
        return Yii::getAlias('http://yii2.local/images/' . $this->getHash() . '.jpg');
    }
	*/
	
    public function afterDelete()
    {
        unlink($this->getPath());
        parent::afterDelete();
    }
}

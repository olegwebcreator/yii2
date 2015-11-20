<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%gsmset_page_category}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $title
 * @property string $slug
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $enabled
 *
 * @property GsmsetPage[] $gsmsetPages
 * @property GsmsetPageCategory $parent
 * @property GsmsetPageCategory[] $gsmsetPageCategories
 */
class GsmsetPageCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%gsmset_page_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'created_at', 'updated_at', 'enabled'], 'integer'],
            [['title', 'slug'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'enabled' => 'Enabled',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGsmsetPages()
    {
        return $this->hasMany(GsmsetPage::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(GsmsetPageCategory::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGsmsetPageCategories()
    {
        return $this->hasMany(GsmsetPageCategory::className(), ['parent_id' => 'id']);
    }
}

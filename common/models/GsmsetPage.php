<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\helpers\Html;
/**
 * This is the model class for table "{{%gsmset_page}}".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $title
 * @property string $slug
 * @property string $meta_desc
 * @property string $meta_key
 * @property string $img
 * @property string $anounce
 * @property string $full_text
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $enabled
 * @property string $tags
 *
 * @property GsmsetPageCategory $category
 */
class GsmsetPage extends \yii\db\ActiveRecord
{
	public $link;
	
	
	public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'slugAttribute' => 'slug'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%gsmset_page}}';
    }
    public function afterFind() {
		
		$monthes = [
			1  => 'Января',
			2  => 'Февраля',
			3  => 'Марта',
			4  => 'Апреля',
			5  => 'Мая',
			6  => 'Июня',
			7  => 'Июля',
			8  => 'Августа',
			9  => 'Сентября',
			10 => 'Октября',
			11 => 'Ноября',
			12 => 'Декабря'
		];
		
		$this->link    = Yii::$app->urlManager->createUrl(["site/page","id"=>$this->id]);
		$this->created_at    = date('j ', $this->created_at).$monthes[date('n', $this->created_at)].date(' Y', $this->created_at);
		$this->title   = $this->replaceContent($this->title);
		$this->full_text = $this->replaceContent($this->full_text);
	
	}
	
	public function replaceContent($text) {
		return $text;
	}
	public function setNumbers($posts) {
		$all_releases = GsmsetPage::find()->where(["enabled"=>1])->orderBy("created_at")->all();
		$number = 1;
		foreach ($all_releases as $release) {
			foreach ($posts as $post) {
				if ($post->id == $release->id) $post->number = $number;
			}
			$number++;
		}
	}


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'created_at', 'updated_at', 'enabled'], 'integer'],
            [['anounce', 'full_text'], 'string'],
            [['created_at'], 'default',  'value' => null],
            [['updated_at'], 'default',  'value' => null],
            [['enabled'],    'default',  'value' => 1],
            [['title', 'meta_desc', 'meta_key', 'img', 'tags', 'slug'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Раздел',
            'title' => 'Заголовок',
            'slug'  => 'Ссылка',
            'meta_desc' => 'Описание страницы',
            'meta_key' => 'Ключевые слова',
            'img' => 'Img',
            'anounce' => 'Краткое описание',
            'full_text' => 'Полный текст',
            'created_at' => 'Добавлено',
            'updated_at' => 'Обновлено',
            'enabled' => 'Включено',
            'tags' => 'Тэги',
            
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(GsmsetPageCategory::className(), ['id' => 'category_id']);
    }
}

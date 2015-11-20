<?php

namespace common\models;

use Yii;
use yii\helpers\Html;
/**
 * This is the model class for table "{{%gsmset_news}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $notice
 * @property string $message
 * @property string $date
 * @property integer $first
 * @property integer $published
 */
class GsmsetNews extends \yii\db\ActiveRecord
{
	public $number;
	public $img;
	public $link;
	
	public function scopes()
    {
        return array(
            'published'=>array(
                'condition'=>'t.published = 1',
            ),
        );
    }
    private $_url;
 
    public function getUrl()
    {
        if ($this->link === null)
            $this->link = Yii::app()->createUrl('/site/news', array('id'=>$this->id));
        return $this->link;
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
		
		$this->link    = Yii::$app->urlManager->createUrl(["/site/news","id"=>$this->id]);
		$this->date    = date('j ', $this->date).$monthes[date('n', $this->date)].date(' Y', $this->date);
		$this->title   = $this->replaceContent($this->title);
		$this->message = $this->replaceContent($this->message);
		$this->img     = "/images/news/".$this->img;
	
	}
	
	public function replaceContent($text) {
		return $text;
	}
	public function setNumbers($posts) {
		$all_releases = GsmsetNews::find()->where(["published"=>1])->orderBy("date")->all();
		$number = 1;
		foreach ($all_releases as $release) {
			foreach ($posts as $post) {
				if ($post->id == $release->id) $post->number = $number;
			}
			$number++;
		}
	}
	
	public $verifyCode;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%gsmset_news}}';
    }

    /**
     * @inheritdoc
     */
	public function rules()
    {
        return [
            [['title', 'notice', 'message'], 'required'],
            [['title', 'notice', 'message'], 'string'],
            [['date'], 'safe'],
            [['category_id'],    'default',  'value' => 4],
            [['first', 'published'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Раздел сайта',
            'title' => 'Заголовок новости',
            'notice' => 'Заметка',
            'message' => 'Новость',
            'date' => 'Дата',
            'first' => 'Отметить первой новостью',
            'published' => 'Опубликовать',
            'verifyCode' => 'Проверочный код',
        ];
    }
}

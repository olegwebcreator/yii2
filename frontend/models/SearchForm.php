<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * @property string $q
 */
class SearchForm extends Model
{
	public $q;
	
	public function rules() 
	{
			return [
				['q', 'string'],
			];
	}
}

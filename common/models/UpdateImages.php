<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class UpdateImages extends Model
{
    public $update;
	public function rules()
    {
        return [
            [['update'], 'required'],
        ];
    }
}

<?php


namespace backend\models;


use yii\base\Model;
use yii\web\UploadedFile;

class MultipleUploadForm extends Model
{
    /**
     * @var UploadedFile[] files uploaded
     */
    public $files;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['files'], 'file', 'extensions' => 'jpg, png', 'maxFiles' => 10, 'skipOnEmpty' => false],
        ];
    }
    public function upload()
    {
        if ($this->validate()) {
            $this->files->saveAs('@frontend/web/images/' . $this->files->baseName . '.' . $this->files->extension);
            return true;
        } else {
            return false;
        }
    }
}
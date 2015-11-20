<?php

namespace backend\controllers;

use backend\models\MultipleUploadForm;
use common\models\Category;
use Yii;
use common\models\CategoryImage;
use backend\models\CategoryImageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CategoryImageController implements the CRUD actions for CategoryImage model.
 */
class CategoryImageController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all CategoryImage models.
     * @param int $id category id
     * @return mixed
     *
     * @throws NotFoundHttpException
     */
    public function actionIndex($id)
    {
        if (!Category::find()->where(['id' => $id])->exists()) {
            throw new NotFoundHttpException();
        }

        $form = new MultipleUploadForm();

        $searchModel = new CategoryImageSearch();
        $searchModel->category_id = $id;

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (Yii::$app->request->isPost) {
            $form->files = UploadedFile::getInstances($form, 'files');

            if ($form->files && $form->validate()) {
                foreach ($form->files as $file) {
                    $image = new CategoryImage();
                    $image->category_id = $id;
                    if ($image->save()) {
                        $file->saveAs($image->getPath());
                    }
                }

            }
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'uploadForm' => $form,
        ]);
    }

    /**
     * Deletes an existing CategoryImage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $image = $this->findModel($id);
        $categoryId = $image->category_id;
        $image->delete();

        return $this->redirect(['index', 'id' => $categoryId]);
    }

    /**
     * Finds the CategoryImage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CategoryImage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CategoryImage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

<?php

namespace backend\controllers;

use backend\models\MultipleUploadForm;
use common\models\Category;
use common\models\Product;
use common\models\UpdateImages;
use Yii;
use common\models\ProductImage;
use backend\models\ProductImageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductImageController implements the CRUD actions for ProductImage model.
 */
class ProductImageController extends Controller
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
     * Lists all ProductImage models.
     * @param int $id product id
     * @return mixed
     *
     * @throws NotFoundHttpException
     */
    public function actionIndex($id)
    {
        if (!Product::find()->where(['id' => $id])->exists()) {
            throw new NotFoundHttpException();
        }

		$product  = Product::findOne($id);
		
		$dir = Yii::getAlias('@frontend/web/img/');
		$dirFiles = scandir($dir);
		$imgArray = array();
		
		foreach ($dirFiles as $file) {
			$imgArray[] = substr($file, 0, strpos($file, "."));
		}
		$updateImage = new UpdateImages;
		
		$update = 0;
		
		if ($updateImage->load(Yii::$app->request->post()) && $updateImage->validate()) {
	            // Синхронизация картинок
		
				$items = Product::find()->all();
				
				foreach ($items as $item) {
					foreach ($imgArray as $imgUid) {
						if ($imgUid == $item->uid) {
							$uploadImg = new ProductImage();
							$uploadImg->product_id = $item->id;
		                    $uploadImg->uid = $item->uid;
		                    $uploadImg->save();
						}
					}
				}
	    } else {
	            $update = 0;
	    }
		
		$searchModel = new ProductImageSearch();
        $searchModel->product_id = $id;
        
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		$searchModel->uid   = $product->uid;
		$searchModel->model = $product->model;
        $searchModel->checked = $update;
        
        $form = new MultipleUploadForm();
        
		
        if (Yii::$app->request->isPost) {
	        
            $form->files = UploadedFile::getInstances($form, 'files');

            if ($form->files && $form->validate()) {
                foreach ($form->files as $file) {
                    $image = new ProductImage();
                    $image->product_id = $id;
                    $image->uid = $product->uid;

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
            'update' => $update,
            'updateForm' => $updateImage
        ]);
    }

    /**
     * Deletes an existing ProductImage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $image = $this->findModel($id);
        $productId = $image->product_id;
        $image->delete();

        return $this->redirect(['index', 'id' => $productId]);
    }

    /**
     * Finds the ProductImage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductImage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductImage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

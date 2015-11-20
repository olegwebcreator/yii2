<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\SearchForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Category;
use common\models\Product;
use common\models\GsmsetNews;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\helpers\Url;
use yii\helpers\Html;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    public function beforeAction($action)
	    {
	        
	        if (parent::beforeAction($action)) {
	            Url::remember();
	            $model = new SearchForm();
			
			if ($model->load(Yii::$app->request->post()) && $model->validate())
			{
				$q = Html::encode($model->q);
				
				$this->redirect(Yii::$app->urlManager->createUrl(['/site/search', 'q' => $q ]));
			}
	           return true;
	           
	        } else {
	            return false;
	        }	
	    }


    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
	
	public function actionSearch()
	    {
		    $q = Yii::$app->getRequest()->getQueryParam('q');
		    
		    //$query = GsmsetNews::find()->where(['published' => 1])->where(['like', 'title', $q]);
		    $query = Product::find()->where(['published' => 1])->where(['like', 'model', $q]);

		    
		    $pagination = new Pagination([
				'defaultPageSize' => 10,
				'totalCount' => $query->count(),
			]);
			$posts = $query->offset($pagination->offset)->limit($pagination->limit)->all();
		    
		    
		    return $this->render('search', [
		        'q'=> $q,
		        'posts'  => $posts,
		        'active_page' => Yii::$app->request->get("page", 1),
		        'count_pages' => $pagination->getPageCount(),
		        'pagination'  => $pagination
		    ]);
		}
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    
	
	public function actionPage($id=NULL)
	{
		/*
		if (Yii::$app->getRequest()->getQueryParam('id') == 1) {
			
			$page  = array(); 
			$pages = array();
			$post  = array(); 
			$posts = array();
			
		   	        $category = null;
	
	        $categories = GsmsetCategory::find()->indexBy('id')->orderBy('id')->all();
	
	        $productsQuery = GsmsetCatalogProducts::find();
	        if ($id !== null && isset($categories[$id])) {
	            $category = $categories[$id];
	            $productsQuery->where(['category_id' => $this->getCategoryIds($categories, $id)]);
	        }
	
	        $productsDataProvider = new ActiveDataProvider([
	            'query' => $productsQuery,
	            'pagination' => [
	                'pageSize' => 10,
	            ],
	        ]);
	
	        return $this->render('page', [
		        'posts'  => $posts,
				'post' => $post,
				'page'  => $page,
				'pages' => $pages,
	            'category' => $category,
	            'menuItems' => $this->getMenuItems($categories, isset($category->id) ? $category->id : null),
	            'productsDataProvider' => $productsDataProvider,
	        ]);

	    	
	    } else
	    
	    */
	    if (Yii::$app->getRequest()->getQueryParam('id') == 4) {
			$page = array(); 
			$pages = array();
			$category = array();
			$model = new \common\models\GsmsetNews();	    	    
			$query = $model::find()->where(['published' => 1]);
			$pagination = new Pagination([
				'defaultPageSize' => 10,
				'totalCount' => $query->count(),
			]);
		
			$posts = $query->orderBy(['date' => SORT_DESC])->offset($pagination->offset)->limit($pagination->limit)->all();
	    
			$post = $model::find()->where(['id' => Yii::$app->getRequest()->getQueryParam('id')])->one();
	    
			return $this->render('page', [
	        	'model' => $model,
				'posts'  => $posts,
				'post' => $post,
				'page'  => $page,
				'pages' => $pages,
				'category' => $category,
				'active_page' => Yii::$app->request->get("page", 1),
				'count_pages' => $pagination->getPageCount(),
				'pagination'  => $pagination
			]);
   
	    
	    } else {
		    $category = array();
		    $model = new \common\models\GsmsetPage();
	    	    
			$query = $model::find()->where(['enabled' => 1]);
		
			$pagination = new Pagination([
				'defaultPageSize' => 10,
				'totalCount' => $query->count(),
			]);
		
			$pages = $query->orderBy(['created_at' => SORT_DESC])->offset($pagination->offset)->limit($pagination->limit)->all();
	    
		    $page = $model::find()->where(['id' => Yii::$app->getRequest()->getQueryParam('id')])->one();
			
			return $this->render('page', [
			        'model' => $model,
					'pages'  => $pages,
					'page' => $page,
					'category' => $category,
					'active_page' => Yii::$app->request->get("page", 1),
					'count_pages' => $pagination->getPageCount(),
					'pagination'  => $pagination
			]);
		}
	}	
	/* Раздел новости */
	public function actionNews($id=NULL)
	{
		
	    $model = new \common\models\GsmsetNews();
	    	    
		$query = $model::find()->where(['published' => 1]);
		
		$pagination = new Pagination([
			'defaultPageSize' => 10,
			'totalCount' => $query->count(),
		]);
		
		$posts = $query->orderBy(['date' => SORT_DESC])->offset($pagination->offset)->limit($pagination->limit)->all();
	    
	    $post = $model::find()->where(['id' => Yii::$app->getRequest()->getQueryParam('id')])->one();
	    
	    return $this->render('news', [
	        'model' => $model,
	        'posts'  => $posts,
	        'post' => $post,
	        'active_page' => Yii::$app->request->get("page", 1),
	        'count_pages' => $pagination->getPageCount(),
	        'pagination'  => $pagination
	    ]);
	    
	    
	}	
	/* Конец раздела новости */


    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
    /**
     * @param Category[] $categories
     * @param int $activeId
     * @param int $parent
     * @return array
     */
    private function getMenuItems($categories, $activeId = null, $parent = null)
    {
        $menuItems = [];
        foreach ($categories as $category) {
            if ($category->parent_id === $parent) {
                $menuItems[$category->id] = [
                    'active' => $activeId === $category->id,
                    'label' => $category->name,
                    'url' => ['catalog/list', 'id' => $category->id],
                    'items' => $this->getMenuItems($categories, $activeId, $category->id),
                ];
            }
        }
        return $menuItems;
    }


    /**
     * Returns IDs of category and all its sub-categories
     *
     * @param Category[] $categories all categories
     * @param int $categoryId id of category to start search with
     * @param array $categoryIds
     * @return array $categoryIds
     */
    private function getCategoryIds($categories, $categoryId, &$categoryIds = [])
    {
        foreach ($categories as $category) {
            if ($category->id == $categoryId) {
                $categoryIds[] = $category->id;
            }
            elseif ($category->parent_id == $categoryId){
                $this->getCategoryIds($categories, $category->id, $categoryIds);
            }
        }
        return $categoryIds;
    }

}

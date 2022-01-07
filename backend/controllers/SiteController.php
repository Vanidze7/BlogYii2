<?php

namespace backend\controllers;

use common\models\Article;
use common\models\Category;
use common\models\Comment;
use common\models\LoginForm;
use common\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'user-view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataCategory = new ActiveDataProvider([
            'query' => Category::find(),
        ]);
        $dataArticle = new ActiveDataProvider([
            'query' => Article::find(),
        ]);
        $dataComment = new ActiveDataProvider([
            'query' => Comment::find(),
        ]);
        $dataUser = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        return $this->render('index', [
            'dataCategory' => $dataCategory,
            'dataArticle' => $dataArticle,
            'dataComment' => $dataComment,
            'dataUser' => $dataUser,
        ]);
    }

    /**
     * Login action.
     *
     * @return string|Response
     */

    public function actionUserView($id)
    {
        $model = User::findOne(['id' => $id]);

        return $this->render('user-view', [
           'model' => $model,
        ]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}

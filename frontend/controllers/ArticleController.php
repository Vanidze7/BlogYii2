<?php


namespace frontend\controllers;


use common\models\Article;
use yii\web\Controller;

class ArticleController extends Controller
{
    public function actionCategory($id)
    {
        $catarticles = Article::find()->where(['category_id' => $id])->with('comments')->all();
        return $this->render('category', ['catarticles' => $catarticles]);
    }
}
<?php


namespace frontend\controllers;

use common\models\Article;
use common\models\Category;
use common\models\Comment;
use common\models\User;
use yii\web\Controller;

class ArticleController extends Controller
{
    public function actionCategory($id)
    {
        $catarticles = Article::find()->where(['category_id' => $id])->with('comments')->all();
        $category = Category::findOne($id);
        $top_article = Article::find()->orderBy(['views' => SORT_DESC])->limit(4)->all();
        $comment = Comment::find()->orderBy(['created_at' => SORT_DESC])->limit(4)->all();

        return $this->render('category', [
            'catarticles' => $catarticles,
            'category' => $category,
            'top_article' => $top_article,
            'comment' => $comment,
        ]);
    }
    public function actionView($id)
    {
        $article_one = Article::findOne($id);
        $session = \Yii::$app->session;
            //достаем значение сессии по уникальному ключу, при его отсутствии возвращаем defaultValue = false, что соответствует условию if и запускает выполнение кода
        if ($session->get("id_article_" . $article_one->id, false) == false)
        {
            $session->set("id_article_" . $article_one->id, 1);
            $article_one->detachBehavior('timestamp');//отключить поведение по наименованию
            $article_one->views += 1;
            $article_one->save();
        }
        $new_comment = new Comment();//добавление комментария
        if ($this->request->isPost == true)
        {
            $new_comment->user_id = \Yii::$app->user->id;
            $new_comment->article_id = $article_one->id;
            if ($new_comment->load($this->request->post()) && $new_comment->save()) {
                \Yii::$app->session->setFlash('success', 'Комментарий добавлен');
                return $this->redirect(['view', 'id' => $article_one->id]);
            }
        }
        return $this->render('view', ['article_one' => $article_one, 'new_comment' => $new_comment]);
    }

    public function actionCreateArticle()
    {
        $new_article = new Article();
        if ($this->request->isPost == true)
        {
            $new_article->user_id = \Yii::$app->user->id;
            if ($new_article->load($this->request->post()) && $new_article->save()) {
                \Yii::$app->session->setFlash('success', 'Статья опубликована');
                return $this->redirect(['view', 'id' => $new_article->id]);
            }
        }
        return $this->render('article-form', ['model' => $new_article]);
    }

    public function actionUpdateArticle($id)
    {
        $up_article = Article::findOne($id);
        if ($this->request->isPost == true)
        {
            if ($up_article->load($this->request->post()) && $up_article->save()) {

                \Yii::$app->session->setFlash('success', 'Статья опубликована');
                return $this->redirect(['view', 'id' => $up_article->id]);
            }

        }
        return $this->render('article-form', ['model' => $up_article]);
    }
}
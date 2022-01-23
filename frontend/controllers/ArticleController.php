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
            $article_one->views += 1;
            $article_one->save();
        }
        $new_comment = new Comment();//добавление комментария
        if ($this->request->isPost)
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
}
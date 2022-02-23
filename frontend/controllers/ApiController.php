<?php


namespace frontend\controllers;


use common\models\Article;
use common\models\Category;
use common\models\User;
use Yii;

class ApiController extends \yii\rest\Controller
{
    public $enableCsrfValidation = false;

    private function errorResponse($message)
    {

        // set response code to 400
        Yii::$app->response->statusCode = 400;

        return $this->asJson(['error' => $message]);
    }

    public function actionGetCategory()
    {
        $category = Category::find()->all();
        return $this->asJson(['success' => true, 'result' => $category]);
    }

    public function actionCreateCategory()
    {
        $new_cat = new Category();

        if (Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            $title = $request->post('title');
            $description = $request->post('description');
            $new_cat->title = $title;
            $new_cat->description = $description;
            $new_cat->save();
        }
        return $this->asJson(['success' => true, 'result' => $new_cat]);
    }

    public function actionCreateArticle()
    {
        $new_art = new Article();
        if (Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            $title = $request->post('title');
            $text = $request->post('text');
            $user_id = $request->post('user_id');
            $category_id = $request->post('category_id');

            if (is_null(User::findOne($user_id)))
                return $this->errorResponse('Could not find user with provided ID');

            if (is_null(Category::findOne($category_id)))
                return $this->errorResponse('Could not find category with provided ID');

            $new_art->attributes =
                [
                    'title' => $title,
                    'text' => $text,
                    'user_id' => $user_id,
                    'category_id' => $category_id
                ];
            $new_art->save();
        }
        return $this->asJson(['success' => true, 'result' => $new_art]);
    }

    public function actionUpdateArticle()
    {
        if ($this->request->isPost) {
            $id = Yii::$app->request->post('id');

            if (is_null($up_article = Article::findOne($id)))
                return $this->errorResponse('Could not find article with provided ID');

            $request = Yii::$app->request;

            if ($request->post('title'))
                $up_article->title = $request->post('title');

            if ($request->post('text'))
                $up_article->text = $request->post('text');

            $up_article->status = Article::STATUS_1;
            $up_article->save();
            return $this->asJson(['success' => true, 'result' => $up_article]);
        }
        return $this->errorResponse('Ошибка запроса');
    }

    public function actionDeleteArticle()
    {
        $id = Yii::$app->request->post('id');
        if ($art = Article::findOne($id)){
            $art->status = Article::STATUS_0;
            $art->save();
            return $this->asJson(['success' => true]);
        }
        return $this->errorResponse('Такой статьи не существует');
    }
}
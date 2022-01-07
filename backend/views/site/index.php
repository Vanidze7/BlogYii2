<?php

use common\models\Article;
use common\models\Category;
use common\models\Comment;
use common\models\User;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'БлоГ Vano';
?>
<div class="site-index">
    <h1 class="text-center">Ваши сущности</h1>
    <div class="row">
        <div class="col-lg-3">
            <h3><a href="<?= Url::to(['category/index']) ?>">Категории</a></h3>
            <?= GridView::widget([
                'dataProvider' => $dataCategory,
                'columns' => [
                    [
                        'attribute' => 'title',
                        'value' => function(Category $model){
                            return '<a href="' . Url::to(['category/view', 'id' => $model->id]) . '">' .$model->title . '</a>';
                        },
                        'format' => 'raw',
                    ],
                ],
            ]); ?>
        </div>
        <div class="col-lg-3">
            <h3><a href="<?= Url::to(['article/index']) ?>">Статьи</a></h3>
            <?= GridView::widget([
                'dataProvider' => $dataArticle,
                'columns' => [
                    [
                        'attribute' => 'title',
                        'value' => function(Article $model){
                            return '<a href="' . Url::to(['article/view', 'id' => $model->id]) . '">' .$model->title . '</a>';
                        },
                        'format' => 'raw',
                    ],
                ],
            ]); ?>
        </div>
        <div class="col-lg-3">
            <h3><a href="<?= Url::to(['comment/index']) ?>">Комментарии</a></h3>
            <?= GridView::widget([
                'dataProvider' => $dataComment,
                'columns' => [
                    [
                        'attribute' => 'text',
                        'value' => function(Comment $model){
                            return '<a href="' . Url::to(['comment/view', 'id' => $model->id]) . '">' . substr($model->text, 0, 50) . '</a>';
                        },
                        'format' => 'raw',
                    ],
                ],
            ]); ?>
        </div>
        <div class="col-lg-3">
            <h3><a>Пользователи</a></h3>
            <?= GridView::widget([
                'dataProvider' => $dataUser,
                'columns' => [
                    [
                        'attribute' => 'username',
                        'value' => function(User $model){
                            return '<a href="' . Url::to(['site/user-view', 'id' => $model->id]) . '">' . $model->username . '</a>';
                        },
                        'format' => 'raw',
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>

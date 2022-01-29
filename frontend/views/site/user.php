<?php

/* @var $this yii\web\View */
/* @var $article common\models\Article */
/* @var $user common\models\User */
/* @var $comment common\models\Comment */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Страница пользователя: ' . $user->username;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-user">
    <div class="row">
        <div class="col-sm-8">
            <div class="row block">
                <div class="col-sm-4">
                    <?= Html::img('/image/avatar/ava0.jpg', ['width' => '100%']) //Html::img($user->ava_img, ['width' => '100%']) ?>
                </div>
                <div class="col-sm-8">
                    <h5>Имя: <?= $user->username ?></h5>
                    <p>Дата регистрации: <?= date ("Y-m-d H:i:s", $user->created_at) ?></p>
                    <p>Почта: <?= $user->email ?></p>
                    <p>Кол-во статей: <?= count($user->articles) ?></p>
                    <p>Кол-во комментарией: <?= count($user->comments) ?></p>
                </div>
            </div>
            <h3 class="title">Статьи пользователя</h3>
            <?php foreach ($article_user as $article) { ?>
            <div class="row block">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-2">
                            <?= Html::img($article->img, ['width' => '100%']) ?>
                        </div>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <h5><a href="<?= Url::to(['article/view', 'id' => $article->id]) ?>"><?= $article->title ?></a></h5>
                                        </div>
                                        <?php
                                        if (Yii::$app->user->identity->id == $user->id) {?>
                                        <div class="col-sm-5">
                                            <?= Html::a('Редактировать', ['article/update-article'], ['class' => 'btn btn-primary btn-block btn-sm']) ?>
                                        </div>
                                        <?php }?>
                                    </div>
                                    <p>Дата публикации: <?= date ("Y-m-d H:i:s", $article->created_at) ?></p>
                                    <p>Кол-во просмотров: <?= $article->views ?></p>
                                    <p>Кол-во комментариев: <?= count($article->comments) ?></p>
                                    <p>Категория: <a href="<?= Url::to(['article/category', 'id' => $article->category_id]) ?>"><?= $article->category->title ?></a></p>
                                    <div class="comment">
                                        <small><?= substr($article->text, 0, 380) ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <h3 class="title">Коментарии пользователя</h3>
            <?php foreach ($user->comments as $comment) { ?>
                <div class="row block">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-2">
                                <?= Html::img($comment->article->img, ['width' => '100%']) ?>
                            </div>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-sm-7">
                                        <h5>Статья: <a href="<?= Url::to(['article/view', 'id' => $comment->article->id]) ?>"><?= $comment->article->title ?></a></h5>
                                    </div>
                                    <?php
                                    if (Yii::$app->user->identity->id == $user->id) {?>
                                    <div class="col-sm-5">
                                        <?= Html::a('Редактировать', ['article/update-comment', 'id' => $comment->id], ['class' => 'btn btn-primary btn-block btn-sm']) ?>
                                    </div>
                                    <?php }?>
                                </div>
                                <p>Дата публикации: <?= date ("Y-m-d H:i:s", $comment->created_at) ?></p>
                                <div class="comment">
                                    <small><?= $comment->text ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

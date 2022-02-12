<?php
/* @var $article_one common\models\Article */
/* @var $comment common\models\Comment */
/* @var $model common\models\Comment */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Статья: ' . $article_one->title;
$this->params['breadcrumbs'][] = ['label' => $article_one->category->title, 'url' => ['category', 'id' => $article_one->category->id]];
$this->params['breadcrumbs'][] = ['label' => $article_one->title];

?>
<div class="article-view">
    <div class="row">
        <div class="col-sm-8">
            <div class="row block">
                <div class="col-sm-12">
                    <div class="row cell">
                        <div class="col-sm-6">
                            <?= Html::img($article_one->img, ['width' => '100%']) ?>
                        </div>
                        <div class="col-sm-6">
                            <h5>Автор: <a href="<?= Url::to(['site/user', 'id' => $article_one->user_id]) ?>"><?= $article_one->user->username ?></a></h5>
                            <p>Дата публикации: <?= date ("Y-m-d H:i:s", $article_one->created_at) ?></p>
                            <small>Кол-во просмотров: <?= $article_one->views ?></small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <h2><?= $article_one->title ?></h2>
                        </div>
                        <?php
                        if (Yii::$app->user->identity->id == $article_one->user_id) {?>
                        <div class="col-sm-6">
                            <?= Html::a('Редактировать', ['article/update-article', 'id' => $article_one->id], ['class' => 'btn btn-primary btn-block btn-sm']) ?>
                        </div>
                        <?php }?>
                    </div>
                    <span><?= $article_one->text ?></span>
                </div>
            </div>
            <div class="row block">
                <div class="col-sm-12">
                    <div class="row cell">
                        <div class="col-sm-8">
                            <h4>Коментарии</h4>
                        </div>
                        <div class="col-sm-4">
                            <a href="#add-comment">Добавить комментарий</a>
                        </div>
                    </div>
                    <?php foreach ($article_one->comments as $comment) { ?>
                    <div class="row cell">
                        <div class="col-sm-2">
                            <?= Html::img('/image/avatar/ava0.jpg', ['width' => '100%']) //Html::img($comment->ava_img, ['width' => '100%']) ?>
                        </div>
                        <div class="col-sm-10 comment">
                            <div class="row">
                                <div class="col-sm-8">
                                    <a href="<?= Url::to(['site/user', 'id' => $comment->user_id]) ?>"><?= $comment->user->username ?></a>
                                </div>
                                <?php if (Yii::$app->user->identity->id == $comment->user_id) {?>
                                <div class="col-sm-4">
                                    <?= Html::a('Редактировать', ['article/update-comment', 'id' => $comment->id], ['class' => 'btn btn-primary btn-block btn-sm']) ?>
                                </div>
                                <?php } ?>
                            </div>
                            <span><?= $comment->text ?></span>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div id="add-comment" class="row block">
                <div class="col-sm-12">
                    <div class="row cell">
                        <div class="col-sm-12">
                            <h4>Добавить коментарий</h4>
                        </div>
                        <div class="comment-create">
                            <?= Yii::$app->controller->renderPartial('/comment/comment-form', ['model' => $new_comment])//без применения шаблона ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

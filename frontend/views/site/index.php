<?php

/* @var $this yii\web\View */
/* @var $artone common\models\Article *///указываем переменную и её область видимости
/* @var $artcat common\models\Article */
/* @var $catone common\models\Category */
/* @var $comone common\models\Comment */

use yii\helpers\Html;

$this->title = 'Бложище';
?>
<div class="site-index">
    <div class="row">
        <div class="col-sm-8">
            <div class="row block">
                <div class="row">
                    <div class="col-sm-12">
                        <h5>Топ статей</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                        <?php foreach ($article as $artone) {?>
                            <div class="col-sm-6">
                                <div class="row cell">
                                    <div class="col-sm-4">
                                        <?= Html::img($artone->img, ['width' => '100%']) ?>
                                    </div>
                                    <div class="col-sm-8">
                                        <h5><a href="<?= \yii\helpers\Url::to(['article/view', 'id' => $artone->id]) ?>"><?= $artone->title ?></a></h5>
                                        <p>Категория: <a href="<?= \yii\helpers\Url::to(['article/category', 'id' => $artone->category_id]) ?>"><?= $artone->category->title ?></a></p>
                                        <p><?= substr($artone->text, 0, 50) ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <?php foreach ($category as $catone){ ?>
                    <div class="row block">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h5><a href="<?= \yii\helpers\Url::to(['article/category', 'id' => $catone->id]) ?>"><?= $catone->title ?></a></h5>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <?php
                                        $count = 0;
                                        foreach ($catone->articles as $artcat) {
                                            if ($count >= 2) break;
                                            ?>
                                            <div class="col-sm-6">
                                                <div class="row cell">
                                                    <div class="col-sm-4">
                                                        <?= Html::img($artcat->img, ['width' => '100%']) ?>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <h5><a href="<?= \yii\helpers\Url::to(['article/view', 'id' => $artcat->id]) ?>"><?= $artcat->title ?></a></h5>
                                                        <p><?= substr($artcat->text, 0, 50) ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        $count += 1; } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="row block">
                <div class="row">
                    <div class="col-sm-12">
                        <h5>Комментарии</h5>
                    </div>
                </div>
                <?php foreach ($comment as $comone) { ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row cell">
                            <div class="col-sm-4">
                                <?= Html::img('image/avatar/ava0.jpg', ['width' => '100%']) //Html::img($comone->ava_img, ['width' => '100%']) ?>
                            </div>
                            <div class="col-sm-8">
                                <h5><a href="<?= \yii\helpers\Url::to(['site/user', 'id' => $comone->user_id]) ?>"><?= $comone->user->username ?></a></h5>
                                <p>Статья: <a href="<?= \yii\helpers\Url::to(['article/view', 'id' => $comone->article_id]) ?>"><?= $comone->article->title ?></a></p>
                                <p><?= substr($comone->article->text, 0, 50) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

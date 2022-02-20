<?php

/* @var $this yii\web\View */
/* @var $artone common\models\Article *///указываем переменную и её область видимости
/* @var $artcat common\models\Article */
/* @var $catone common\models\Category */

use yii\helpers\Html;

$this->title = 'Бложище';
?>
<div class="site-index">
    <div class="row">
        <div class="col-sm-8">
            <div class="row block">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <h5>Новейшие</h5>
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
                                            <small>Категория: <a href="<?= \yii\helpers\Url::to(['article/category', 'id' => $artone->category_id]) ?>"><?= $artone->category->title ?></a></small>
                                            <p><?= substr($artone->text, 0, 50) ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <?php foreach ($category as $catone){
                        if (count($catone->visibleArticles) == 0) continue;//продолжить сначало
                        ?>
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
                                        foreach ($catone->visibleArticles as $artcat) {
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
        <?= Yii::$app->controller->renderPartial('/right-bar', ['top_article' => $top_article, 'comment' => $comment, 'search' => $search]) ?>
    </div>
</div>

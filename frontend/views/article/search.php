<?php

/* @var $artone common\models\Article */

use yii\helpers\Html;

$this->title = 'Поиск';
?>
<div class="site-search">
    <div class="row">
        <div class="col-sm-8">
            <div class="row block">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <h5>Результаты поиска</h5>
                        </div>
                    </div>
                    <?php if(count($articles) == 0){?>
                    <p>Совпадений не найдено</p>
                    <?php } else {?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <?php foreach ($articles as $artone) {?>
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
                    <?php }?>
                </div>
            </div>
        </div>
        <?= Yii::$app->controller->renderPartial('/right-bar', ['top_article' => $top_article, 'comment' => $comment, 'search' => $search]) ?>
    </div>
</div>

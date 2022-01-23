<?php

/* @var $catarticles common\models\Article */
/* @var $article common\models\Article */
/* @var $category common\models\Category */

use yii\helpers\Html;

$this->title = 'Статьи категории: ' . $category->title;

?>
<div class="article-category">
    <div class="row">
        <div class="col-sm-8">
        <?php foreach ($catarticles as $article){ ?>
            <div class="row block">
                <div class="col-sm-12">
                    <div class="row title">
                        <div class="col-sm-12">
                            <h3><a href="<?= \yii\helpers\Url::to(['article/view', 'id' => $article->id]) ?>"><?= $article->title ?></a></h3>
                        </div>
                    </div>
                    <div class="row cell content">
                        <div class="col-sm-6">
                            <?= Html::img($article->img, ['width' => '100%']) ?>
                        </div>
                        <div class="col-sm-6">
                            <div class="row cell article">
                                <div class="col-sm-12">
                                    <h3><a href="<?= \yii\helpers\Url::to(['site/user', 'id' => $article->user->id]) ?>">Автор: <?= $article->user->username ?></a></h3>
                                    <p><?= substr($article->text, 0, 150) ?></p>
                                </div>
                            </div>
                            <div class="row comment">
                                <div class="col-sm-12">
                                    <?php foreach ($article->comments as $comone) { ?>
                                    <div class="row cell comment">
                                        <div class="col-sm-12">
                                            <h5><a href="<?= \yii\helpers\Url::to(['site/user', 'id' => $comone->user_id]) ?>"><?= $comone->user->username ?></a></h5>
                                            <p><?= substr($comone->text, 0, 50) ?></p><!--можно убрать <p> он сам проставляеться в редакторе-->
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>
        </div>
        <?= Yii::$app->controller->renderPartial('/right-bar', ['top_article' => $top_article, 'comment' => $comment]) ?>
    </div>
</div>

<?php

/* @var $top_art common\models\Article */
/* @var $comone common\models\Comment */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="col-sm-4">
    <div class="row block">
        <?php $form = ActiveForm::begin(['action' => ['article/search'], 'options' => ['class' => 'form-inline']]) ?>
        <?= $form->field($search, 'query')->textInput(['maxlength' => 30])->label(false)?>
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-success ml-sm-2']) ?>
        <?php ActiveForm::end(); ?>
    </div>
    <div class="row block">
        <?= Html::a('Добавить статью', ['article/create-article'], ['class' => 'btn btn-primary btn-block']) ?>
    </div>
    <div class="row block">
        <div class="col-sm-12">
            <h5>Популярные</h5>
            <?php foreach ($top_article as $top_art) { ?>
            <div class="row cell">
                <div class="col-sm-5">
                    <?= Html::img($top_art->img, ['width' => '100%']) ?>
                </div>
                <div class="col-sm-7">
                    <h6><a href="<?= \yii\helpers\Url::to(['article/view', 'id' => $top_art->id]) ?>"><?= $top_art->title ?></a></h6>
                    <small>Категория: <a href="<?= \yii\helpers\Url::to(['article/category', 'id' => $top_art->category_id]) ?>"><?= $top_art->category->title ?></a></small>
                    <p><?= substr($top_art->text, 0, 30) ?></p>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="row block">
        <div class="col-sm-12">
            <h5>Комментарии</h5>
            <?php foreach ($comment as $comone) { ?>
            <div class="row cell">
                <div class="col-sm-5">
                    <?= Html::img('/image/avatar/ava0.jpg', ['width' => '100%']) //Html::img($comone->ava_img, ['width' => '100%']) ?>
                </div>
                <div class="col-sm-7">
                    <h5><a href="<?= \yii\helpers\Url::to(['site/user', 'id' => $comone->user_id]) ?>"><?= $comone->user->username ?></a></h5>
                    <small>Статья: <a href="<?= \yii\helpers\Url::to(['article/view', 'id' => $comone->article_id]) ?>"><?= $comone->article->title ?></a></small>
                    <p><?= substr($comone->text, 0, 50) ?></p>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
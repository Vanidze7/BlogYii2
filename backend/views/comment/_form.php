<?php

use kartik\editors\Summernote;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Comment */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="comment-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'text')->widget(Summernote::class, [
        'options' => ['placeholder' => 'Edit your blog content here...']
    ]) ?>
    <?= $form->field($model, 'user_id')->dropDownList(\common\models\User::getUserList()) ?>
    <?= $form->field($model, 'article_id')->dropDownList(\common\models\Article::getArticleList()) ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<?php

use kartik\editors\Summernote;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'text')->widget(Summernote::class, [
        'options' => ['placeholder' => 'Edit your blog content here...']
    ]) ?>
    <?= $form->field($model, 'views')->textInput() ?>
    <?= $form->field($model, 'file')->widget(FileInput::class, [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'showCaption' => false,//настройки
            'showUpload' => false,
        ],
    ]); ?>
    <?= $form->field($model, 'user_id')->dropDownList(\common\models\User::getUserList()) ?>
    <?= $form->field($model, 'category_id')->dropDownList(\common\models\Category::getCategoryList()) ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

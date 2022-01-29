<?php

/* @var $model common\models\Article */
/* @var $form yii\widgets\ActiveForm */

use kartik\editors\Summernote;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Добавление статьи';
$this->params['breadcrumbs'][] = ['label' => 'Добавление статьи'];

?>
<div class="create-article-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'category_id')->dropDownList(\common\models\Category::getCategoryList()) ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => 30]) ?>
    <?= $form->field($model, 'text')->widget(Summernote::class, [
        'options' => ['placeholder' => 'Напечатайте текст статьи']
    ])//без вывода наименование атрибута?>
    <?= $form->field($model, 'file')->widget(FileInput::class, [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'showCaption' => false,//настройки
            'showUpload' => false,
        ],
    ]); ?>
    <div class="form-group">
        <?= Html::submitButton('Опубликовать', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

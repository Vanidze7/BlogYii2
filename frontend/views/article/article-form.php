<?php

/* @var $model common\models\Article */
/* @var $form yii\widgets\ActiveForm */

use kartik\editors\Summernote;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = $model->isNewRecord == true ? 'Добавление статьи' : 'Редактирование статьи: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => $this->title];

?>
<div class="article-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'category_id')->dropDownList(\common\models\Category::getCategoryList(), [
            'disabled' => $model->isNewRecord == false
    ]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 30]) ?>
    <?= $form->field($model, 'text')->widget(Summernote::class, [
        'options' => ['placeholder' => 'Напечатайте текст статьи']
    ])?>
    <?= $form->field($model, 'file')->widget(FileInput::class, [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'showCaption' => false,//настройки
            'showUpload' => false,
            'initialPreviewAsData'=>true,//отображение картинки
            'initialPreview'=> [ Yii::$app->urlManager->createAbsoluteUrl($model->img)],
        ],
    ]); ?>
    <div class="form-group">
        <?= Html::submitButton('Опубликовать', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<?php

use kartik\editors\Summernote;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $model common\models\Comment */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="comment-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'text')->widget(Summernote::class, [
        'options' => ['placeholder' => 'Напечатайте ваш комментарий']
    ])->label(false) //без вывода наименование атрибута?>
    <div class="form-group">
        <?= Html::submitButton('Опубликовать', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

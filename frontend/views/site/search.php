<?php

/* @var $this yii\web\View */

use yii\bootstrap4\Html;
use kartik\select2\Select2;

$jsSelectCategory = <<<JS
function select() {
    var id = $(this).val();
    
   $.ajax("/site/get-article-by-category-id?id=" + id)
  .done(function(response) {
        $('select#article-list option').each(function(index, element) {
            var value = $(element).val();
            if (value) {
                $(element).remove();
            }
        });
        for(const a of response.result) {
            $('select#article-list').append(new Option(a.title, a.id, false, false))
        }
  })
  .fail(function() {
    
  })
  .always(function() {
    
  });
}
JS;

$this->title = 'Поиск статей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
        <?php
        echo '<label class="control-label">Категории</label>';
        echo Select2::widget([
            'name' => 'category',
            'data' => \common\models\Category::getCategoryList(),
            'options' => [
                    'id' => 'category-list',
                'placeholder' => 'Выберите категорию...',
            ],
            'pluginEvents' => [
                    'change' => new \yii\web\JsExpression($jsSelectCategory)
            ]
        ]);

        echo '<label class="control-label">Статьи</label>';
        echo Select2::widget([
            'name' => 'article',
            'data' => [],
            'options' => [
                'id' => 'article-list',
                'placeholder' => 'Выберите статью...',
            ],
        ]);
        ?>

        </div>
    </div>

</div>

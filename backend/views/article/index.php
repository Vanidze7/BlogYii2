<?php

use common\models\Article;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Статьи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Создать статью', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'title',
            [
                'attribute' => 'text', //как увеличить ширину столбца?
                'value' => function(Article $model){
                    return substr($model->text, 0, 40);
                },
                'format' => 'raw',
            ],
            'views',
            'img',
            'created',
            'updated',
            [
                'attribute' => 'user_id',
                'value' => function(Article $model){
                    return '<a href="' . \yii\helpers\Url::to(['site/userview', 'id' => $model->user->id]) . '">' . $model->user->id . ' - ' . $model->user->username . '</a>';
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'category_id',
                'value' => function(Article $model){
                    return '<a href="' . \yii\helpers\Url::to(['category/view', 'id' => $model->category->id]) . '">' . $model->category->title . '</a>';
                },
                'format' => 'raw',
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Article $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>
</div>

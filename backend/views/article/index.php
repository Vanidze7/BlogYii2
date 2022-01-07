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
                'attribute' => 'text',
                'value' => function(Article $model){
                    return substr($model->text, 0, 40);
                },
                'format' => 'raw',
            ],
            'views',
            'img',
            [
                'attribute' => 'created_at',
                'value' => function(Article $model){
                    return date("Y-m-d H:i:s", $model->created_at);
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'updated_at',
                'value' => function(Article $model){
                    return date("Y-m-d H:i:s", $model->updated_at);
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'user_id',
                'value' => function(Article $model){
                    return '<a href="' . \yii\helpers\Url::to(['site/user-view', 'id' => $model->user->id]) . '">' . $model->user->id . ' - ' . $model->user->username . '</a>';
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

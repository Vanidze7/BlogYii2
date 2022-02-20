<?php


namespace common\models;


class ArticleSearch extends \yii\base\Model
{
    public $query;

    public function rules()
    {
        return [
          [['query'], 'required'],
          [['query'], 'string']
        ];
    }


}
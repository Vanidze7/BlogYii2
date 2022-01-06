<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $text
 * @property int|null $views
 * @property string|null $img
 * @property int|null $created
 * @property int|null $updated
 * @property int $user_id
 * @property int $category_id
 *
 * @property Category $category
 * @property Comment[] $comments
 * @property User $user
 */
class Article extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created' , 'updated'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated'],
                ],
                // если вместо метки времени UNIX используется datetime:
                'value' => new Expression('NOW()'),//текущее значение
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'text', 'user_id', 'category_id'], 'required'],
            [['views', 'user_id', 'category_id'], 'integer'],
            [['title', 'img'], 'string', 'max' => 255],
            [['text'], 'string'],
            [['created', 'updated'], 'safe'],
            [['file'], 'image'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Наименование',
            'text' => 'Текст статьи',
            'views' => 'Кол-во просмотров',
            'img' => 'Картинка',
            'file' => 'Файл',
            'created' => 'Создана',
            'updated' => 'Обновлена',
            'user_id' => 'ID Пользователя',
            'category_id' => 'ID Категории',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['article_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public static function getArticleList()
    {
        $arrays = self::find()->select(['id', 'title'])->all();//как сделать чтобы отображался номер ID тоже?
        return ArrayHelper::map($arrays, 'id', 'title');
    }

    public function beforeSave($insert)
    {
        if($file = UploadedFile::getInstance($this, 'file')){//берем информацию о загружаемом файле
            $dir = 'image/' . date("Y-m-d") . '/';//указываем путь к папке где будут сохраняться файлы в папках с текущей датой
            if (!is_dir($dir))//если такой папки нет
                mkdir($dir);//создадим

            $file_name = uniqid() . '_' . $file->baseName . '.' . $file->extension;//уникальный код + имя файла и его расширение
            $this->img = $dir . $file_name;//в свойство img (БД) помещаем путь к файлу и его имя
            $file->saveAs($this->img);//сохраняем запись в БД
        }
        return parent::beforeSave($insert);
    }
}

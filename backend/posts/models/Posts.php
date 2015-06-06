<?php

namespace backend\posts\models;

use Yii;
use common\models\Func;
use yii\db\Connection;

/**
 * This is the model class for table "posts".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $img
 * @property string $date
 * @property integer $cat_id
 * @property string $long
 * @property integer $parrent_id
 */
class Posts extends \yii\db\ActiveRecord
{

    /*
   * @slug
   */
    public function behaviors()
    {
        return [
            'slug' => [
                'class' => 'common\behaviors\Slug',
                'in_attribute' => 'title',
                'out_attribute' => 'slug',
                'translit' => true
            ]
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    public function addParentId($id){
        $model = $this->findOne($id);

        $model->parrent_id = $id;
        $model->save();
    }

    public function addPostWhithNewLang($id,$lang){
        $connection = \Yii::$app->db;
        $connection->createCommand()->insert('posts', [
            'parrent_id' => $id,
            'lang' => $lang,
        ])->execute();

        $id = Yii::$app->db->getLastInsertID();

        return $this->find()->where(['id' => $id,'lang'=> $lang])->one();
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lang'], 'required'],
            [['id', 'cat_id', 'parrent_id'], 'integer'],
            [['description','slug'], 'string'],
            [['title'], 'string', 'max' => 250],
            [['img', 'date'], 'string', 'max' => 50],
            [['lang'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'img' => 'Img',
            'date' => 'Date',
            'cat_id' => 'Category',
            'lang' => 'Lang',
            'parrent_id' => 'Parrent ID',
            'slug' => 'Slug'
        ];
    }
}

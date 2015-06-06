<?php

namespace backend\posts\models;

use Yii;
use common\models\Func;
/**
 * This is the model class for table "categories".
 *
 * @property integer $id
 * @property string $title
 * @property string $lang
 * @property integer $paret_id
 * @property string $img
 * @property string $description
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'paret_id'], 'required'],
            [['paret_id'], 'integer'],
            [['description'], 'string'],
            [['title', 'lang'], 'string', 'max' => 250],
            [['img'], 'string', 'max' => 50]
        ];
    }

    public function getParents($id){
        $res = $this->find()->select('id')->where(['paret_id'=>$id])->all();
        if($res){

            foreach($res as $one){
                $res[] = $this->getParents($one['id']);

            }
        }else return null;

        return $res;
    }

    public function getIdis($res){
        //Func::d($res);
        if(is_array($res)){
            foreach($res as $one){
                if(is_array($one)){

                    $id[] = $this->getIdis($one);
//                    foreach($one as $two){
//                        if($two !==null){
//                            $id[] = $two['id'];
//                        }
//                    }
                }elseif($one !== null){
                    $id[] = $one['id'];
                }
            }

            return $id;
        }else{
            return null;
        }

    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'lang' => 'Lang',
            'paret_id' => 'Paret ID',
            'img' => 'Img',
            'description' => 'Description',
        ];
    }
}

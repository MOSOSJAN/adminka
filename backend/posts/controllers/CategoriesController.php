<?php

namespace backend\posts\controllers;

use Yii;
use backend\posts\models\Categories;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use common\models\Func;

/**
 * CategoriesController implements the CRUD actions for Categories model.
 */
class CategoriesController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Categories models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Categories::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Categories model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Categories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Categories();

        $res = $model->find()->all();

        foreach($res as $one){
            $cats_ID[$one->id]['title'] = $one->title;
            $cats_ID[$one->id]['id'] = $one->id;
            $cats[$one->paret_id][$one->id]['title'] =  $one->title;
            $cats[$one->paret_id][$one->id]['id'] =  $one->id;
        }
       //$cats = $this->getCatsTree($cats,0);
        $cats = $this->build_tree($cats,0);
        //Func::d($cats);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'cats' => $cats,
            ]);
        }
    }

    public  function build_tree($cats,$parent_id,$only_parent = false){
        if(is_array($cats) and isset($cats[$parent_id])){
            $tree = '<ul>';
            if($only_parent==false){
                foreach($cats[$parent_id] as $cat){
                    $tree .= '<li><a href="'.Url::toRoute(['posts/test','id'=> $cat['id']]).'">'.$cat['title'].'</a>';
                    $tree .=  $this->build_tree($cats,$cat['id']);
                    $tree .= '</li>';
                }
            }elseif(is_numeric($only_parent)){
                $cat = $cats[$parent_id][$only_parent];
                $tree .= '<li><a href="'.Url::toRoute(['posts/posts','id'=> $cat['id']]).'">'.$cat['title'].' #'.$cat['id'].'</a>';
                $tree .=  $this->build_tree($cats,$cat['id']);
                $tree .= '</li>';
            }
            $tree .= '</ul>';
        }
        else return null;
        return $tree;
    }

    public function getCatsTree($cats,$parent_id=0,$only_parent = false){
        if(is_array($cats) and isset($cats[$parent_id])){

            if($only_parent==false){
                $i = 0;

                foreach($cats[$parent_id] as $cat){
                    $tree[$i] = $cat;

                    $tree[$i][] =  $this->getCatsTree($cats,$cat['id']);
                    $i++;
                }


            }elseif(is_numeric($only_parent)){
                $cat = $cats[$parent_id][$only_parent];
                $tree[$cat['id']] = $cat;
                $tree[$cat['id']] =  $this->getCatsTree($cats,$cat['id']);
            }
        }else return null;
        return $tree;
    }
    /**
     * Updates an existing Categories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Categories model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    /**
     * Finds the Categories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Categories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Categories::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

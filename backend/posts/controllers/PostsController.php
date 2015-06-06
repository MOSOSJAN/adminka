<?php

namespace backend\posts\controllers;

use Yii;
use backend\posts\models\Posts;
use backend\posts\models\Categories;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Lang;
use common\models\Func;

/**
 * PostsController implements the CRUD actions for Posts model.
 */
class PostsController extends Controller
{
    private $model;
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

    public  function init(){
        $this->model  = new Posts();
    }

    /**
     * Lists all Posts models.
     * @return mixed
     */
    public function actionIndex()
    {
//        $asd = Posts::find()->groupBy('parrent_id')->all();
//        Func::d($asd);
        $dataProvider = new ActiveDataProvider([
            'query' => Posts::find()->where(['lang' => 'am'])->groupBy('parrent_id'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }



    public function actionTest($id){
        $cats = new Categories();
        $asd = $cats->getParents($id);
        $asd = $cats->getIdis($asd);

      extract($asd);
        Func::d($asd);
    }

    /**
     * Creates a new Posts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = $this->model;

        if ($model->load(Yii::$app->request->post())) {

            $model->lang = 'am';
            $model->save();

            $id = Yii::$app->db->getLastInsertID();

            $model->addParentId($id);

            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Posts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id,$lang = 'am')
    {
        $model = $this->findForUpdate($id,$lang);

        //Func::d($model);
        if ($model->load(Yii::$app->request->post())) {

            $model->save();
            return $this->redirect(['update', 'id' => $model->parrent_id,'lang'=>$lang]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Posts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        foreach($model as $one){
            $one->delete();
        }

        return $this->redirect(['index']);
    }




    /**
     * Finds the Posts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Posts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Posts::find()->where(['parrent_id' => $id])->all()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findForUpdate($id,$lang){


        if(($model = $this->model->find()->where(['parrent_id' => $id,"lang" => $lang])->one()) != null){
            return $model;
        }elseif(($model = $this->model->findOne(['parrent_id' => $id,"lang != :lang", [':lang' => $lang]])) !==null){ 

            $model = $model->addPostWhithNewLang($id,$lang);
            return $model;
        }else{
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }




}

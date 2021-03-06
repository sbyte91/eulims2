<?php

namespace frontend\modules\services\controllers;

use Yii;
use common\models\services\Sampletype;
use common\models\services\SampletypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SampletypeController implements the CRUD actions for Sampletype model.
 */
class SampletypeController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Sampletype models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SampletypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sampletype model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
    
        if(Yii::$app->request->isAjax){
            return $this->renderAjax('view', [
                    'model' => $this->findModel($id),
                ]);
        }

        //    return $this->render('view', [
        //     'model' => $this->findModel($id),
        // ]);
    }

    /**
     * Creates a new Sampletype model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sampletype();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // if (Yii::$app->request->isAjax){
                 return $this->runAction('index');
          //  }else{
           //      return $this->redirect(['view', 'id' => $model->test_category_id]);
          //   }
           
         } 
           
        if(Yii::$app->request->isAjax){
                 return $this->renderAjax('create', [
                         'model' => $model,
                     ]);
             }
        }

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->sample_type_id]);
        // } else {
        //     return $this->render('create', [
        //         'model' => $model,
        //     ]);
        // }

      
    

    /**
     * Updates an existing Sampletype model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->testcategory_id]);
                } else if (Yii::$app->request->isAjax) {
                    return $this->renderAjax('update', [
                        'model' => $model,
                    ]);
                }
    }

    /**
     * Deletes an existing Sampletype model.
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
     * Finds the Sampletype model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sampletype the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sampletype::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

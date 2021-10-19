<?php

namespace app\controllers;

use app\models\Notas;
use app\models\NotasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NotasController implements the CRUD actions for Notas model.
 */
class NotasController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Notas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NotasSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Notas model.
     * @param int $not_id_not Not Id Not
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($not_id_not)
    {
        return $this->render('view', [
            'model' => $this->findModel($not_id_not),
        ]);
    }

    /**
     * Creates a new Notas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Notas();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'not_id_not' => $model->not_id_not]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Notas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $not_id_not Not Id Not
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($not_id_not)
    {
        $model = $this->findModel($not_id_not);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'not_id_not' => $model->not_id_not]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Notas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $not_id_not Not Id Not
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($not_id_not)
    {
        $this->findModel($not_id_not)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Notas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $not_id_not Not Id Not
     * @return Notas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($not_id_not)
    {
        if (($model = Notas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

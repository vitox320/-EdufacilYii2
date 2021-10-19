<?php

namespace app\controllers;

use app\models\Testes;
use app\models\TestesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TestesController implements the CRUD actions for Testes model.
 */
class TestesController extends Controller
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
     * Lists all Testes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TestesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Testes model.
     * @param int $tes_id_tes Tes Id Tes
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($tes_id_tes)
    {
        return $this->render('view', [
            'model' => $this->findModel($tes_id_tes),
        ]);
    }

    /**
     * Creates a new Testes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Testes();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'tes_id_tes' => $model->tes_id_tes]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Testes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $tes_id_tes Tes Id Tes
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($tes_id_tes)
    {
        $model = $this->findModel($tes_id_tes);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'tes_id_tes' => $model->tes_id_tes]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Testes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $tes_id_tes Tes Id Tes
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($tes_id_tes)
    {
        $this->findModel($tes_id_tes)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Testes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $tes_id_tes Tes Id Tes
     * @return Testes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($tes_id_tes)
    {
        if (($model = Testes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

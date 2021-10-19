<?php

namespace app\controllers;

use app\models\MateriaisCorrecao;
use app\models\MateriaisCorrecaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MateriaisCorrecaoController implements the CRUD actions for MateriaisCorrecao model.
 */
class MateriaisCorrecaoController extends Controller
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
     * Lists all MateriaisCorrecao models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MateriaisCorrecaoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MateriaisCorrecao model.
     * @param int $mac_id_mac Mac Id Mac
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($mac_id_mac)
    {
        return $this->render('view', [
            'model' => $this->findModel($mac_id_mac),
        ]);
    }

    /**
     * Creates a new MateriaisCorrecao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MateriaisCorrecao();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'mac_id_mac' => $model->mac_id_mac]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MateriaisCorrecao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $mac_id_mac Mac Id Mac
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($mac_id_mac)
    {
        $model = $this->findModel($mac_id_mac);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'mac_id_mac' => $model->mac_id_mac]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MateriaisCorrecao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $mac_id_mac Mac Id Mac
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($mac_id_mac)
    {
        $this->findModel($mac_id_mac)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MateriaisCorrecao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $mac_id_mac Mac Id Mac
     * @return MateriaisCorrecao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($mac_id_mac)
    {
        if (($model = MateriaisCorrecao::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

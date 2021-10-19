<?php

namespace app\controllers;

use app\models\Turma;
use app\models\TurmaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TurmaController implements the CRUD actions for Turma model.
 */
class TurmaController extends Controller
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
     * Lists all Turma models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TurmaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Turma model.
     * @param int $tur_id_tur Tur Id Tur
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($tur_id_tur)
    {
        return $this->render('view', [
            'model' => $this->findModel($tur_id_tur),
        ]);
    }

    /**
     * Creates a new Turma model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Turma();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'tur_id_tur' => $model->tur_id_tur]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Turma model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $tur_id_tur Tur Id Tur
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($tur_id_tur)
    {
        $model = $this->findModel($tur_id_tur);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'tur_id_tur' => $model->tur_id_tur]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Turma model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $tur_id_tur Tur Id Tur
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($tur_id_tur)
    {
        $this->findModel($tur_id_tur)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Turma model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $tur_id_tur Tur Id Tur
     * @return Turma the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($tur_id_tur)
    {
        if (($model = Turma::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

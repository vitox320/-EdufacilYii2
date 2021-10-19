<?php

namespace app\controllers;

use app\models\Materiais;
use app\models\MateriaisSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MateriaisController implements the CRUD actions for Materiais model.
 */
class MateriaisController extends Controller
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
     * Lists all Materiais models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MateriaisSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Materiais model.
     * @param int $mat_id_mat Mat Id Mat
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($mat_id_mat)
    {
        return $this->render('view', [
            'model' => $this->findModel($mat_id_mat),
        ]);
    }

    /**
     * Creates a new Materiais model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Materiais();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'mat_id_mat' => $model->mat_id_mat]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Materiais model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $mat_id_mat Mat Id Mat
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($mat_id_mat)
    {
        $model = $this->findModel($mat_id_mat);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'mat_id_mat' => $model->mat_id_mat]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Materiais model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $mat_id_mat Mat Id Mat
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($mat_id_mat)
    {
        $this->findModel($mat_id_mat)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Materiais model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $mat_id_mat Mat Id Mat
     * @return Materiais the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($mat_id_mat)
    {
        if (($model = Materiais::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

<?php

namespace app\controllers;

use app\models\Professores;
use app\models\ProfessoresSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProfessoresController implements the CRUD actions for Professores model.
 */
class ProfessoresController extends Controller
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
     * Lists all Professores models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProfessoresSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Professores model.
     * @param int $pro_id_pro Pro Id Pro
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($pro_id_pro)
    {
        return $this->render('view', [
            'model' => $this->findModel($pro_id_pro),
        ]);
    }

    /**
     * Creates a new Professores model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Professores();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'pro_id_pro' => $model->pro_id_pro]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Professores model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $pro_id_pro Pro Id Pro
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($pro_id_pro)
    {
        $model = $this->findModel($pro_id_pro);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'pro_id_pro' => $model->pro_id_pro]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Professores model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $pro_id_pro Pro Id Pro
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($pro_id_pro)
    {
        $this->findModel($pro_id_pro)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Professores model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $pro_id_pro Pro Id Pro
     * @return Professores the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($pro_id_pro)
    {
        if (($model = Professores::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

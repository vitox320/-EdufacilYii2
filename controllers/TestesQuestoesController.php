<?php

namespace app\controllers;

use app\models\TesteQuestoes;
use app\models\TestesQuestoesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TestesQuestoesController implements the CRUD actions for TesteQuestoes model.
 */
class TestesQuestoesController extends Controller
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
     * Lists all TesteQuestoes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TestesQuestoesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TesteQuestoes model.
     * @param int $tqu_id_tqu Tqu Id Tqu
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($tqu_id_tqu)
    {
        return $this->render('view', [
            'model' => $this->findModel($tqu_id_tqu),
        ]);
    }

    /**
     * Creates a new TesteQuestoes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TesteQuestoes();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'tqu_id_tqu' => $model->tqu_id_tqu]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TesteQuestoes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $tqu_id_tqu Tqu Id Tqu
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($tqu_id_tqu)
    {
        $model = $this->findModel($tqu_id_tqu);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'tqu_id_tqu' => $model->tqu_id_tqu]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TesteQuestoes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $tqu_id_tqu Tqu Id Tqu
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($tqu_id_tqu)
    {
        $this->findModel($tqu_id_tqu)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TesteQuestoes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $tqu_id_tqu Tqu Id Tqu
     * @return TesteQuestoes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($tqu_id_tqu)
    {
        if (($model = TesteQuestoes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

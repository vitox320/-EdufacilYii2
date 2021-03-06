<?php

namespace app\controllers;

use app\components\util\UtilText;
use app\models\Alunos;
use app\models\AlunosSearch;
use Exception;
use Yii;
use yii\base\BaseObject;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AlunosController implements the CRUD actions for Alunos model.
 */
class AlunosController extends Controller
{
    public $layout = 'layout_edufacil';

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'user' => 'user',
                    'only' => ['logout'],
                    'rules' => [
                        [
                            'actions' => ['logout'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],

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
     * Lists all Alunos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AlunosSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Alunos model.
     * @param int $alu_id_alu Alu Id Alu
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($alu_id_alu)
    {
        return $this->render('view', [
            'model' => $this->findModel($alu_id_alu),
        ]);
    }



    /**
     * Updates an existing Alunos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $alu_id_alu Alu Id Alu
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($alu_id_alu)
    {
        $model = $this->findModel($alu_id_alu);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'alu_id_alu' => $model->alu_id_alu]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Alunos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $alu_id_alu Alu Id Alu
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($alu_id_alu)
    {
        $this->findModel($alu_id_alu)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Alunos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $alu_id_alu Alu Id Alu
     * @return Alunos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($alu_id_alu)
    {
        if (($model = Alunos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

<?php

namespace app\controllers;

use app\models\Alunos;
use app\models\Notas;
use app\models\NotasSearch;
use app\models\Turma;
use Yii;
use yii\filters\AccessControl;
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
                'access' => [
                    'class' => AccessControl::className(),
                    'user' => 'user',
                    'only' => ['create', 'index'],
                    'rules' => [
                        [
                            'actions' => ['create', 'index', 'delete', 'update'],
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
     * Lists all Notas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $id_aluno = Yii::$app->user->getIdentity()->alunos;

        $notas = null;
        $turmas = null;
        $aluno = null;
        if (sizeof($id_aluno) != 0) {
            $aluno = Alunos::find()->where(["alu_id_alu" => $id_aluno[0]->alu_id_alu])->one();
            if (!is_null($aluno["alu_id_tur"])) {
                $id_aluno = $aluno["alu_id_tur"];
                $turmas = Yii::$app->db->createCommand("select * from turma left join alunos on tur_id_tur = alu_id_tur where alu_id_alu = $id_aluno")->queryAll();
            }
        }
        return $this->render('index', [
            "notas" => $notas ?? null,
            "turmas" => $turmas ?? null,
            "aluno" => $aluno ?? null
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

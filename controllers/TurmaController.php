<?php

namespace app\controllers;

use app\components\util\UtilText;
use app\models\Alunos;
use app\models\Turma;
use app\models\TurmaSearch;
use Yii;
use yii\db\Exception;
use yii\filters\AccessControl;
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
                'access' => [
                    'class' => AccessControl::className(),
                    'user' => 'user',
                    'only' => ['create', 'index'],
                    'rules' => [
                        [
                            'actions' => ['create', 'index'],
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
     * Lists all Turma models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'layout_edufacil';
        $turmas = null;

        $id_professor = Yii::$app->user->getIdentity()->professores ?? null;
        $id_aluno = Yii::$app->user->getIdentity()->alunos ?? null;


        if (sizeof($id_professor) == 0 && sizeof($id_aluno) == 0) {
            return $this->redirect(["site/index", "user" => "nao_autenticado"]);
        }

        if (sizeof($id_professor) != 0) {
            $turmas = Turma::find()->where(["tur_id_pro" => $id_professor[0]->pro_id_pro])->all();
        }

        if (sizeof($id_aluno) != 0) {
            $aluno = Alunos::find()->where(["alu_id_alu" => $id_aluno[0]->alu_id_alu])->one();
            if (!is_null($aluno["alu_id_tur"])) {
                $turmas = Turma::find()->where(["tur_id_tur" => $aluno["alu_id_tur"]])->all();
            }
        }


        $turma = new Turma();
        return $this->render('index', [
            'turmaModel' => $turma,
            'turmas' => $turmas ?? null,

        ]);
    }

    public function actionCadastraTurma()
    {
        if (sizeof(Yii::$app->user->getIdentity()->professores) == 0) {
            return $this->redirect(["index"]);
        }
        if (Yii::$app->request->isPost) {
            try {
                $turma = new Turma();
                $transaction = Yii::$app->db->beginTransaction();

                $nomeTurma = filter_var(Yii::$app->request->post("Turma")["tur_nom_turma"], FILTER_SANITIZE_SPECIAL_CHARS);

                $turma->tur_nom_turma = $nomeTurma;
                $turma->tur_id_pro = Yii::$app->user->getIdentity()->professores[0]->pro_id_pro;

                if (!$turma->save()) {
                    $transaction->rollBack();
                    throw new \Exception(UtilText::msgTextException($turma, "Turma"));
                }

                $transaction->commit();
                Yii::$app->session->setFlash("success", "Turma cadastrada com sucesso!");
                return $this->redirect(["index", "user" => "professor"]);
            } catch (\Exception $ex) {
                Yii::$app->session->setFlash("danger", UtilText::msgTextFlash($ex));
                $this->redirect(["index", "user" => "professor"]);
            }
        }
    }

    /**
     * Displays a single Turma model.
     * @return mixed
     * @throws Exception
     * @throws \Throwable
     */
    public function actionView()
    {

        $turmas = null;

        $id_professor = Yii::$app->user->getIdentity()->professores;


        if (sizeof($id_professor) == 0) {
            return $this->redirect(["turma/index", "user" => "não autorizado"]);
        }

        $id_turma = Yii::$app->request->get("turma");

        $turma = Turma::findOne($id_turma);
        $alunos = Alunos::buscarAlunosNaoVinculados();

        $alunosVinculadosATurma = Turma::getAlunosVinculadosTurma($turma->tur_id_tur);

        return $this->render('view', [
            'turma' => $turma ?? null,
            'alunos' => $alunos ?? null,
            'id_turma' => $id_turma ?? null,
            'alunosVinculadosATurma' => $alunosVinculadosATurma ?? null
        ]);
    }

    public function actionVinculaAlunoTurma()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $id_turma = Yii::$app->request->post("id_turma");
        $id_aluno = Yii::$app->request->post("id_aluno");

        $aluno = Alunos::findOne($id_aluno);
        $turma = Turma::findOne($id_turma);

        $transaction = Yii::$app->db->beginTransaction();
        try {
            $aluno->alu_id_tur = $id_turma;
            $aluno->alu_id_pro = $turma->tur_id_pro;
            if (!$aluno->save()) {
                throw new Exception(UtilText::msgTextException(new Turma(), "Turma"));
            }

            $transaction->commit();
            Yii::$app->session->setFlash("success", "Aluno Inserido com sucesso");
            return $this->redirect(["turma/view", "turma" => $id_turma]);

        } catch (\Exception $ex) {
            $transaction->rollBack();
            Yii::$app->session->setFlash(UtilText::msgTextFlash($ex));
            return $this->redirect(["turma/view", "turma" => $id_turma]);
        }

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

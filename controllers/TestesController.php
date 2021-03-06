<?php

namespace app\controllers;

use app\components\util\UtilText;
use app\models\Enunciados;
use app\models\Notas;
use app\models\TesteQuestoes;
use app\models\Testes;
use app\models\TestesSearch;
use app\models\Turma;
use Exception;
use Yii;
use yii\base\BaseObject;
use widewhale\debug\vardumper\components\VarDumper;
use yii\filters\AccessControl;
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
                'access' => [
                    'class' => AccessControl::className(),
                    'user' => 'user',
                    'only' => ['create', 'index'],
                    'rules' => [
                        [
                            'actions' => ['create', 'index','ver-teste'],
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
     * Lists all Testes models.
     * @return mixed
     */
    public function actionIndex()
    {
        /*$searchModel = new TestesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);*/
        try {
            $id_turma = Yii::$app->request->get("turma");
            $valida_id = filter_var($id_turma, FILTER_SANITIZE_SPECIAL_CHARS);
            $testes = Testes::find()->where(["tes_id_tur" => $valida_id])->all();
        } catch (Exception $ex) {
            Yii::$app->session->setFlash("danger", $ex->getMessage());
        }


        return $this->render('index', [
            'testes' => $testes ?? null
        ]);
    }


    /**
     * Displays a single Testes model.
     */
    public function actionVerTeste()
    {
        try {
            $id_teste = Yii::$app->request->get("id_teste");
            $enunciados = Enunciados::find()->where(["enu_id_tes" => $id_teste])->all();
            $id_aluno = Yii::$app->user->getIdentity()->alunos[0]->alu_id_alu;
            if (!filter_var($id_teste, FILTER_SANITIZE_SPECIAL_CHARS)) {
                return $this->redirect(["ver-teste", "error" => "Id Inv??lido"]);
            }
            $verificaSeAlunoJaFezTeste = Notas::find()->where(["not_id_tes" => $id_teste])->andWhere(["not_id_alu" => $id_aluno])->all();

            if (!sizeof($verificaSeAlunoJaFezTeste) == 0) {
                Yii::$app->session->setFlash("warning", "Usu??rio j?? efetuou a prova");
                return $this->redirect(["index"]);
            }

        } catch (Exception $ex) {
            Yii::$app->session->setFlash("danger", $ex->getMessage());
            return $this->redirect(["index"]);
        }


        if (Yii::$app->request->isPost) {
            $transaction = Yii::$app->db->beginTransaction();
            try {

                $id_teste = Yii::$app->request->post("id_teste");

                if (!filter_var($id_teste, FILTER_SANITIZE_SPECIAL_CHARS)) {
                    throw new Exception("O teste precisa de um ID v??lido");
                }

                $enunciados = Enunciados::find()->where(["enu_id_tes" => $id_teste])->all();
                $valorProva = 0;

                for ($i = 1; $i <= sizeof($enunciados); $i++) {

                    $alternativas = Yii::$app->request->post("gabaritos$i");

                    if ($alternativas[0] == 1) {
                        $valorProva++;
                    };
                }

                $notas = new Notas();
                $notas->not_id_alu = Yii::$app->user->getIdentity()->alunos[0]->alu_id_alu;
                $notas->not_id_tes = $id_teste;
                $notas->not_valor_nota = $valorProva;
                if (!$notas->save()) {
                    throw new Exception(UtilText::msgTextException($notas, "Notas"));
                }

                $transaction->commit();
                Yii::$app->session->setFlash("success", "<h4> <strong> Teste Realizado com sucesso </strong> </h4>");
                $this->redirect(["testes/index"]);
            } catch (Exception $ex) {
                Yii::$app->session->setFlash("danger", $ex->getMessage());
                $transaction->rollBack();
            }

        }

        return $this->render('view', [
            'enunciados' => $enunciados,
            "id_teste" => $id_teste
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
        $todasAsTurmasOptions = Turma::buscaTodasAsTurmas();
        $enunciados = new Enunciados();

        $id_professor = Yii::$app->user->getIdentity()->alunos;
        $id_aluno = Yii::$app->user->getIdentity()->professores;

        if (sizeof($id_professor) == 0 && sizeof($id_aluno) == 0) {
            return $this->redirect(["site/index", "user" => "nao_autenticado"]);
        }

        if (Yii::$app->request->isPost) {
            $quantidadeEnunciados = sizeof(Yii::$app->request->post("Enunciados")["enu_nom_enunciado"]);
            $quantidadeAlternativas = sizeof(Yii::$app->request->post("TesteQuestoes")["tqu_alternativa"]);

            $titulo = Yii::$app->request->post("Testes")["tes_nome_teste"];
            $turma = Yii::$app->request->post("Turma")["tur_id_tur"];
            $unidade = Yii::$app->request->post("Testes")["tes_unidade_teste"];
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $tituloVerificado = filter_var($titulo, FILTER_SANITIZE_SPECIAL_CHARS);
                if (!$tituloVerificado) {
                    throw new Exception("Insira um t??tulo v??lido");
                }
                $testes = new Testes();
                $testes->tes_nome_teste = $tituloVerificado;
                $testes->tes_id_tur = $turma;
                $testes->tes_valor_teste = $quantidadeEnunciados;
                $testes->tes_unidade_teste = $unidade;
                if (!$testes->save()) {
                    throw new \Exception(UtilText::msgTextException($testes, "Testes"));
                }

                for ($j = 0; $j < $quantidadeEnunciados; $j++) {

                    $enunciadoVerificado = filter_var(Yii::$app->request->post("Enunciados")["enu_nom_enunciado"][$j], FILTER_SANITIZE_SPECIAL_CHARS);
                    if (!$enunciadoVerificado) {
                        throw new \Exception("Insira um enunciado v??lido");
                    }

                    $enunciados = new Enunciados();
                    $enunciados->enu_nom_enunciado = $enunciadoVerificado;
                    $enunciados->enu_valor = 1;
                    $enunciados->enu_id_tes = $testes->tes_id_tes;
                    if (!$enunciados->save()) {
                        throw new \Exception(UtilText::msgTextException($enunciados, "Enunciados"));
                    }

                    for ($i = 0; $i < 5; $i++) {
                        $alternativasVerificadas = filter_var(Yii::$app->request->post("TesteQuestoes")["tqu_alternativa"][$i], FILTER_SANITIZE_SPECIAL_CHARS);
                        if (!$alternativasVerificadas) {
                            throw new \Exception("Insira alternativas v??lidas");
                        }
                        $testesQuestoes = new TesteQuestoes();
                        $testesQuestoes->tqu_alternativa = $alternativasVerificadas;
                        $testesQuestoes->tqu_gabaritos = Yii::$app->request->post("gabarito")[$i];
                        $testesQuestoes->tqu_id_enu = $enunciados->enu_id_enu;
                        if (!$testesQuestoes->save()) {
                            throw new \Exception(UtilText::msgTextException($testesQuestoes, "TesteQuestoes"));
                        }
                    }
                }
                $transaction->commit();
                Yii::$app->session->setFlash("success", "<h4> <b> Teste Criado com sucesso!! </b> </h4>");
                return $this->redirect("create");
            } catch (\Exception $ex) {
                Yii::$app->session->setFlash("danger", $ex->getMessage());
                $transaction->rollBack();

            }

            /*var_dump($quantidadeEnunciados);
            var_dump($quantidadeAlternativas);die;*/
        }

        return $this->render('create', [
            'model' => $model,
            'enunciados' => $enunciados,
            'todasAsTurmasOptions' => $todasAsTurmasOptions
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

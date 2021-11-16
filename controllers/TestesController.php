<?php

namespace app\controllers;

use app\components\util\UtilText;
use app\models\Enunciados;
use app\models\TesteQuestoes;
use app\models\Testes;
use app\models\TestesSearch;
use app\models\Turma;
use Exception;
use Yii;
use yii\base\BaseObject;
use widewhale\debug\vardumper\components\VarDumper;
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
        /*$searchModel = new TestesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);*/

        $testes = Testes::find()->all();

        return $this->render('index', [
            'testes' => $testes
        ]);
    }


    /**
     * Displays a single Testes model.
     */
    public function actionVerTeste()
    {

        $id_teste = Yii::$app->request->get("id_teste");

        $enunciados = Enunciados::find()->where(["enu_id_tes" => $id_teste])->all();

        if (Yii::$app->request->isPost) {
            $id_teste = Yii::$app->request->post("id_teste");
            $enunciados = Enunciados::find()->where(["enu_id_tes" => $id_teste])->all();


            for ($i = 1; $i <= sizeof($enunciados); $i++) {

                $alternativas = Yii::$app->request->post("gabaritos")[$i];

                dump($alternativas);
            }
            die;

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
        if (Yii::$app->request->isPost) {
            $quantidadeEnunciados = sizeof(Yii::$app->request->post("Enunciados")["enu_nom_enunciado"]);
            $quantidadeAlternativas = sizeof(Yii::$app->request->post("TesteQuestoes")["tqu_alternativa"]);


            $titulo = Yii::$app->request->post("Testes")["tes_nome_teste"];
            $turma = Yii::$app->request->post("Turma")["tur_id_tur"];

            $transaction = Yii::$app->db->beginTransaction();
            try {
                $tituloVerificado = filter_var($titulo, FILTER_SANITIZE_SPECIAL_CHARS);
                if (!$tituloVerificado) {
                    throw new Exception("Insira um título válido");
                }
                $testes = new Testes();
                $testes->tes_nome_teste = $tituloVerificado;
                $testes->tes_id_tur = $turma;
                $testes->tes_valor_teste = $quantidadeEnunciados;
                $testes->tes_unidade_teste = null;
                if (!$testes->save()) {
                    throw new \Exception(UtilText::msgTextException($testes, "Testes"));
                }

                for ($j = 0; $j < $quantidadeEnunciados; $j++) {

                    $enunciadoVerificado = filter_var(Yii::$app->request->post("Enunciados")["enu_nom_enunciado"][$j], FILTER_SANITIZE_SPECIAL_CHARS);
                    if (!$enunciadoVerificado) {
                        throw new \Exception("Insira um enunciado válido");
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
                            throw new \Exception("Insira alternativas válidas");
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

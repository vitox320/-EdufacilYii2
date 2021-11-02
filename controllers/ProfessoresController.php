<?php

namespace app\controllers;

use app\components\util\UtilText;
use app\models\Professores;
use app\models\ProfessoresSearch;
use Yii;
use yii\base\BaseObject;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProfessoresController implements the CRUD actions for Professores model.
 */
class ProfessoresController extends Controller
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
        $professor = new Professores();

        if (Yii::$app->request->isPost) {

            $email = Yii::$app->request->post("Professores")["pro_email_professor"];
            $nome = Yii::$app->request->post("Professores")["pro_nome_professor"];
            $senha = Yii::$app->request->post("Professores")["pro_senha_professor"];
            $confirma_senha = Yii::$app->request->post("confirma_senha");

            $transaction = Yii::$app->db->beginTransaction();
            $professor = new Professores();

            try {
                $valida_email = filter_var($email, FILTER_SANITIZE_EMAIL);
                if ($valida_email == false) {
                    throw new \Exception("Email inserido não é válido");
                }
                $valida_nome = filter_var($nome, FILTER_SANITIZE_SPECIAL_CHARS);

                $valida_senha = filter_var($senha, FILTER_SANITIZE_SPECIAL_CHARS);
                $valida_confirma_senha = filter_var($confirma_senha, FILTER_SANITIZE_SPECIAL_CHARS);

                if ($valida_senha != $valida_confirma_senha) {
                    throw  new \Exception("As senhas inseridas precisam ser iguais");
                }

                $professor->pro_email_professor = $valida_email;
                $professor->pro_nome_professor = $valida_nome;
                $professor->pro_senha_professor = Yii::$app->getSecurity()->generatePasswordHash($valida_senha);
                if (!$professor->save()) {
                    throw new \Exception(UtilText::msgTextException($professor, "Professores"));
                }
                $transaction->commit();
                Yii::$app->session->setFlash("success", "<h4>Aluno Registrado com sucesso </h4>");
                return $this->redirect(["site/login","user"=>"professor"]);

            } catch (\Exception $ex) {
                $transaction->rollBack();
                Yii::$app->session->setFlash("danger", $ex->getMessage());
                //Yii::$app->session->setFlash("danger",UtilText::msgTextFlash($ex));
            }


        }

        return $this->render('create', [
            'professor' => $professor,
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

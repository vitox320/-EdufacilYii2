<?php

namespace app\controllers;

use app\components\util\UtilText;
use app\models\Alunos;
use app\models\Professores;
use app\models\Usuarios;
use app\models\UsuariosSearch;
use Exception;
use Yii;
use yii\base\BaseObject;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsuariosController implements the CRUD actions for Usuarios model.
 */
class UsuariosController extends Controller
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
     * Lists all Usuarios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsuariosSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usuarios model.
     * @param int $usu_id_usu Usu Id Usu
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($usu_id_usu)
    {
        return $this->render('view', [
            'model' => $this->findModel($usu_id_usu),
        ]);
    }

    /**
     * Creates a new Usuarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Usuarios();

        $user = Yii::$app->request->get("user");
        if (!isset($user)) {
            $this->redirect(["site/index"]);
        }
        if ($this->request->isPost) {
            $usuario_email = Yii::$app->request->post("Usuarios")["usu_email_usuario"];
            $usuario_nome = Yii::$app->request->post("Usuarios")["usu_nom_usuario"];
            $usuario_senha = Yii::$app->request->post("Usuarios")["usu_senha_usuario"];
            $confirma_senha = Yii::$app->request->post("confirma_senha");
            $user = Yii::$app->request->post("user");

            $transaction = Yii::$app->db->beginTransaction();
            $usuarios = new Usuarios();

            try {
                $valida_email = filter_var($usuario_email, FILTER_SANITIZE_EMAIL);
                if ($valida_email == false) {
                    throw new Exception("Email inserido não é válido");
                }
                $valida_nome = filter_var($usuario_nome, FILTER_SANITIZE_SPECIAL_CHARS);

                $valida_senha = filter_var($usuario_senha, FILTER_SANITIZE_SPECIAL_CHARS);
                $valida_confirma_senha = filter_var($confirma_senha, FILTER_SANITIZE_SPECIAL_CHARS);

                if ($valida_senha != $valida_confirma_senha) {
                    throw  new Exception("As senhas inseridas precisam ser iguais");
                }

                $usuarios->usu_email_usuario = $valida_email;
                $usuarios->usu_nom_usuario = $valida_nome;
                $usuarios->usu_senha_usuario = Yii::$app->getSecurity()->generatePasswordHash($valida_senha);
                if (!$usuarios->save()) {
                    throw new Exception(UtilText::msgTextException($usuarios, "Usuarios"));
                }
                if ($user == "aluno") {
                    $alunos = new Alunos();
                    $alunos->alu_id_usu = $usuarios->usu_id_usu;
                    if(!$alunos->save()){
                        throw new Exception(UtilText::msgTextException($alunos, "Alunos"));
                    }
                }
                if ($user == "professor") {
                    $professores = new Professores();
                    $professores->pro_id_usu = $usuarios->usu_id_usu;
                    if(!$professores->save()){
                        throw new Exception(UtilText::msgTextException($professores, "Professores"));
                    }
                }

                $transaction->commit();
                Yii::$app->session->setFlash("success", "<h4>Usuário Registrado com sucesso </h4>");
                return $this->redirect(["site/login", "user" => "aluno"]);

            } catch (Exception $ex) {
                $transaction->rollBack();
                Yii::$app->session->setFlash("danger", $ex->getMessage());
                //Yii::$app->session->setFlash("danger",UtilText::msgTextFlash($ex));
            }
        }

        return $this->render('create', [
            'model' => $model,
            'user' => $user
        ]);
    }

    /**
     * Updates an existing Usuarios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $usu_id_usu Usu Id Usu
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($usu_id_usu)
    {
        $model = $this->findModel($usu_id_usu);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'usu_id_usu' => $model->usu_id_usu]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Usuarios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $usu_id_usu Usu Id Usu
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($usu_id_usu)
    {
        $this->findModel($usu_id_usu)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Usuarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $usu_id_usu Usu Id Usu
     * @return Usuarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($usu_id_usu)
    {
        if (($model = Usuarios::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

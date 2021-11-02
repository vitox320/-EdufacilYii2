<?php

namespace app\controllers;

use app\models\Alunos;
use app\models\Professores;
use http\Url;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */

    public $layout = 'layout_edufacil';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
                    'logout' => ['get'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionLogin()
    {
        $user = Yii::$app->request->get("user");

        if (!isset($user)) {
            $this->redirect('index');
        }

        if (Yii::$app->request->isPost) {
            $grupoUsuario = Yii::$app->request->post("grupo_usuario");
            $emailUsuario = Yii::$app->request->post("LoginForm")["username"];
            $senhaUsuario = Yii::$app->request->post("LoginForm")["password"];

            try {
                if ($grupoUsuario == "aluno") {
                    $alunos = Alunos::find()->where(["alu_email_alunos" => $emailUsuario])->one();

                    if (is_null($alunos)) {
                        throw new \Exception("Usuário não existe!");
                    }

                    $valida_senha = Yii::$app->getSecurity()->validatePassword($senhaUsuario, $alunos->alu_senha_alunos);
                    if ($valida_senha != true) {
                        throw new \Exception("Senha Incorreta");
                    }

                    Yii::$app->aluno->login($alunos, 3600 * 24 * 30);
                    return $this->redirect(["turma/index", "user" => "aluno"]);

                }

                if ($grupoUsuario == "professor") {
                    $professor = Professores::find()->where(["pro_email_professor" => $emailUsuario])->one();

                    if (is_null($professor)) {
                        throw new \Exception("Usuário não existe!");
                    }

                    $valida_senha = Yii::$app->getSecurity()->validatePassword($senhaUsuario, $professor->pro_senha_professor);
                    if ($valida_senha != true) {
                        throw new \Exception("Senha Incorreta");
                    }

                    Yii::$app->professor->login($professor, 3600 * 24 * 30);
                    return $this->redirect(["turma/index", "user" => "professor"]);
                }
            } catch (\Exception $ex) {
                Yii::$app->session->setFlash("danger", $ex->getMessage());
            }
        }
        return $this->render("login_edufacil", [
            "user" => $user
        ]);
    }


    /**
     * @throws \Exception
     */
    private static function actionInitPermissions()
    {
        $auth = Yii::$app->authManager;

        /*       $user = $auth->createRole()
               $professor = $auth->createRole('professor');
               $aluno = $auth->createRole('aluno');

               $auth->add($professor);
               $auth->add($aluno);

               $turmaCreate = $auth->createPermission('turma/create');
               $turma*/

        //Rotas liberadas para os alunos


    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }


    /*   public function actionLoginz()
       {
           if (!Yii::$app->user->isGuest) {
               return $this->goHome();
           }

           $model = new LoginForm();
           if ($model->load(Yii::$app->request->post()) && $model->login()) {
               return $this->goBack();
           }

           $model->password = '';
           return $this->render('login', [
               'model' => $model,
           ]);
       }*/

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->aluno->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}

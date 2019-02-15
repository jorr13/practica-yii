<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EntryForm;
use app\models\ValidarFormulario;
use app\models\ValidarFormularioAjax;
use yii\widgets\ActiveForm;
use app\models\FormAlumnos;
use app\models\Alumnos;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
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
                    'logout' => ['post'],
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
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
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

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

    /*funcion de prueba*/
    public function actionSay($message = 'hola mundo')
    {
        return $this->render('say', ['message' => $message]);
    }




    public function actionEntry()
    {
        $model = new EntryForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // valid data received in $model

            // do something meaningful here about $model ...

            return $this->render('entry-confirm', ['model' => $model]);
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('entry', ['model' => $model]);
        }
    }

    //curso--------------------------------------------------------------->
    public function actionFormulario($mensaje = null)
    {
        // renderisamos a la vista 
        return $this->render("formulario", ['mensaje'=> $mensaje ]);
    }

    public function actionRequest(){
        // definimos si la variblae existe
        if (isset($_REQUEST["nombre"])) {
            $mensaje = "la vaina funciona al pelo:" . $_REQUEST["nombre"];
        }
        // renderisamos a la vista 
        $this->redirect(["site/formulario", 'mensaje'=> $mensaje ]);
    } 
    
    public function actionValidarformulario(){
        //instanciamos el modelo del formulario
        $model = new ValidarFormulario;
        //preguntamos si enviamos el formulario
        if($model->load(Yii::$app->request->post())){
            //validamos si los datos pasaron la validacion
            if($model->validate()){
                //eejemplo
            }
            else{
                $model->getErrors();
            }
        }
        // renderisamos a la vista 
        return $this->render("validarformulario", ["model" => $model]);
    }
    
    public function actionValidarformularioajax(){
        $model= new ValidarFormularioAjax;
        $msg = null;
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax){
           Yii::$app->response->format= Response::FORMAT_JSON;
           return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                //consulta a bd si pasa el formulario
                //imprimimos el mensaje
                $msg="Los datos enviados son correctos";
                //reiniciamos las variables
                $model->nombre = null;
                $model->email = null;
            }
            //sino tiramos el error
            else{
                $model->getErrors();
            }
        }
        //renderisamos a la vista con el mensaje
        return $this->render("validarformularioajax", ['model' => $model, 'msg' => $msg]);
    }

    //crud------------------------------------>
    public function actionCreate()
    {
        $model= new FormAlumnos;
        $msg = null;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $table = new Alumnos;
                $table->nombre = $model->nombre;
                $table->apellidos = $model->apellidos;
                $table->clase = $model->clase;
                $table->nota_final = $model->nota_final;
                //consulta a bd si pasa el formulario
                if ($table->insert()) {
                    $msg ="Registro correctamente";
                    $model->nombre = null;
                    $model->apellidos = null;
                    $model->clase = null;
                    $model->nota_final = null;
                }
                //sino tiramos el error
                else{
                    $msg ="No se pudo completar el registro";
                }
            }
            //sino tiramos el error
            else{
                $model->getErrors();
            }
        }
        return $this->render("create", ['model' => $model, 'msg' => $msg]);
    }
}

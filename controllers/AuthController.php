<?php


namespace app\controllers;


use app\models\LoginForm;
use app\models\SignUpForm;
use app\models\User;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class AuthController extends Controller
{
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

    public function actionSignup()
    {
        $model = new SignUpForm();

        if($model->load(Yii::$app->request->post()))
        {
            if($model->signUp())
            {
                $this->redirect(['auth/login']);
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionLoginVk($uid, $first_name, $photo)
    {
        $user = new User();
        if($user->saveFromVk($uid, $first_name, $photo))
        {
            return $this->redirect(['site/index']);
        }
    }


    public function actionTest()
    {
        $user = User::findOne(2);

        Yii::$app->user->login($user);

        if(Yii::$app->user->isGuest)
        {
            echo "пользователь гость";
        }
        else
        {
            echo "пользователь авторизован";
        }

    }

}
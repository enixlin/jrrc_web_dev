<?php
namespace app\controllers;

use Yii;

use yii\web\Controller;
//use app\models;


class LoginController extends Controller
{

    public $layout = 'blank';
    // public $defaultAction='show';

    public function actionIndex()
    {
        // $user=new \app\controllers\UserController();
        // $userlist=$user->actionGetAvailableUsersNames();

        // var_dump($userlist);
        return $this->render('index');
    }

    public function actionLogin(){
        
    }


    


}

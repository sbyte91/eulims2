<?php

namespace frontend\modules\finance\controllers;

class BillingController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionManager(){
        return $this->render('manager');
    }
}
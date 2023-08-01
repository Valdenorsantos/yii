<?php

class HolaController extends Controller {
    public function actionIndex()
    {
        // $model= CActiveRecord::model("Users")->findAll(); 
        $model = Users::model()->findAll();
        $twitter = "@softYii";
        $this->render("index", array("model"=>$model,"estudo"=>$twitter ));
    }

   
}

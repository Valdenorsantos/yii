<?php

class AuthItemChildController extends Controller
{
	// public function actionIndex()
	// {
	// 	$this->render('index');
	// }

	// Uncomment the following methods and override them if needed
	
	// public function filters()
	// {
	// 	// return the filter configuration for this controller, e.g.:
	// 	return array(
	// 		'inlineFilterName',
	// 		array(
	// 			'class'=>'path.to.FilterClass',
	// 			'propertyName'=>'propertyValue',
	// 		),
	// 	);
	// }

	// public function actions()
	// {
	// 	// return external action classes, e.g.:
	// 	return array(
	// 		'action1'=>'path.to.ActionClass',
	// 		'action2'=>array(
	// 			'class'=>'path.to.AnotherActionClass',
	// 			'propertyName'=>'propertyValue',
	// 		),
	// 	);
	// }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new AuthItemChild;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AuthItemChild']))
		{
			$model->attributes=$_POST['AuthItemChild'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->name));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('AuthItemChild');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
}
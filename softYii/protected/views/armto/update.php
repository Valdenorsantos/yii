<?php
/* @var $this ArmtoController */
/* @var $model Armto */

$this->breadcrumbs=array(
	'Armamentos'=>array('index'),
	'Armamento' => array('view','id'=>$model->ID),
	'Editar',
);

$this->menu=array(
	array('label'=>'Cadastrar Armamento', 'url'=>array('create')),
	array('label'=>'Visualizar Armamento', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Gerenciar Armamento', 'url'=>array('admin')),
);

//$urlScript = Yii::app()->assetManager->publish(Yii::getPathOfAlias('dpa') . '/css/dpa_main.css');
//Yii::app()->clientScript->registerCssFile($urlScript);

// incluir JavaScript
$baseUrl = Yii::app()->baseUrl; 
Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/regrasDeFormulario.js');

?>

<h1>Alterar Armamento <?php // echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
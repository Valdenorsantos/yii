<?php
/* @var $this ArmtoFotoController */
/* @var $model ArmtoFoto */

$this->breadcrumbs=array(
	'Armamento'=>array('armto/view/id/' . $model->iDARMTO->ID),
	//$model->name=>array('view','id'=>$model->ID),
	'Update',
);

/*
 $this->menu=array(
 
	array('label'=>'Gerenciar fotos', 'url'=>array('admin')),
);
 */
?>

<h1>Substituir foto de armamento</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
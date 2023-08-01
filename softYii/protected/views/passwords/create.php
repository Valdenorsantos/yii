<?php
/* @var $this PasswordsController */
/* @var $model Passwords */

$this->breadcrumbs=array(
	'Passwords'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Passwords', 'url'=>array('index')),
	array('label'=>'Manage Passwords', 'url'=>array('admin')),
);
?>

<h1>Create Passwords</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
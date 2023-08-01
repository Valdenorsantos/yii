<?php
/* @var $this PasswordsController */
/* @var $model Passwords */

$this->breadcrumbs=array(
	'Passwords'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Passwords', 'url'=>array('index')),
	array('label'=>'Create Passwords', 'url'=>array('create')),
	array('label'=>'View Passwords', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Passwords', 'url'=>array('admin')),
);
?>

<h1>Update Passwords <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
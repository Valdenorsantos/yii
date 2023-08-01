<?php
/* @var $this PasswordsController */
/* @var $model Passwords */

$this->breadcrumbs=array(
	'Passwords'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Passwords', 'url'=>array('index')),
	array('label'=>'Create Passwords', 'url'=>array('create')),
	array('label'=>'Update Passwords', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Passwords', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Passwords', 'url'=>array('admin')),
);
?>

<h1>View Passwords #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'location',
		'username',
		'password',
		'DateCreated',
		'LastUpdate',
		'id_user',
	),
)); ?>

<?php
/* @var $this PasswordsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Passwords',
);

$this->menu=array(
	array('label'=>'Create Passwords', 'url'=>array('create')),
	array('label'=>'Manage Passwords', 'url'=>array('admin')),
);
?>

<h1>Passwords</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

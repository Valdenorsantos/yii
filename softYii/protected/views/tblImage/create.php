<?php
/* @var $this TblImageController */
/* @var $model TblImage */

$this->breadcrumbs=array(
	'Tbl Images'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TblImage', 'url'=>array('index')),
	array('label'=>'Manage TblImage', 'url'=>array('admin')),
);
?>

<h1>Create TblImage</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
/* @var $this TblImageController */
/* @var $model TblImage */

$this->breadcrumbs=array(
	'Tbl Images'=>array('index'),
	$model->title=>array('view','id'=>$model->id_image),
	'Update',
);

$this->menu=array(
	array('label'=>'List TblImage', 'url'=>array('index')),
	array('label'=>'Create TblImage', 'url'=>array('create')),
	array('label'=>'View TblImage', 'url'=>array('view', 'id'=>$model->id_image)),
	array('label'=>'Manage TblImage', 'url'=>array('admin')),
);
?>

<h1>Update TblImage <?php echo $model->id_image; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
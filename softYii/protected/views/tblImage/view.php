<?php
/* @var $this TblImageController */
/* @var $model TblImage */

$this->breadcrumbs=array(
	'Tbl Images'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List TblImage', 'url'=>array('index')),
	array('label'=>'Create TblImage', 'url'=>array('create')),
	array('label'=>'Update TblImage', 'url'=>array('update', 'id'=>$model->id_image)),
	array('label'=>'Delete TblImage', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_image),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TblImage', 'url'=>array('admin')),
);
?>

<h1>View TblImage #<?php echo $model->id_image; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_image',
		'title',
		'folder',
		'image',
	),
)); ?>

<?php
/* @var $this TblImageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tbl Images',
);

$this->menu=array(
	array('label'=>'Create TblImage', 'url'=>array('create')),
	array('label'=>'Manage TblImage', 'url'=>array('admin')),
);
?>

<h1>Tbl Images</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

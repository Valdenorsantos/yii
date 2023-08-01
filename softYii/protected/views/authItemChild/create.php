<?php
/* @var $this AuthItemController */
/* @var $model AuthItem */

$this->breadcrumbs=array(
	'Auth Items Childs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AuthItemChild', 'url'=>array('index')),
	array('label'=>'Manage AuthItemChild', 'url'=>array('index')),
);
?>

<h1>Create Auth Item Child</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
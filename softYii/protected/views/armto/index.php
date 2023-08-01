<?php
/* @var $this ArmtoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Armamentos',
);

$this->menu=array(
	array('label'=>'Cadastrar Armamento', 'url'=>array('create')),
	array('label'=>'Gerenciar Armamento', 'url'=>array('admin')),
);
?>

<h1>Lista de Armamentos Cadastrados</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php
/* @var $this ArmtoFotoController */
/* @var $model ArmtoFoto */

$this->breadcrumbs=array(
	'Armto Fotos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ArmtoFoto', 'url'=>array('index')),
	array('label'=>'Create ArmtoFoto', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#armto-foto-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gerenciamento da Fotos dos Armamentos</h1>

<?php /* echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
 */ ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'armto-foto-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
                array(
                    'name'=>'Nro de série',
                    'value'=>'$data->iDARMTO->NUMSERIE;',
                    'filter'=>false,
                ),
                array(
                    'name'=>'Tombo',
                    'value'=>'$data->iDARMTO->TOMBO;',
                    'filter'=>false,
                ),
		array(
                    'name'=>'Imagem',
                    'value'=>'$data->getprintFoto(90,67);',
                    'filter'=>false,
                ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

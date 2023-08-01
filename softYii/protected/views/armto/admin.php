<?php
/* @var $this ArmtoController */
/* @var $model Armto */

$this->breadcrumbs = array(
    //'Armamentos'=>array('index'),
    'Armamentos',
);

$this->menu = array(
    array('label' => 'Cadastrar Armamento', 'url' => array('create')),
//    array('label' => 'Listar Transferências', 'url' => array('armtoTransferencia/admin')),
//    array('label' => 'Receber Armamento', 'url' => array('armtoTransferencia/index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('input[name=\"Pesquisar\"]').click(function() {
    $('#armto-grid').yiiGridView('update', {
        data: $('.search-form form').serialize()
    });
});


");
?>

<h1>Gerenciar Armamentos</h1>

<?php echo CHtml::link('Pesquisar','#',array('class'=>'search-button')); ?>
<div class="search-form">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'armto-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        /*
          array(
          'name' => 'ID',
          'value' => '$data->ID',
          'filter'=>false,
          ),
         */
      
//		'FOTO',
//		'IDSITUACAO',
//		'OCORRENCIA',
//		'OBSERVACAO',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>

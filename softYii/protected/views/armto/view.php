<?php
/* @var $this ArmtoController */
/* @var $model Armto */

$this->breadcrumbs=array(
	'Armamentos'=>array('index'),
	//$model->ID,
        'Visualizar armamento',
);

$this->menu=array(
	array('label'=>'Cadastrar Armamento', 'url'=>array('create')),
	array('label'=>'Alterar Armamento', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Deletar Armamento', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Gerenciar Armamento', 'url'=>array('admin')),
        array('label'=>'Transferir Armamento', 'url'=>array('armtoTransferencia/create', 'id'=>$model->ID)),
        array('label'=>'Histórico do Armamento', 'url'=>array('armtoHistorico/admin', 'id'=>$model->ID)),
        array('label'=>'Cautelar Armamento', 'url'=>array('historicoCautela/create', 'id'=>$model->ID)),
);
$jquery_zoom= Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('webroot.node_modules.jquery-zoom'));
$baseUrl = $jquery_zoom;
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl . '/jquery.zoom.min.js');

?>

<?php
// Busca a pessoa para mostrar formulário sem campos, apenas com dados.
 $model_foto = ArmtoFoto::model()->findByPk($model->ID);
 ?>

<h1>Visualizar Armamento Cadastrado <?php // echo $model->ID; ?></h1>

<?php /* $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'NUMSERIE',
		'TOMBO',
		'TIPO',
		'MARCA',
		'CALIBRE',
		'MODELO',
		'IDLOTACAO',
		'IDSITUACAO',
		'OCORRENCIA',
		'OBSERVACAO',
	),
));
 */ ?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));

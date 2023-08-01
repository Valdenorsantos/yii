<?php
/* @var $this ArmtoFotoController */
/* @var $model ArmtoFoto */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'armto-foto-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<?php echo $form->errorSummary($model); ?>
        <?php /*
	<div class="row">
		<?php echo $form->labelEx($model,'ID_ARMTO'); ?>
		<?php echo $form->textField($model,'ID_ARMTO'); ?>
		<?php echo $form->error($model,'ID_ARMTO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'size'); ?>
		<?php echo $form->textField($model,'size'); ?>
		<?php echo $form->error($model,'size'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textField($model,'content'); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>
        */ ?>
        <div class="row">
		<?php echo $form->labelEx($model,'foto'); ?>
		<?php echo $form->fileField($model, 'foto'); ?>
		<?php echo $form->error($model,'foto'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Criar' : 'Confirmar'); ?>
                <?php 
                $url =  $this->createUrl('armto/view', array ('id'=>$model->iDARMTO->ID), '&');
                echo CHtml::button("Cancelar", array('onClick' => 'window.location.href=\'' . $url . '\'')); 
                ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
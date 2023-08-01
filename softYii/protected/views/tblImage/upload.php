<?php
/* @var $this TblImageController */
/* @var $model TblImage */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', 
			array(
				'id'=>'tbl-image-form',
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// There is a call to performAjaxValidation() commented in generated controller code.
				// See class documentation of CActiveForm for details on this.
				// 'enctype' => 'multipart/form-data',
				'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'folder'); ?>
		<?php echo $form->textField($model,'folder',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'folder'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php
			$this->widget('CMultiFileUpload', array(
				'model'=>$model,
				'name'=>'image',
				'attribute'=>'image',
				'accept'=>'jpg|gif|png|pdf',
				'denied' => 'O tipo de arquivo não é permitido',
				'max'=> 2,
				'duplicate' => 'Arquivo duplicado',
				
			));
		?>
	
		<?php echo $form->error($model,'image'); ?>
	</div>		
	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

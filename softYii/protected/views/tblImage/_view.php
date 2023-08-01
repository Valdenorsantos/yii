<?php
/* @var $this TblImageController */
/* @var $data TblImage */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_image')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_image), array('view', 'id'=>$data->id_image)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('folder')); ?>:</b>
	<?php echo CHtml::encode($data->folder); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('image')); ?>:</b>
	<?php echo CHtml::encode($data->image); ?>
	<br />


</div>
<?php
/* @var $this ArmtoController */
/* @var $model Armto */
/* @var $form CActiveForm */

if (!defined('SELECIONE')) {
    DEFINE('SELECIONE', ' - Todos(as) - ');
}
if (!isset($arrselecione)) {
    $arrselecione = array(null => SELECIONE);
}
?>

<div class="form">
    
<?php $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
));?>
    Para realizar a pesquisa preencha um ou mais campos que deseja filtrar.


    <br><br><br>
    
    <fieldset>
        <legend>Dados de Identificação</legend>
        <div>

            <?php //echo $form->label($model,'ID'); ?>
            <?php //echo $form->textField($model,'ID', array('placeholder' => 'Todos'));  ?>

            <?php echo $form->label($model, 'NUMSERIE'); ?>
            <?php echo $form->textField($model, 'NUMSERIE', array('placeholder' => 'todos', 'class' => 'form-control')); ?>
            
            <?php echo $form->label($model, 'TOMBO'); ?>
            <?php echo $form->textField($model, 'TOMBO', array('placeholder' => 'todos', 'class' => 'form-control')); ?>

        </div>
    </fieldset>
    <fieldset>
        <legend>Caracteristicas Físicas</legend>
        <div style="display: inline-block">
            Tipo
            <?php
            $model_auxModelo = new AuxArmtoModelo;
            $lista_tipo = AuxArmtoModelo::model()->getListTipo();
            echo $form->dropDownList($model, 'TIPO', $lista_tipo, ['class' => 'form-control']);
            ?>

            <?php echo $form->label($model, 'MARCA'); ?>
            <?php
            // echo $form->textField($model,'MARCA'); 
            $marca = new AuxArmtoMarca();
            $lista_marca = $arrselecione + CHtml::listData($marca::model()->findAll(), 'ID', 'MARCA');
            echo $form->dropDownList($model, 'MARCA', $lista_marca, ['class' => 'form-control']);
            ?>

            <?php echo $form->label($model, 'CALIBRE'); ?>
            <?php
            // echo $form->textField($model,'CALIBRE'); 
            $calibre = new AuxArmtoCalibre();
            $lista_calibre = $arrselecione + CHtml::listData($calibre::model()->findAll(), 'ID', 'CALIBRE');
            echo $form->dropDownList($model, 'CALIBRE', $lista_calibre, ['class' => 'form-control']);
            ?>

            <?php echo $form->label($model, 'MODELO'); ?>
            <?php
            // echo $form->textField($model,'MODELO'); 
            $modelo = new AuxArmtoModelo();
            $lista_modelo = $arrselecione + CHtml::listData($modelo::model()->findAll(), 'ID', 'MODELO');
            echo $form->dropDownList($model, 'MODELO', $lista_modelo, ['class' => 'form-control']);
            ?>
        </div>
    </fieldset>

    <fieldset>
        <legend>OPM</legend>
        <div style="display: inline-block">

            <?php echo $form->label($model, 'IDLOTACAO'); ?>
            <?php
            // echo $form->textField($model,'IDLOTACAO'); 

            /*
              $lotacoes = new AuxLotacoes();
              $lista_lotacoes = $arrselecione + CHtml::listData($lotacoes::model()->findAll(), 'ID', 'NOME');
              echo $form->dropDownList($model, 'IDLOTACAO', $lista_lotacoes);
             */

            // Identificar lotação do usuário
            $pessoa_usuario_logado = Pessoas::model()->findByAttributes(array('cpf' => Yii::app()->user->username));
	    if (isset($pessoa_usuario_logado->lotacao)) {
		    $codom_usuario_logado = $pessoa_usuario_logado->lotacao->COD_PRODAM;
		    $lotacoes_filhas = AuxLotacoes::model()->findAllByAttributes(array('PARENT' => $codom_usuario_logado));
		    $lotacoes_apresentaveis = array();
		    array_push($lotacoes_apresentaveis, $pessoa_usuario_logado->lotacao);
		    $lotacaos_apresentaveis = array_merge($lotacoes_apresentaveis, AuxLotacoes::loop_recursivo($lotacoes_filhas));
            
	    } else {
		    
		    $codom_usuario_logado = AuxLotacoes::model()->findByPk(1)->COD_PRODAM;
		    $lotacoes_filhas = AuxLotacoes::model()->findAllByAttributes(array('PARENT' => $codom_usuario_logado));
		    $lotacoes_apresentaveis = array();
		    $lotacaos_apresentaveis = array_merge($lotacoes_apresentaveis, AuxLotacoes::loop_recursivo($lotacoes_filhas));
	    }

            
            // Listar Lotações filhas e a atual do usuário
            $lista_lotacoes = ['' => ' - Todas - '] + CHtml::listData($lotacaos_apresentaveis, 'ID', 'NOME');
	    if (isset($pessoa_usuario_logado)) {
				echo $form->dropDownList($model, 'IDLOTACAO', $lista_lotacoes, [
						'options' => array($pessoa_usuario_logado->lotacao->ID => array('selected'=>true)),
						
						'class' => 'form-control',
				]);
	    } else {
		    echo $form->dropDownList($model, 'IDLOTACAO', $lista_lotacoes, ['class' => 'form-control']);
	    }
            ?>
        </div>
    </fieldset>

    <fieldset>
        <legend>Status do Armamento</legend>
        <div style="display: inline-block">

            <?php echo $form->label($model, 'IDSITUACAO'); ?>
            <?php
            // echo $form->textField($model,'IDSITUACAO'); 
            $situacao = new AuxArmtoSituacao();
            $lista_situacao = $arrselecione + CHtml::listData($situacao::model()->findAll(), 'ID', 'DESCR');
            echo $form->dropDownList($model, 'IDSITUACAO', $lista_situacao, ['class' => 'form-control']);
            ?>

            <?php /*
              <?php echo $form->label($model,'OCORRENCIA'); ?>
              <?php echo $form->textField($model,'OCORRENCIA',array('size'=>30,'maxlength'=>30)); ?>

              <?php echo $form->label($model,'OBSERVACAO'); ?>
              <?php echo $form->textArea($model,'OBSERVACAO',array('rows'=>6, 'cols'=>50)); ?>
             */ ?>
        </div>
    <div class="row">
<div class="col-md-5">
        <?php echo CHtml::button('Pesquisar', array('name' => 'Pesquisar', 'class' => 'btn btn-primary form-control')); ?>
			</div>
<div class="col-md-5 col-md-offset-2">
        <?php echo CHtml::button('Relatório em PDF', array('name' => 'Relatorio', 'class' => 'btn btn-default form-control')); ?>
			</div>
    </div>
    </fieldset>
    <?php // echo $form->label($model_foto,'fotos');      ?>
    <?php // echo $form->textField($model_foto,'fotos');   ?>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->

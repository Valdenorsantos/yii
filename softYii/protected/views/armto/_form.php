<?php
/* @var $this ArmtoController */
/* @var $model Armto */
/* @var $form CActiveForm */

if (!defined('SELECIONE')) {
    DEFINE('SELECIONE', ' - Selecione - ');
}
if (!isset($arrselecione)) {
    $arrselecione = array(null => SELECIONE);
}
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'armto-form',
    'enableAjaxValidation' => true,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
));
?>

<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

<?php echo $form->errorSummary($model); ?>

<div class="form" style="width: auto; background-color: #EEE;  -webkit-border-radius: 5px; border: 1px solid #808080; padding: 10px;">

    <fieldset>
        <legend>Dados Gerais</legend>
        <div class="row">

           
           



           
   
            

    <fieldset>
        <legend>Imagem do Armamento</legend>
        <div class="form-group">
<?php
// Caso esteja no formulário de update
if ($this->action->Id == 'update') {

    // Localiza fotos do modelo
    $model_foto = ArmtoFoto::model()->findByAttributes(array('ID_ARMTO' => $model->ID));

    // Caso já exista foto
    if ($model_foto != null) {
        $i = 0;

        // Exibir fotos existentes
        foreach ($model->armtofoto as $foto) {

            echo '<div name="thumb' . $i++ . '" class="armtofotothumbnail">';
            echo '<img src = "data:' . $foto->type . ';base64, ' . base64_encode($foto->content) . '"  width="320" height="240"/><br><center>';
            echo CHtml::link("Substituir", Yii::app()->createurl('/armtoFoto/update/id/' . $foto->ID));
            echo '</center></div>';
        }
    }
} else { // Caso não exista foto
    echo $form->labelEx($model, 'fotos');
    echo '<br><strong>Adicione 1 fotos para habilitar o botão Cadastrar.</strong>';
    //echo $form->fileField($model, 'fotos', true);
    echo '<div class="alert alert-info">Tamanho máximo de cada fotografia: 1 MB. Utilize imagens de extensão jpg, jpeg ou png.</div>';
    $this->widget('CMultiFileUpload', array(
        'id' => 'fotos',
        'name' => 'fotos',
        'accept' => 'jpeg|jpg|png', // useful for verifying files
        'duplicate' => 'Arquivo em duplicidade!', // useful, i think
        'denied' => 'Tipo de arquivo inválido.', // useful, i think
        'options' => array(
            'max' => 1,
            'afterFileSelect' => 'function(e ,v ,m){
                var fileSize = e.files[0].size;
                if(fileSize>1024*1024){
                    alert("Tamanho máximo permitido para cada arquivo: 1 MB");
                    $(".MultiFile-remove").click();
}
return true;
}',
                    ),
                ));
echo $form->error($model, 'fotos');
}
?>
        </div>
    </fieldset>
    <div class="row">
        <div class="col-md-4">

            <center>
<?php
if ($model->isNewRecord) {
    echo CHtml::submitButton(($model->isNewRecord ? 'Cadastrar' : 'Salvar'), ['class' => 'form-control btn btn-primary']);
} else {
    echo CHtml::submitButton(($model->isNewRecord ? 'Cadastrar' : 'Salvar'), ['class' => 'form-control btn btn-primary']);
}
?>
            </center>
        </div>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->

<script>
$(document).ready(function () {

    $('body').on('DOMNodeInserted', 'input', function (e) {
        if ($('input[id^="fotos_"]').length == 0) {
            $('input[name="yt0"]').css('display', 'block');
        }
    });
    $('body').on('DOMNodeRemoved', 'input', function (e) {
        if ($('input[id^="fotos_"]').length <= 1) {
            $('input[name="yt0"]').css('display', 'none');
        }
    });

});

aposSelecionarModelo = function (a) {
    var qtModelos = $('select#Armto_MODELO option').size();

    if (qtModelos === 1) {
        jQuery.ajax({
        // The url must be appropriate for your configuration;
        // this works with the default config of 1.1.11
        url: '/comandopmam/index.php/armamento/Armto/dynamiccalibre',
            type: "POST",
            //dataType: "xml",
            cache: false,
            data: {ajaxData: $('#armto-form').serialize()},
            error: function (xhr, tStatus, e) {
                alert("Houve um erro na consulta. Favor usar navegador atualizado e compatível com AJAX. ");
                alert(tStatus + "   " + e.message);
            },
            success: function (data) {
                $('#CALIBRE').html(data);
            }
    });
    }

};
</script>

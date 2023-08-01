<?php
/* @var $this ArmtoController */
/* @var $data Armto */
#$baseUrl = Yii::app()->baseUrl;
#$cs = Yii::app()->getClientScript();
#$cs->registerScriptFile($baseUrl . '/js/zoom-master/jquery.zoom.min.js');
?>

<div class="form" style="width: auto; background-color: #EEE;  -webkit-border-radius: 5px; border: 1px solid #808080; padding: 10px; margin-bottom: 15px;">
    <fieldset>
        <fieldset>
            <legend>Dados de Identificação</legend>
            <div style="display: inline-block">

                <?php
                /*
                  <b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
                  <?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id' => $data->ID)); ?>
                  <br />
                 */
                ?>

                <b><?php echo CHtml::encode($data->getAttributeLabel('NUMSERIE')); ?>:</b>
                <?php echo CHtml::encode($data->NUMSERIE); ?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      
                <b><?php echo CHtml::encode($data->getAttributeLabel('TOMBO')); ?>:</b>
                <?php echo CHtml::encode($data->TOMBO); ?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <b>OPM:</b><?php //echo CHtml::encode($data->getAttributeLabel('IDLOTACAO'));             ?>
                <?php echo CHtml::encode($data->auxLotacao->NOME); ?>

            </div>
        </fieldset>

        <fieldset class="menuitemright" style="margin-left: 10px;">
            <legend>Imagem do Armamento</legend>
            <div style="display: inline-block">
                <div id="armtofotoconteiner" class="armtofotoconteiner">
                    <?php
                    $i = 0;
                    foreach ($data->armtofoto as $foto) {
                        // Pegar tamanho da imagem a partir da string content
                        $arrSize = getimagesizefromstring($foto->content);
                        // retornará array onde [0] é largura e [1] é altura
                        // Instancia dimension informando atributos de largura e altura da imagem
                        $imgDimension = new Dimension((int) $arrSize[0], (int) $arrSize[1]);
                        $maxDimension = new Dimension(415, 330);

                        // Dimension
                        $imgscalecalc = new ImgScaleCalc();
                        $imgNovoTamanhoDimension = $imgscalecalc->calcScale($imgDimension, $maxDimension);

                        echo '<div name="foto' . $i . '" class="boxarmtofoto ' . (($i === 0) ? 'fotoon' : 'fotooff') . '"> ';
                        echo '<img src = "data:' . $foto->type . ';base64, ' . base64_encode($foto->content) . '"  width="' . $imgNovoTamanhoDimension->getWidth() . '" height="' . $imgNovoTamanhoDimension->getHeight() . '"/>';
                        echo '</div>';
                        $i++;
                    }
                    ?>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Características Físicas</legend>
            <div style="display: inline-block">

                <b><?php echo CHtml::encode($data->getAttributeLabel('TIPO')); ?>:</b>
                <?php echo CHtml::encode($data->auxModelo->getTipo()); ?>
                <br />    

                <b><?php echo CHtml::encode($data->getAttributeLabel('MARCA')); ?>:</b>
                <?php echo CHtml::encode($data->auxMarca->MARCA); ?>
                <br />

                <b><?php echo CHtml::encode($data->getAttributeLabel('CALIBRE')); ?>:</b>
                <?php echo CHtml::encode($data->auxCalibre->CALIBRE); ?>
                <br />

                <b><?php echo CHtml::encode($data->getAttributeLabel('MODELO')); ?>:</b>
                <?php echo CHtml::encode($data->auxModelo->MODELO); ?>
                <br />

                <b><?php echo CHtml::encode($data->getAttributeLabel('QTCARREGADORES')); ?>:</b>
                <?php echo CHtml::encode($data->QTCARREGADORES); ?>
                <br />
            </div>
        </fieldset>

        <fieldset>
            <legend>Status do Armamento</legend>
            <div style="display: inline-block">
                <b><?php echo CHtml::encode($data->getAttributeLabel('IDSITUACAO')); ?>:</b>
                <?php echo CHtml::encode($data->auxSituacao->DESCR); ?>
                <br />
                <b><?php echo CHtml::encode($data->getAttributeLabel('OCORRENCIA')); ?>:</b>
                <?php echo CHtml::encode($data->OCORRENCIA); ?>
                <br />
                <b><?php echo CHtml::encode($data->getAttributeLabel('OBSERVACAO')); ?>:</b>
                <?php echo CHtml::encode($data->OBSERVACAO); ?>
                <br />

            </div>
        </fieldset>

        <fieldset>
            <legend>Fotos</legend>
            <div class="armtofotothumbconteiner">
                <?php
                $i = 0;
                foreach ($data->armtofoto as $foto) {
                    // Pegar tamanho da imagem a partir da string content
                    $arrSize = getimagesizefromstring($foto->content);
                    // retornará array onde [0] é largura e [1] é altura
                    // Instancia dimension informando atributos de largura e altura da imagem
                    $imgDimension = new Dimension((int) $arrSize[0], (int) $arrSize[1]);
                    $maxDimension = new Dimension(90, 67);

                    // Dimension
                    $imgscalecalc = new ImgScaleCalc();
                    $imgNovoTamanhoDimension = $imgscalecalc->calcScale($imgDimension, $maxDimension);

                    echo '<div name="thumb' . $i++ . '" class="armtofotothumbnail"> ';
                    echo '<img src = "data:' . $foto->type . ';base64, ' . base64_encode($foto->content) . '"  width="' . $imgNovoTamanhoDimension->getWidth() . '" height="' . $imgNovoTamanhoDimension->getHeight() . '"/>';
                    //echo CHtml::link("Substituir", Yii::app()->createurl('/armamento/armtoFoto/update/id/' . $foto->ID));
                    echo '</div>';
                }
                ?>
            </div>
        </fieldset>
    </fieldset>
</div>
<script>
    $(document).ready(function () {

        //$('#armtofotoconteiner').zoom(); //{url: 'photo-big.jpg'}
        $('[name=foto0]').zoom({magnify: 2});

        $('[name^=thumb]').each(function (index, ele) {

            $(this).click(function () {

                // Esconde todas as fotos
                $('[name^=foto]').slideUp('fast');
                $('[name^=foto]').trigger('zoom.destroy'); // remove zoom
                $('[name=foto' + index + ']').slideDown('fast');
                $('[name=foto' + index + ']').zoom({magnify: 2}); // Adiciona zoom

            }); // end of mouseover
        }); // end of each
    }); // end of ready
</script>

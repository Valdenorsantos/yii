<?php
/* @var $this ArmtoController */
/* @var $model Armto */

$this->breadcrumbs = array(
        'Armamentos' => array('index'),
        'Cadastrar',
);

$this->menu = array(
        array('label' => 'Gerenciar Armamento', 'url' => array('admin')),
);
?>

<h1>Cadastro de Imagem</h1>

<?php
$this->renderPartial('_form', array('model' => $model));


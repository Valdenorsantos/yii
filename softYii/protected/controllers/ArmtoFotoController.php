<?php

class ArmtoFotoController extends Controller {

    /**
     * @var string O layout padrão para as visualizações. O padrão é '// layouts / column2', o que significa
     * usando o layout de duas colunas. Consulte 'protected / views / layouts / column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * Filtros do accessControl
     * 
     * Este metodo é utilizado pelo Framework para utilizar o accessControl nas actions.
     * 
     * @return array Filtros de ação
     */
    public function filters() {
        return array(
            'accessControl', // Executar controle de acesso para operações CRUD
            'accessControl', // Executar controle de acesso para operações CRUD, que pesquisa e consulta ou arquivos de dados
            'postOnly + delete', // Request só permitimos a exclusão via solicitação POST 
        );
    }

    /**
     * Especifica as regras de controle de acesso.
     * 
     * Este método é usado pelo filtro 'accessControl' para especificar regras de controle de acesso as actions.
     * 
     *@return array Regras de controle de acesso as actions de controle.
     */
    public function accessRules() {
        return array(
            array('allow', // Permite que todos os usuários executem ações de 'índice' e 'visualização'
                'actions' => array('Dynamicquadros', 'Dynamiccidades'),
                'users' => array('*'),
            ),
            array('allow', // Permitir que o usuário administrador execute ações 'admin' e 'delete'
                'actions' => array('create', 'admin', 'update', 'index'),
              
            ),
            array('allow', // Permitir que o usuário administrador execute ações 'admin' e 'delete'
                'actions' => array('create', 'admin', 'update', 'view'),
               
            ),
            array('allow', // Permitir que o usuário administrador execute ações 'admin' e 'delete'
                'actions' => array('admin', 'delete'),
                
            ),
            array('deny', //  Negar todos os usuários
                'users' => array('*'),
            ),
        );
    }

    /**
     * Atualiza um modelo específico.
     * 
     * Este metodo modifica uma foto de armamento que possui determinado Id,
     * Se a atualização for bem sucedida, o navegador será redirecionado para a página 'visualizar'.
     * 
     * @param integer $id o ID do model a ser atualizado
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        // O if está retonando se a variável existe ou não foto

        if (isset($_POST['ArmtoFoto'])) {
            $model->attributes = $_POST['ArmtoFoto'];
            $arquivo = CUploadedFile::getInstance($model, 'foto');

            // Verifica se a variável é existente
            if (!is_null($arquivo)) {
                
                // Recebe os dados do arquivo enviado
                $model->name = $arquivo->name;
                $model->type = $arquivo->type;
                $model->size = $arquivo->size;

                $filetemp = $arquivo->tempName;
                $fo = fopen($filetemp, 'r');
                $read = fread($fo, $arquivo->size);
                fclose($fo);
                $model->content = $read;

            }
            if ($model->save())
                $this->redirect(
                        array('armto/view', 'id'=>$model->ID_ARMTO)
                        );
        }
        //Renderiza imagens

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Exclui a foto do armamento
     * 
     * Exclui imagem do armamento que tem determinado Id, 
     * Se a exclusão for bem sucedida, o navegador será redirecionado para a página 'admin'.
     * 
     * @param integer $ id o ID do modelo a ser excluído,
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

      
        //se a solicitação AJAX (acionada pela exclusão via visualização da grade do administrador), não devemos redirecionar o navegador)
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Gerencia todos os models de fotos de armamentos.
     *   
     * Gerencia todos as fotos de armamentos e possibilita realizar pesquisas.
     */
    public function actionAdmin() {
        $model = new ArmtoFoto('search');
        $model->unsetAttributes();  // limpe todos os valores padrão
        if (isset($_GET['ArmtoFoto']))
            $model->attributes = $_GET['ArmtoFoto'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Carrega o model da foto do armamento
     * 
     * Retorna o model de dados com base na chave primária fornecida na variável GET,
     * Se o model de dados não for encontrado, uma exceção HTTP será gerada.
     * 
     * @param integer $id o ID do model a ser carregado
     * @return ArmtoFoto do model carregado
     * @throws CHttpExceptio
     */
    public function loadModel($id) {
        $model = ArmtoFoto::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Validação do padrão da imagem.
     * 
     * Execute uma validação AJAX.
     * 
     * @param ArmtoFoto $ model ou model validado
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'armto-foto-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}

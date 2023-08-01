<?php

class ArmtoController extends Controller {

    /**
     * Layout Padrão
     * 
     * Padrão para '//layouts/column2', significa 
     * usar duas colunas como layout como padrão. Ver 'protected/views/layouts/column2.php'.
     * 
     * @var string layout padrão para as views. 
     */
    public $layout = '//layouts/column2';

    /**
     * Filtro
     * 
     * Filtros usados pelo Framework para o AccessControl
     *  
     * @return array retorna para o array filtros de ação
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Especifica as regras de controle de acesso.
     * 
     * Este método é usado pelo filtro 'accessControl.' para especificar as regras de acesso às actions.
     * 
     * @return array regras de controle de acesso.
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('Dynamicmodelo', 'Dynamiccalibre'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('index', 'create', 'admin', 'update', 'view'),
               // 'expression' => '$user->checkAccess(\'armamento_admin\')'
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin'),
               // 'expression' => '$user->checkAccess(\'armamento_admin\')'
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Exibir um model específico de arma
     * 
     * Exibe o modelo da arma de acordo com a ID.
     * 
     * @param integer $id o ID do modelo está sendo exibido.
     */
    public function actionView($id) {

        // Por questão de segurança aqui deverá ser verificado a qual OPM o usuário
        // pertence, para que seja listados apenas armamentos de sua OPM.

        $dataProvider = new CActiveDataProvider('Armto', array(
            'criteria' => array(
                'condition' => "ID = $id",
        )));

        $this->render('view', array(
            'model' => $this->loadModel($id),
            'dataProvider' => $dataProvider,
        ));

//        // Registra que o usuário visualizou o armamento
//        ArmtoHistorico::registra($id, 'Visualizou armamento.');
    }

    /**
     * Criar um novo model arma.
     * 
     * Se a criação for bem sucedida, o browser será redirecionado para a 'view' page.
     * Cria um novo model(Armamento) e após a criação, o usuário retorna para a página de visualização.
     */
    public function actionCreate() {
        $model = new Armto;
        $model_foto = array();
        $arrModelFoto = array();

        if (isset($_POST['Armto'])) { // Caso tenha submetido formulário
            $transaction = $model->getDbConnection()->beginTransaction();

            try {
                $model->attributes = $_POST['Armto'];

                $this->performAjaxValidation($model); // Valida via AJAX

                $arrArquivos = CUploadedFile::getInstancesByName('fotos');

                // Percorrer todas as fotos
                for ($i = 0; $i < count($arrArquivos); $i++) {
                    if (!is_null($arrArquivos[$i])) {
                        $model_foto = new ArmtoFoto;


                        // Recebe os dados do arquivo enviado
                        $model_foto->name = $arrArquivos[$i]->name;
                        $model_foto->type = $arrArquivos[$i]->type;
                        $model_foto->size = $arrArquivos[$i]->size;

                        $filetemp = $arrArquivos[$i]->tempName;
                        $fo = fopen($filetemp, 'r');
                        $read = fread($fo, $arrArquivos[$i]->size);
                        fclose($fo);
                        $model_foto->content = $read;

                        // Adiciona Models de Fotos ao array $arrModelFoto
                        array_push($arrModelFoto, $model_foto);
                    } else {
                        throw new Exception('É obrigatório enviar imagem no cadastro de nova arma.');
                    }
                }

               

                // Tenta salvar Armamento e Fotos
                if ($model->save()) {
                    // ID do armamento é gerado neste ponto
                    // Percorrer todos os models de $arrModelFoto
                    foreach ($arrModelFoto as $mf) {
                        $mf->ID_ARMTO = $model->ID; // Id do armamento
                        // Tenta salvar fotos
                        if (!is_null($mf)) {
                            $mf->save();
                        }
                    }

                    $transaction->commit();

                  

                    // redirect to success page
                    $this->redirect(array('view', 'id' => $model->ID));
                } else {
                    $model->validate();
                    $transaction->rollback();
                }
            } catch (Exception $ex) {
                $model->validate();
                $model->addError('Exception', $ex->getMessage());
                $transaction->rollback();
                // Retornar erro via modelo indicando que não foi salvo
            }
        }
        $this->render('create', array(
            'model' => $model,
            'model_foto' => $model_foto,
        ));
    }

    /**
     * Atualizar um model específico de arma.
     * 
     * Se a criação for bem sucedida, o browser será redirecionado para a 'view' page.
     * Atualiza as informações da arma após a seleção do modelo específico da mesma pelo usuário.
     * 
     * @param integer $id o ID do model que será modificado
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $model_foto = ArmtoFoto::model()->findByAttributes(array('ID_ARMTO' => $id));

        // Pega o model antigo para registrar no histórico
        $hist_model_antigo = Armto::model()->findByPk($id);

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);
        if (is_null($model_foto)) {
            $model_foto = new ArmtoFoto();
        }



        if (isset($_POST['Armto'])) {
            $model->attributes = $_POST['Armto'];
            $nome_do_arquivo = CUploadedFile::getInstance($model, 'fotos');

            if (!is_null($nome_do_arquivo)) {
                $model_foto->name = $nome_do_arquivo->name;
                $model_foto->type = $nome_do_arquivo->type;

                switch ($model_foto->type) {
                    case 'image/jpeg':
                    case 'image/png':
                        break;
                    default:
                        $model->addError('fotos', 'Formato de imagem não aceito, utilize JPG ou PNG');
                        break;
                }

                $model_foto->size = $nome_do_arquivo->size;
                $filetemp = $nome_do_arquivo->tempName;
                $fo = fopen($filetemp, 'r');
                $read = fread($fo, $nome_do_arquivo->size);
                fclose($fo);
                $model_foto->content = $read;
            }

            $transaction = $model->getDbConnection()->beginTransaction();
            if ($model->save()) {
                $model_foto->ID_ARMTO = $model->ID;
                if (!is_null($nome_do_arquivo)) {
                    $model_foto->save();
                }
                $transaction->commit();

                // Registra modificações comparando atributos antigos com os novos para verificar se há modificações
                ArmtoHistorico::registra($id, 'Modificou armamento: ', $hist_model_antigo, $model);

                $this->redirect(array('view', 'id' => $model->ID));
            } else {
                $model->validate();
                //$model_foto->validate();
                $transaction->rollback();
            }
        }
        $this->render('update', array(
            'model' => $model,
            'model_foto' => $model_foto,
        ));
    }

    /**
     * Excluir um modelo específico de arma
     * 
     * Se a exclusão for bem-sucedida, o browser será redirecionada para a 'admin' page.
     * Exclui o cadastro de uma arma do sistema após a seleção de um modelo específico pelo usuário e registra 
     * qual usuário fez essa rotina.
     * 
     * * @param integer $id o ID do model será deletado.
     */
    public function actionDelete($id) {

        // Registra que o usuário deletou o armamento
        $hist_model_antigo = Armto::model()->findByPk($id);
        ArmtoHistorico::registra($id, 'Deletou armamento: ' . print_r($hist_model_antigo));

        // Deleta o armamento
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lista todos os models de armas
     * 
     * Redireciona o usuário para a actionAdmin para visualizar os modelos das armas.     * 
     */
    public function actionIndex() {
//        $dataProvider = new CActiveDataProvider('Armto');
//        $this->render('index', array(
//            'dataProvider' => $dataProvider,
//        ));
        $this->redirect('armto/admin');
    }

    /**
     * Gerencia todos os models de armas
     * 
     * Inicialmente lista todos os modelos das armas de acordo com lotação do usuário logado.
     */
    public function actionAdmin() {
        $model = new Armto('search');
        $pessoa_usuario_logado = Pessoas::model()->findByAttributes(array('cpf' => Yii::app()->user->username));
        $model->unsetAttributes();  // clear any default values
        // Começa listando armamentos da própria lotação
	if (isset($model->lotacao)) {
		$model->IDLOTACAO = $pessoa_usuario_logado->lotacao->ID;
	}
        if (isset($_GET['Armto']))
            $model->attributes = $_GET['Armto'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Carrega um model de armamento que contem um determinado ID
     * 
     * Retorna o model de dados para a primeira chave na variável GET.
     * Se o model de dados não for encontrado, uma exceção HTTP será gerada.
     * Lista o model das armas.
     * 
     * @param integer $id o Id do model será carregada.
     * @return Armto Retorna para o model Armto.
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Armto::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Executa a validação AJAX
     * 
     * @param Armto $model o model será validada.
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'armto-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    /**
     * Consulta do modelo da arma
     * 
     * Consulta o modelo da arma, selecionada através do campo MARCA.
     */
    public function actionDynamicmodelo() {
        // Consulta as informacoes atraves da selecao no campo MARCA na tabela Rel_Marca_Modelo
        $modelo_array = AuxArmtoRelMarcaModelo::model()->findAll('IDMARCA=:codmarca', array(':codmarca' => (int) $_POST['Armto']['MARCA']));
        // cria-se um array vazio para salvar os dados necessarios temporariamente
        $array_models_modelos = array();

        if (!isset($arrselecione)) {
            $arrselecione = array(null => ' - Selecione - ');
        }


        foreach ($modelo_array as $relacao) {
            array_push($array_models_modelos, $relacao->MODELO);
        }

        if (count($modelo_array) !== 1) {
            $data_array = $arrselecione + CHtml::listData($array_models_modelos, 'ID', 'MODELO');
        } else {
            $data_array = CHtml::listData($array_models_modelos, 'ID', 'MODELO');
        }

        foreach ($data_array as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }
    /**
     * Consulta o calibre da arma
     * 
     * Lista o calibre da arma de acordo com o modelo, gerando um HTML com options.
     * 
     * @return string código HTML para ser incluído em um dropdown
     */
    public function actionDynamiccalibre() {
        
        /**
         * Rotina para automatizar a seleção quando houver apenas um calibre disponível para o modelo selecionado
         */
        $armto_post = array();
        if (isset($_POST['ajaxData'])) {
            $query = urldecode($_POST['ajaxData']);

            foreach (explode('&', $query) as $chunk) {
                $param = explode("=", $chunk);
                $armto_post[$param[0]] = $param[1];
            }
            $calibre_array = AuxArmtoRelCalibreModelo::model()->findAll('IDMODELO=:codmodelo', array(':codmodelo' => (int) $armto_post['Armto[MODELO]']));
        } else {
            $calibre_array = AuxArmtoRelCalibreModelo::model()->findAll('IDMODELO=:codmodelo', array(':codmodelo' => (int) $_POST['Armto']['MODELO']));
        }
             
        // Consulta as informacoes atraves da selecao no campo MARCA na tabela Rel_Marca_Modelo
        
        // cria-se um array vazio para salvar os dados necessarios temporariamente
        $array_models_calibres = array();

        foreach ($calibre_array as $relacao) {
            array_push($array_models_calibres, $relacao->iDCALIBRE);
        }

        if (!isset($arrselecione)) {
            $arrselecione = array(null => ' - Selecione - ');
        }

        if (count($calibre_array) !== 1) {
            $data_array = $arrselecione + CHtml::listData($array_models_calibres, 'ID', 'CALIBRE');
        } else {
            $data_array = CHtml::listData($array_models_calibres, 'ID', 'CALIBRE');
        }
        foreach ($data_array as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }

}

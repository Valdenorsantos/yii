<?php

/**
 * This is the model class for table "armto".
 *
 * The followings are the available columns in table 'armto':
 * @property integer $ID
 * @property integer $NUMSERIE
 * @property integer $TOMBO
 * @property integer $TIPO
 * @property integer $MARCA
 * @property integer $CALIBRE
 * @property integer $MODELO
 * @property integer $QTCARREGADORES
 * @property integer $IDLOTACAO
 * @property integer $IDSITUACAO
 * @property string $OCORRENCIA
 * @property string $OBSERVACAO
 *
 * The followings are the available model relations:
 
 * @property ArmtoFoto[] $armtofoto
 */
class Armto extends CActiveRecord {

    public $fotos = array(); // Conterá todas as fotos do Armamento
  
    /**
     * @return string the associated database table name
     */
    public function tableName() {
	    return 'armto';
    }

    

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('', 'required'),
            array('NUMSERIE, TOMBO', 'unique'),
            array('MARCA, CALIBRE, MODELO, IDLOTACAO, IDSITUACAO, TIPO, QTCARREGADORES', 'numerical', 'integerOnly' => true),
            array('OCORRENCIA', 'length', 'max' => 30),
            array('OBSERVACAO', 'length', 'max' => 60),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ID, NUMSERIE, TOMBO, MARCA, CALIBRE, MODELO, IDLOTACAO, IDSITUACAO, OCORRENCIA, OBSERVACAO, COR', 'safe', 'on' => 'search'),
            // array('fotos', 'file', 'types'=>'jpg, png', 'on'=>'create'),
            array('fotos', 'file', 'on' => 'insert',
                'allowEmpty' => true,
                'types' => 'jpg, png',
                'maxSize' => 1024 * 5, // 500kb                
                'tooLarge' => 'O arquivo é maior que 1MB. Por favor envie uma imagem menor.',
            ),
            array('fotos', 'file', 'on' => 'update',
                'allowEmpty' => true,
                'types' => 'jpg, png',
                'maxSize' => 1024 * 500, // 500kb                
                'tooLarge' => 'O arquivo é maior que 1MB. Por favor envie uma imagem menor.',
            ),
          
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
          
            'armtofoto' => array(self::HAS_MANY, 'ArmtoFoto', 'ID_ARMTO'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'NUMSERIE' => 'N. de Série',
            'TOMBO' => 'Tombo',
            'MARCA' => 'Marca',
            'CALIBRE' => 'Calibre',
            'MODELO' => 'Modelo',
            'QTCARREGADORES' => 'Quant. Carregadores',
            'IDLOTACAO' => 'Lotação',
            'IDSITUACAO' => 'Situação',
            'OCORRENCIA' => 'Ocorrência',
            'OBSERVACAO' => 'Observação',
            'COR' => 'Cor do armamento'
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('ID', $this->ID);
       
        $criteria->compare('COR', $this->COR, false);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

   

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Armto the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    protected function beforeSave() {
        if (parent::beforeSave()) {
            
            /*
             *  Copia o valor do atributo TIPO (0=>curta ou 1=>longa), referente ao modelo da arma,
             * para o objeto Armto
             */
            $this->TIPO = $this->auxModelo->TIPO;
            
            return true;
        } else {
            return false;
        }
        
    }

}

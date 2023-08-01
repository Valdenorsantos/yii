<?php

/**
 * This is the model class for table "armto_foto".
 *
 * The followings are the available columns in table 'armto_foto':
 * @property integer $ID
 * @property integer $ID_ARMTO
 * @property string $name
 * @property integer $size
 * @property string $type
 * @property string $content
 *
 * The followings are the available model relations:
 * @property Armto $iDARMTO
 */
class ArmtoFoto extends CActiveRecord {

    public $foto;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'armto_foto';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ID_ARMTO, name, size, type, content', 'required'),
            array('ID_ARMTO, size', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 255),
            array('type', 'length', 'max' => 15),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ID, ID_ARMTO, name, size, type, content', 'safe', 'on' => 'search'),
            array('foto', 'file', 'on' => 'update',
                'allowEmpty' => true,
                'types' => 'jpg, jpeg, png',
                'maxSize' => 1024 * 1024 * 5, // 5MB                
                'tooLarge' => 'O arquivo é maior que 5MB. Por favor envie uma imagem menor.',
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
            'iDARMTO' => array(self::BELONGS_TO, 'Armto', 'ID_ARMTO'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'ID_ARMTO' => 'Id Armto',
            'name' => 'Name',
            'size' => 'Size',
            'type' => 'Type',
            'content' => 'Content',
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
        $criteria->compare('ID_ARMTO', $this->ID_ARMTO);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('size', $this->size);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('content', $this->content, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ArmtoFoto the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getprintFoto($maxwidth, $maxheight) {
        $foto = $this;
        
        // Pegar tamanho da imagem a partir da string content
        $arrSize = getimagesizefromstring($foto->content);
        // retornará array onde [0] é largura e [1] é altura
        // Instancia dimension informando atributos de largura e altura da imagem
        $imgDimension = new Dimension((int) $arrSize[0], (int) $arrSize[1]);
        $maxDimension = new Dimension($maxwidth, $maxheight);

        // Dimension
        $imgscalecalc = new ImgScaleCalc();
        $imgNovoTamanhoDimension = $imgscalecalc->calcScale($imgDimension, $maxDimension);

        //echo '<div name="thumb' . $i++ . '" class="armtofotothumbnail"> ';
        echo '<img src = "data:' . $foto->type . ';base64, ' . base64_encode($foto->content) . '"  width="' . $imgNovoTamanhoDimension->getWidth() . '" height="' . $imgNovoTamanhoDimension->getHeight() . '"/>';
        //echo CHtml::link("Substituir", Yii::app()->createurl('/armamento/armtoFoto/update/id/' . $foto->ID));
        //echo '</div>';
    }

}

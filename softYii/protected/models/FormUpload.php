<?php

class FormUpload extends CFormModel 
{
    public $title;
    public $image;

    /**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(
                'title,folder,image','required',
                 'message' => 'este campo é obrigatório',
                ),
			array('title, folder, image', 'length', 'max'=>120),
            array('image', 'file', 'types' => 'jpg, gif,png, pdf',
                  'max'=> 1024 * 1024 * 1, //1MB
                  'toLarge' => 'O tamanho máximo permitido das imagens é 1MB',
                  'allowEmpty' => true,
                ),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_image, title, folder, image', 'safe', 'on'=>'search'),
		);
	}
    
}
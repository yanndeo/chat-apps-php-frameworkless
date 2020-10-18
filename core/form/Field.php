<?php
namespace app\core\form;

use app\core\Model;

class Field{

    public const TYPE_TEXT = 'text';
    public const TYPE_NUMBER = 'number';
    public const TYPE_PASSWORD = 'password';

    public Model $model;
    public string $attribute;
    public string $type ;

    public function __construct(Model $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        $this->model = $model;
        $this->attribute = $attribute;
    }


    public function __toString()
    {
        return sprintf('
            <div class="form-group %s">
                <label>%s</label>
                <input type="%s" name="%s" value="%s" class="form-control" >
                <span class="text-danger"> %s </span>
            </div>
        ',
            $this->model->hasError($this->attribute) ? 'has-error' : '', //check error
            $this->attribute,  //label
            $this->type, //type input
            $this->attribute,  //name
            $this->model->{$this->attribute}, //value
            $this->model->getFirstError($this->attribute)
        );
    }




    public function passwordTypeField()
    {
        $this->type = self::TYPE_PASSWORD ; 
        return $this;
    }


}
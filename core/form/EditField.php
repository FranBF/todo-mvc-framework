<?php

namespace app\core\form;

use app\core\Model;

class EditField{

    public Model $model;
    public string $attribute;
    public $defValue;

    public function __construct(Model $model, $attribute, $defValue){
        $this->model = $model;
        $this->attribute = $attribute;
        $this->defValue = $defValue;
    }

    public function __toString(){
        return sprintf('
            <div>
                <label>%s</label>
                <input type="text" name="%s" value="%s">
                <div>%s</div>
            </div>
        ', $this->attribute, $this->attribute, $this->model->{$this->attribute}, $this->model->getFirstError($this->attribute));
    }
    
}
<?php

namespace app\core\form;

use app\core\Model;

class Field{

    public Model $model;
    public string $attribute;
    public string $type;

    public function __construct(Model $model, $attribute, $type){
        $this->model = $model;
        $this->attribute = $attribute;
        $this->type = $type;
    }

    public function __toString(){
        return sprintf('
            <div>
                <label clas="font-bold text-[12px] mr-6">%s</label>
                <input class="w-36 border-[1px] border-black h-8" type="%s" name="%s" value="%s">
                <div>%s</div>
            </div>
        ', $this->attribute, $this->type, $this->attribute, $this->model->{$this->attribute}, $this->model->getFirstError($this->attribute));
    }
    
}
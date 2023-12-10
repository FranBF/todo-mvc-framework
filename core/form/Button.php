<?php

namespace app\core\form;

use app\core\Model;

class Button{

    public Model $model;
    public string $attribute;
    public int $id;
    public string $label;
    public function __construct(Model $model, $attribute, int $id, string $label){
        $this->model = $model;
        $this->attribute = $attribute;
        $this->id = $id;
        $this->label = $label;
    }

    public function __toString(){
        return sprintf('
                <button class="text-white bg-red-400 w-24 h-12" name="%s" value="%s" type="submit">%s</button>
        ', $this->attribute, $this->id, $this->label);
    }
    
}
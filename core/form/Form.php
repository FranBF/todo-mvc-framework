<?php

namespace app\core\form;

use app\core\form\Field;
use app\core\form\Button;
use app\core\Model;

class Form{

    public static function begin($action, $method){
        echo sprintf('<form class="w-full h-full flex justify-between items-center flex-col" action ="%s" method="%s">', $action, $method);
        return new Form();
    }

    public static function end(){
        echo '</form>';
    }

    public function field(Model $model, $attribute, $type){
        return new Field($model, $attribute, $type);
    }

    public function editField(Model $model, $attribute, $defValue){
        return new Field($model, $attribute, $defValue);
    }

    public function button(Model $model, $attribute, $id, $label){
        return new Button($model, $attribute, $id, $label);
    }
}
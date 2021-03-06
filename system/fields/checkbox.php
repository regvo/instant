<?php

class fieldCheckbox extends cmsFormField {

    public $title       = LANG_PARSER_CHECKBOX;
    public $sql         = 'TINYINT(1) UNSIGNED NULL DEFAULT NULL';
    public $filter_type = 'int';

    public function parse($value){
        return htmlspecialchars(($value ? LANG_YES : LANG_NO));
    }

    public function applyFilter($model, $value) {
        return $model->filterEqual($this->name, 1);
    }

}
<?php

class widgetCbrf extends cmsWidget {
    public function run() {
        $today=date(cmsConfig::get('date_format'));
        $this->title = 'Курсы валют на '.$today;
        $file = simplexml_load_file("http://www.cbr.ru/scripts/XML_daily.asp?date_req=" . date("d/m/Y"));
        if($file!=''){
            $valutes = array();
            foreach ($file AS $el){
                $valutes[strval($el->CharCode)] = strval($el->Value);
            }
            return array(
                'USD'=>$valutes['USD'],
                'EUR'=>$valutes['EUR']
            );        
        }
        return array();
    }
}


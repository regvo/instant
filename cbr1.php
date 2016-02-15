<?php

$file = simplexml_load_file("http://www.cbr.ru/scripts/XML_daily.asp?date_req=".date("d/m/Y"));

$valutes = array();

foreach ($file AS $el){
    $valutes[strval($el->CharCode)] = strval($el->Value);
}
//print_r($valutes);
print $valutes['USD'] . '<br/>' . $valutes['EUR'];

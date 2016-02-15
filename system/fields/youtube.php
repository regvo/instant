<?php

class fieldYoutube extends cmsFormField
{
    public $title = 'Ссылка на видео с youtube';
    public $sql = 'varchar(200) NULL DEFAULT NULL';
    public $filter_type = false;
    public $filter_hint = false;
	
    public function parse($value){
	
	if (preg_match('/[?&]v=([-_a-z0-9]{11})/i', trim($value), $m) || preg_match('/be\/([-_a-z0-9]{11})/i', trim($value), $m)){
	
        return '<p><iframe width="640" height="360" src="//www.youtube.com/embed/'.htmlspecialchars($m[1]).'?wmode=transparent" frameborder="0" allowfullscreen></iframe></p>';
		}
		else {
		return 'Указана неверная ссылка';
		}
    }
}

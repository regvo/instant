<?php

class onShredirectError404 extends cmsAction {

    public function run(){
        
        $model = cmsCore::getModel('shredirect');
        
        $res = $model->getShredirectItem('/'.cmsCore::getInstance()->uri);
        
        if($res['header'] === '301'){
            header("HTTP/1.0 301 Moved Permanently");
            header("HTTP/1.1 301 Moved Permanently");
            header("Status: 301 Moved Permanently");
            header("Location: ".$res['link_to']);
            die();
        }
        
	if($res['header'] === '410'){
            header("HTTP/1.1 410 Gone");
            header("Status: 410 Gone");

            if(ob_get_length()) { ob_end_clean(); }

            cmsTemplate::getInstance()->renderAsset('errors/notfound');
            die();
        }
        
        $mask = $model->getShredirectMask();
        if($mask){
            $len = 0; $redirect_to = false;
            foreach($mask as $m){
                $item = str_replace("*", "", $m['link_from']);
                $pos = strpos('/'.cmsCore::getInstance()->uri, $m['link_from']);
                if(strlen($m['link_from']) > $len){
                    $len = strlen($m['link_from']);
                    $redirect_to = $m['link_to'];
                }
            }
            if($redirect_to){
                header("HTTP/1.0 301 Moved Permanently");
                header("HTTP/1.1 301 Moved Permanently");
                header("Status: 301 Moved Permanently");
                header("Location: ".$redirect_to);
                die();
            }
        }
        
        return;
        
    }

}

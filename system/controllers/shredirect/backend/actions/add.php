<?php

class actionShredirectAdd extends cmsAction {
 
    public function run(){
        
        if(!$this->request->isAjax()){ cmsCore::error404(); }
        
        if(preg_match('/^\/[0-9a-zA-Zа-яёА-ЯЁ\-\_\.\/\*?&=]+$/u', $this->request->get('link_from'))){
            if(preg_match('/[\/\*]+$/u', $this->request->get('link_from'))){
                $type = '2';
            }elseif(preg_match('/^\/[0-9a-zA-Zа-яёА-ЯЁ\-\_\.\/?&=]+$/u', $this->request->get('link_from'))){
                $type = '1';
            }else{
                $res['error']['incorrect_link_from'] = 1;
            }
        }else{
            $res['error']['incorrect_link_from'] = 1;
        }
        
        if(!preg_match('/^\/[0-9a-zA-Zа-яёА-ЯЁ\-\_\.\/?&=]+$/u', $this->request->get('link_to')) AND $this->request->get('header') != '410')
                $res['error']['incorrect_link_to'] = 1;
        
        $link_to = $this->request->get('link_to');
        if($this->request->get('header') === '410'){
            $link_to = '--//--';
        }
        
        if(!isset($res['error'])){
        
            $model = cmsCore::getModel('shredirect');

            $data = array(
                'link_from' => $this->request->get('link_from'),
                'type'      => $type,
                'link_to'   => $link_to,
                'header'    => $this->request->get('header')
            );

            if($model->addShredirect($data)){
                $res['reply'] = LANG_SHREDIRECT_SUCCESS_ADD;
            }else{
                $res['error']['bd'] = LANG_SHREDIRECT_ERROR_BD;
            }
        
        }
        
        echo json_encode($res);
        
        die();
        
    }
 
}

<?php

class actionShredirectDelete extends cmsAction {
 
    public function run($id){
        
        if(!is_numeric($id)){ cmsCore::error404(); }
        
        $model = cmsCore::getModel('shredirect');

        $model->deleteShredirect($id);
        
        $this->redirectBack();
        
    }
 
}
<?php

class actionShredirectIndex extends cmsAction {
 
    public function run(){
        
        $template = cmsTemplate::getInstance();
        
        $grid = $this->loadDataGrid('shredirect');
        
        return $template->render('backend/index',
            array(
                'grid' => $grid
            )
        );
        
    }
 
}
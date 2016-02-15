<?php

class actionShredirectList extends cmsAction {
 
    public function run(){
        
        if(!$this->request->isAjax()){ cmsCore::error404(); }
        
        $grid = $this->loadDataGrid('shredirect');
        
        $model = cmsCore::getModel('shredirect');
        
        $model->setPerPage(admin::perpage);
        
        $filter = array();
        
        $filter_str = $this->request->get('filter', '');
        
        if($filter_str){
            parse_str($filter_str, $filter);
            $model->applyGridFilter($grid, $filter);
        }
        
        $total = $model->getShredirectCount();
        
        $perpage = isset($filter['perpage']) ? $filter['perpage'] : admin::perpage;
        
        $pages = ceil($total / $perpage);
        
        $redirects = $model->getShredirect();
        
        $template = cmsTemplate::getInstance();
        
        $template->renderGridRowsJSON($grid, $redirects, $total, $pages);
        
        die();
        
    }
 
}
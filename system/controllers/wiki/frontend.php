<?php
class wiki extends cmsFrontend {

    protected $useOptions = false;
	
	public function onEngineStart($item){
		$template 	= cmsTemplate::getInstance();
		$template->addCSS('templates/default/css/wiki.css');
		$template->addJS('templates/default/js/wiki.js');
	}
	
	public function onContentBeforeItem($item){
		$item[2]['content']['html'] = $this->model->parseTags($item[1]['content']);
		return $item;
	}
	
	public function actionInfo(){
	
		if (!$this->request->isAjax()){ cmsCore::error404(); }
		
		$text = $this->request->get('text');
		$text_url = urlencode($text);
		
		$data = file_get_contents("http://ru.wikipedia.org/w/api.php?action=opensearch&prop=info&format=json&inprop=url&search={$text_url}");
		$data = json_decode($data,1);
		
		$rows = array();
		if(!empty($data[1])){
			foreach($data[1] as $key => $item){
				$rows[] = array(
					'title' => $data[1][$key],
					'description' => $data[2][$key],
					'link' => $data[3][$key],
				);
			}
		}
		
		echo cmsTemplate::getInstance()->renderInternal($this, 'dialog', array(
            'rows' => $rows,
            'title' => (isset($data[0]) ? $data[0] : $text),
        ));		
		exit;
	}
    
}

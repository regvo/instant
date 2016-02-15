<?php

class modelShredirect extends cmsModel{
    
    public function addShredirect($data){
        $res = $this->getItemByField('shredirect', 'link_from', $data['link_from']);
        if($res['id']){
            return $this->update('shredirect', $res['id'], $data);
        }else{
            return $this->insert('shredirect', $data);
        }
    }
    
    public function getShredirectItem($from){
        return $this->getItemByField('shredirect', 'link_from', $from);
    }
    
    public function getShredirect(){
        return $this->get('shredirect');
    }
    
    public function getShredirectMask(){
        $this->filterEqual('type', '2');
        return $this->get('shredirect');
    }
    
    public function getShredirectCount(){
        return $this->getCount('shredirect');
    }
    
    public function deleteShredirect($id){
        return $this->delete('shredirect', $id);
    }
    
}

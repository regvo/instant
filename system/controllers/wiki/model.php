<?php
class modelWiki extends cmsModel {

    public function parseTags($content){

        $content = preg_replace('#<wiki>#s','<span class="wiki_controller info" >',$content);
        $content = preg_replace('#<\/wiki>#s','</span>',$content);
		return $content;
		
    }

}

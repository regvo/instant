<?php
class widgetContentList extends cmsWidget {

    public function run(){

        $ctype_id        = $this->getOption('ctype_id');
        $dataset_id      = $this->getOption('dataset');
        $cat_id          = $this->getOption('category_id');
        $image_field     = $this->getOption('image_field');
        $teaser_field    = $this->getOption('teaser_field');
        $is_show_details = $this->getOption('show_details');
        $style           = $this->getOption('style', 'basic');
        $limit           = $this->getOption('limit', 10);
        $teaser_len      = $this->getOption('teaser_len', 100);

        $model = cmsCore::getModel('content');

        $ctype = $model->getContentType($ctype_id);
        if (!$ctype) { return false; }

		if ($cat_id){
			$category = $model->getCategory($ctype['name'], $cat_id);
		} else {
			$category = false;
		}

        if ($dataset_id){

            $dataset = $model->getContentDataset($dataset_id);

            if ($dataset){
                $model->applyDatasetFilters($dataset);
            } else {
                $dataset_id = false;
            }

        }

		if ($category){
			$model->filterCategory($ctype['name'], $category, true);
		}

        // Приватность
        // флаг показа только названий
        $hide_except_title = (!empty($ctype['options']['privacy_type']) && $ctype['options']['privacy_type'] == 'show_title');

        // Сначала проверяем настройки типа контента
        if (!empty($ctype['options']['privacy_type']) && in_array($ctype['options']['privacy_type'], array('show_title', 'show_all'), true)) {
            $model->disablePrivacyFilter();
            if($ctype['options']['privacy_type'] != 'show_title'){
                $hide_except_title = false;
            }
        }

        // А потом, если разрешено правами доступа, отключаем фильтр приватности
        if (cmsUser::isAllowed($ctype['name'], 'view_all')) {
            $model->disablePrivacyFilter(); $hide_except_title = false;
        }

        // Скрываем записи из скрытых родителей (приватных групп и т.п.)
        $model->filterHiddenParents();

		list($ctype, $model) = cmsEventsManager::hook("content_list_filter", array($ctype, $model));
		list($ctype, $model) = cmsEventsManager::hook("content_{$ctype['name']}_list_filter", array($ctype, $model));

        $items = $model->
                    limit($limit)->
                    getContentItems($ctype['name']);
        if (!$items) { return false; }

        if($style){
            $this->setTemplate('list_'.$style);
        } else {
            $this->setTemplate($this->tpl_body);
        }

        return array(
            'ctype'             => $ctype,
            'hide_except_title' => $hide_except_title,
            'teaser_len'        => $teaser_len,
            'image_field'       => $image_field,
            'teaser_field'      => $teaser_field,
            'is_show_details'   => $is_show_details,
            'style'             => $style,
            'items'             => $items
        );

    }

}

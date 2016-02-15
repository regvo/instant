<?php

function grid_shredirect($controller){
 
    return array(
        'options' => array(
                        'is_sortable' => false,
                        'is_filter' => true,
                        'is_pagination' => true,
                        'is_draggable' => false,
                        'order_by' => 'id',
                        'order_to' => 'desc',
                        'show_id' => true
                    ),
        'columns' => array(
                        'id' => array(
                            'title' => 'id',
                            'width' => 30,
                            'filter' => 'exact'
                        ),
                        'link_from' => array(
                            'title' => LANG_SHREDIRECT_FROM,
                            'filter' => 'like'
                        ),
                        'link_to' => array(
                            'title' => LANG_SHREDIRECT_TO,
                            'filter' => 'like'
                        ),
                        'header' => array(
                            'title' => LANG_SHREDIRECT_TYPE,
                            'filter' => 'like'
                        )
                    ),
        'actions' => array(
                        array(
                            'title' => LANG_SHREDIRECT_DELETE,
                            'class' => 'delete',
                            'href' => href_to($controller->root_url, 'delete', '{id}'),
                            'confirm' => LANG_SHREDIRECT_CONFIRM_DELETE,
                        ),
                    )
    );
    
}
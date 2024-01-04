<?php

function jtpl_function_html_paginate_first($tpl,$params) {

    $_id = 'default';
    $_attrs = array();
    
    foreach($params as $_key => $_val) {
        switch($_key) {
            case 'id':
                $_id = $_val;
                break;
            default:
                $_attrs[] = $_key . '="' . $_val . '"';
                break;   
        }
    }
   

    if (!jSmartyPaginate::isConnected($_id)) {
		throw new Exception("paginate_first: SmartyPaginate is not initialized, use connect() first");
    }
    if (jSmartyPaginate::getTotal($_id) === false) {
		throw new Exception("paginate_first: total was not ");
    }
    
    $_url = jSmartyPaginate::getURL($_id);
    
    $_attrs = !empty($_attrs) ? ' ' . implode(' ', $_attrs) : '';    

	if(($_item = jSmartyPaginate::getPrevPageItem($_id)) !== false) {
		$_show = true;
		$_text = isset($params['text']) ? $params['text'] : jSmartyPaginate::getFirstText($_id);
		$_url .= (strpos($_url, '?') === false) ? '?' : '&';
		$_url .= jSmartyPaginate::getUrlVar($_id) . '=1';
   	} else {
        $_show = false;   
    }
    echo $_show ? '<a href="' . str_replace('&','&amp;', $_url) . '"' . $_attrs . '>' . $_text . '</a>' : '';
}

?>

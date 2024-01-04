<?PHP
class jSmartyPaginate {

    /**
     * Class Constructor
     */
    function jSmartyPaginate() { }

    /**
     * initialize the session data
     *
     * @param string $id the pagination id
     * @param string $formvar the variable containing submitted pagination information
     */
    static function connect($id = 'default', $formvar = null) {
        if(!isset($_SESSION['SmartyPaginate'][$id])) {
            self::reset($id);
        }
        
        // use $_GET by default unless otherwise specified
        $_formvar = isset($formvar) ? $formvar : $_GET;
        
        // set the current page
        $_total = self::getTotal($id);
        if(isset($_formvar[self::getUrlVar($id)]) && $_formvar[self::getUrlVar($id)] > 0 && (!isset($_total) || $_formvar[self::getUrlVar($id)] <= $_total))
            $_SESSION['SmartyPaginate'][$id]['current_item'] = $_formvar[$_SESSION['SmartyPaginate'][$id]['urlvar']];
    }

    /**
     * see if session has been initialized
     *
     * @param string $id the pagination id
     */
    static function isConnected($id = 'default') {
        return isset($_SESSION['SmartyPaginate'][$id]);
    }    
        
    /**
     * reset/init the session data
     *
     * @param string $id the pagination id
     */
    static function reset($id = 'default') {
			$_SESSION['SmartyPaginate'][$id] = array(
	            'item_limit' => 10,
	            'item_total' => null,
	            'current_item' => 1,
	            'urlvar' => 'next',
	            'url' => $_SERVER['PHP_SELF'],
	            'prev_text' => 'prev',
	            'next_text' => 'next',
	            'first_text' => 'first',
	            'last_text' => 'last'
	            );
    }
    
    /**
     * clear the SmartyPaginate session data
     *
     * @param string $id the pagination id
     */
    static function disconnect($id = null) {
        if(isset($id))
            unset($_SESSION['SmartyPaginate'][$id]);
        else
            unset($_SESSION['SmartyPaginate']);
    }

    /**
     * set maximum number of items per page
     *
     * @param string $id the pagination id
     */
    static function setLimit($limit, $id = 'default') {
        if(!preg_match('!^\d+$!', $limit)) {
			throw new Exception("SmartyPaginate setLimit: limit must be an integer.");
        }
        settype($limit, 'integer');
        if($limit < 1) {
			throw new Exception("SmartyPaginate setLimit: limit must be greater than zero.");
        }
        $_SESSION['SmartyPaginate'][$id]['item_limit'] = $limit;
    }    

    /**
     * get maximum number of items per page
     *
     * @param string $id the pagination id
     */
    static function getLimit($id = 'default') {
        return $_SESSION['SmartyPaginate'][$id]['item_limit'];
    }    
            
    /**
     * set the total number of items
     *
     * @param int $total the total number of items
     * @param string $id the pagination id
     */
    static function setTotal($total, $id = 'default') {
      if(!preg_match('!^\d+$!', $total)) {
			throw new Exception("SmartyPaginate setTotal: total must be an integer.");
        }
        settype($total, 'integer');
        if($total < 0) {
			throw new Exception("SmartyPaginate setTotal: total must be positive.");
        }
        $_SESSION['SmartyPaginate'][$id]['item_total'] = $total;
    }

    /**
     * get the total number of items
     *
     * @param string $id the pagination id
     */
    static function getTotal($id = 'default') {
        return $_SESSION['SmartyPaginate'][$id]['item_total'];
    }    

    /**
     * set the url used in the links, default is $PHP_SELF
     *
     * @param string $url the pagination url
     * @param string $id the pagination id
     */
    static function setUrl($url, $id = 'default') {
        $_SESSION['SmartyPaginate'][$id]['url'] = $url;
    }

    /**
     * get the url variable
     *
     * @param string $id the pagination id
     */
    static function getUrl($id = 'default') {
        return $_SESSION['SmartyPaginate'][$id]['url'];
    }    
    
    /**
     * set the url variable ie. ?next=10
     *                           ^^^^
     * @param string $url url pagination varname
     * @param string $id the pagination id
     */
    static function setUrlVar($urlvar, $id = 'default') {
        $_SESSION['SmartyPaginate'][$id]['urlvar'] = $urlvar;
    }

    /**
     * get the url variable
     *
     * @param string $id the pagination id
     */
    static function getUrlVar($id = 'default') {
        return $_SESSION['SmartyPaginate'][$id]['urlvar'];
    }    
        
    /**
     * set the current item (usually done automatically by next/prev links)
     *
     * @param int $item index of the current item
     * @param string $id the pagination id
     */
    static function setCurrentItem($item, $id = 'default') {
        $_SESSION['SmartyPaginate'][$id]['current_item'] = $item;
    }

    /**
     * get the current item
     *
     * @param string $id the pagination id
     */
    static function getCurrentItem($id = 'default') {
        return $_SESSION['SmartyPaginate'][$id]['current_item'];
    }    

    /**
     * get the current item index
     *
     * @param string $id the pagination id
     */
    static function getCurrentIndex($id = 'default') {
        return $_SESSION['SmartyPaginate'][$id]['current_item'] - 1;
    }    
    
    /**
     * get the last displayed item
     *
     * @param string $id the pagination id
     */
    static function getLastItem($id = 'default') {
        $_total = self::getTotal($id);
        $_limit = self::getLimit($id);
        $_last = self::getCurrentItem($id) + $_limit - 1;
        return ($_last <= $_total) ? $_last : $_total; 
    }    
    
    /**
     * assign $paginate var values
     *
     * @param obj &$smarty the smarty object reference
     * @param string $var the name of the assigned var
     * @param string $id the pagination id
     */
    static function assign(&$tpl, $var = 'paginate', $id = 'default') {

		$_paginate['total'] = self::getTotal($id);
		$_paginate['first'] = self::getCurrentItem($id);
		$_paginate['last'] = self::getLastItem($id);
		$_paginate['page_current'] = ceil(self::getLastItem($id) / self::getLimit($id));
		$_paginate['page_total'] = ceil(self::getTotal($id)/self::getLimit($id));
		$_paginate['size'] = $_paginate['last'] - $_paginate['first'];
		$_paginate['url'] = self::getUrl($id);
		$_paginate['urlvar'] = self::getUrlVar($id);
		$_paginate['current_item'] = self::getCurrentItem($id);
		$_paginate['prev_text'] = self::getPrevText($id);
		$_paginate['next_text'] = self::getNextText($id);
		$_paginate['limit'] = self::getLimit($id);
		
		$_item = 1;
		$_page = 1;
		while($_item <= $_paginate['total'])           {
			$_paginate['page'][$_page]['number'] = $_page;   
			$_paginate['page'][$_page]['item_start'] = $_item;
			$_paginate['page'][$_page]['item_end'] = ($_item + $_paginate['limit'] - 1 <= $_paginate['total']) ? $_item + $_paginate['limit'] - 1 : $_paginate['total'];
			$_paginate['page'][$_page]['is_current'] = ($_item == $_paginate['current_item']);
			$_item += $_paginate['limit'];
			$_page++;
		}
		$tpl->assign($var, $_paginate);
    }    

    
    /**
     * set the default text for the "previous" page link
     *
     * @param string $text index of the current item
     * @param string $id the pagination id
     */
    static function setPrevText($text, $id = 'default') {
        $_SESSION['SmartyPaginate'][$id]['prev_text'] = $text;
    }

    /**
     * get the default text for the "previous" page link
     *
     * @param string $id the pagination id
     */
    static function getPrevText($id = 'default') {
        return $_SESSION['SmartyPaginate'][$id]['prev_text'];
    }    
    
    /**
     * set the text for the "next" page link
     *
     * @param string $text index of the current item
     * @param string $id the pagination id
     */
    static function setNextText($text, $id = 'default') {
        $_SESSION['SmartyPaginate'][$id]['next_text'] = $text;
    }
    
    /**
     * get the default text for the "next" page link
     *
     * @param string $id the pagination id
     */
    static function getNextText($id = 'default') {
        return $_SESSION['SmartyPaginate'][$id]['next_text'];
    }    

    /**
     * set the text for the "first" page link
     *
     * @param string $text index of the current item
     * @param string $id the pagination id
     */
    static function setFirstText($text, $id = 'default') {
        $_SESSION['SmartyPaginate'][$id]['first_text'] = $text;
    }
    
    /**
     * get the default text for the "first" page link
     *
     * @param string $id the pagination id
     */
    static function getFirstText($id = 'default') {
        return $_SESSION['SmartyPaginate'][$id]['first_text'];
    }    
    
    /**
     * set the text for the "last" page link
     *
     * @param string $text index of the current item
     * @param string $id the pagination id
     */
    static function setLastText($text, $id = 'default') {
        $_SESSION['SmartyPaginate'][$id]['last_text'] = $text;
    }
    
    /**
     * get the default text for the "last" page link
     *
     * @param string $id the pagination id
     */
    static function getLastText($id = 'default') {
        return $_SESSION['SmartyPaginate'][$id]['last_text'];
    }    
    
            
    /**
     * get the previous page of items
     *
     * @param string $id the pagination id
     */
    static function getPrevPageItem($id = 'default') {
        
        $_prev_item = $_SESSION['SmartyPaginate'][$id]['current_item'] - $_SESSION['SmartyPaginate'][$id]['item_limit'];
        
        return ($_prev_item > 0) ? $_prev_item : false; 
    }    

    /**
     * get the previous page of items
     *
     * @param string $id the pagination id
     */
    static function getNextPageItem($id = 'default') {
                
        $_next_item = $_SESSION['SmartyPaginate'][$id]['current_item'] + $_SESSION['SmartyPaginate'][$id]['item_limit'];
        
        return ($_next_item <= $_SESSION['SmartyPaginate'][$id]['item_total']) ? $_next_item : false; 
    }    
    
                
            
}?>
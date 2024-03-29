<?php
/**
* @package    jelix
* @subpackage db_driver
* @author     Yannick Le Guédart
* @copyright  2007 Over-blog, 2007 Yannick Le Guédart
* @link       http://www.jelix.org
* @link 	  http://www.sinequa.com
* @licence  http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
*/

include (LIB_PATH . 'intuition/Intuition.inc');
/**
* @package    jelix
* @subpackage db_driver
*/
class intuitionDbConnection extends jDbConnection {
    /**
    * The intuition session.
    * @access private
    * @var object
    */
    private $_iSession; 

    public function beginTransaction (){
        return $this->_doExec ('BEGIN');
    }

    public function commit (){
        return $this->_doExec ('COMMIT');
    }

    public function rollback (){
        return $this->_doExec ('ROLLBACK');
    }

    public function prepare ($query){
        throw new JException (
            'jelix~db.error.feature.unsupported', 
            array ('intuition','prepare')); 
    }

    public function errorInfo (){
        return 
            array ( 
                'HY000',
                $this->_iSession->status (), 
                $this->_iSession->status ());
    }

    public function errorCode(){
        return $this->_iSession->status ();
    }

    protected function _connect (){
        $this->_iSession = new iSession (); 
        
        if (!isset ($this->profil['port'])){
            $this->profil['port'] = 8088;
        }
        
        $connectionArray = array (
            'host'              => $this->profil['host'],
            'port'              => $this->profil['port'],
            'read_only'         => 1,
            'charset'           => in_UTF8,
            'database'          => $this->profil['database'],
            'user'              => $this->profil['user'],
            'password'          => $this->profil['password'],
            'page_size'         => 20,
            'max_answers_count' => 1000,
            'default-language'  => 'en'
            );

        $cnx = @$this->_iSession->connect ($connectionArray);
        
        if ($cnx){
            return $this->_iSession;
        }else{
            throw new Exception ($this->_iSession->status ());
        }
    }

    protected function _disconnect (){
        return $this->_connection->in_close();
    }

    protected function _doQuery ($queryString){
        // Avant tout, on enlève les retours-chariots
        
        $queryString = str_replace (array ("\n", "\r"), " ", $queryString);  
        
        // Exécution de la requète 
        
        $queryResult = $this->_connection->in_query ($queryString);
        
        if (is_object ($queryResult) or 
            (is_numeric ($queryResult) and $queryResult > 0)){

            $rs 				= new intuitionDbResultSet ($queryResult);
            $rs->_connector 	= $this;
        }else{
            $rs = false;
            throw new Exception ($this->_iSession->status ());
        }

        return $rs;
    }

    protected function _doLimitQuery ( $queryString, $offset, $number)  {
        $queryString.= ' SKIP ' . $offset . ' COUNT ' . $number;
        $result = $this->_doQuery($queryString);
        return $result;
    }
	
    protected function _doExec ($query){
        // Avant tout, on enlève les retours-chariots
        
        $queryString = str_replace (array ("\n", "\r"), " ", $queryString);  
        
        // Exécution de la requète 
        
        $queryResult = $this->_connection->in_query ($queryString);
        
        return $queryResult;
    }

	public function lastInsertId ($fromSequence=''){
        throw new JException (
            'jelix~db.error.feature.unsupported',
            array ('intuition','lastInsertId')); 
    }

    protected function _autoCommitNotify ($state){
        throw new JException (
            'jelix~db.error.feature.unsupported', 
            array ('intuition','_autoCommitNotify')); 
    }

    protected function _quote ($text){
        return quote ($text);
    }
}
?>
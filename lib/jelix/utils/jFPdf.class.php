<?PHP
require_once (LIB_PATH.'fpdf/fpdf.php');
class jFPdf extends FPDF {
	var $_filepath;	
    function jFPdf($filepath){
		$this->_filepath=$filepath;
		$this->FPDF();
	}
	function saveEdition(){
		$this->Output($this->_filepath);
	}
	function getContent(){
		$content='';
		while(!file_exists($this->_filepath) || !is_file($this->_filepath));
		if(($file=fopen($this->_filepath,"r"))){
			$content=fread($file,filesize($this->_filepath));
			fclose($file);
			@unlink($this->_filepath);
		}
		return $content;
	}
}
?>
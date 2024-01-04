<?PHP
require_once (LIB_PATH.'pear/Spreadsheet/Excel/Writer.php');
class jSpreadsheetExcel extends Spreadsheet_Excel_Writer {
	var $_filepath;	
    function jSpreadsheetExcel($filepath){
		$this->_filepath=$filepath;
		$this->Spreadsheet_Excel_Writer($filepath);
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
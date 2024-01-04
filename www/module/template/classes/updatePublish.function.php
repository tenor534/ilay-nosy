<?php
	/**
	* Modifie la publication d'un élément
	* @param int $id@TableName@
	* @param int $publier ? 0 : 1
	**/
	static function updatePublish($id@TableName@, $publier=-1)
	{
		if($publier != -1){
			$oCnx = jDb::getConnection();
			$zQuery  ="UPDATE @tableName@ SET";
			$zQuery .=" @tableColumnPublier@ =". $publier;			
			$zQuery	.=" WHERE @tablePK@ =". $id@TableName@;
			
			try {
				$oCnx->startTransaction(); 
				$oCnx->exec($zQuery);
				$oCnx->commit();						
			}catch (Exception $e) {
				$oCnx->rollback();
			}
		}
	}

?>
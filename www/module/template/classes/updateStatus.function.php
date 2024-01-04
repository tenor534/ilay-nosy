<?php
	/**
	* Modifie le statut d'un élément
	* @param int $id@TableName@
	* @param int $status ? 0 : 1
	**/
	static function updateStatus($id@TableName@, $status=-1)
	{
		if($status != -1){
			$oCnx = jDb::getConnection();
			$zQuery  ="UPDATE @tableName@ SET";
			$zQuery .=" @tableColumnStatus@ =". $status;
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

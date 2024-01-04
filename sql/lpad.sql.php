UPDATE `annonce` 
SET annonce_reference =  CONCAT('an', LPAD(`annonce_id`,8,'0'))
WHERE 1
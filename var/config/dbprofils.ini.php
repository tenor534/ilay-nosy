;<?php die(''); ?>
;for security reasons, don't remove or modify the first line

; nom de la connexion utilisée par défaut
default = ilay-nosy
 
; chaque section correspond à une connexion
; le nom de la section est le nom de la connexion utilisé dans jDb et jDao
; la liste des paramètres dépend du driver.

[ilay-nosy]
driver="mysql"

database="ilayNosy"
;host= "localhost:3306"
host= "127.0.0.1"
user= "root"
password=

;database="dwordconnosy"
;host= "mysql5-12.240:3306"
;user= "dwordconnosy"
;password="mg1553tg"

persistent= on
; when you have charset issues, enable force_encoding so the connection will be
; made with the charset indicated in jelix config
force_encoding = on

;pour pdo :
;driver=pdo
;dsn=mysql:host=localhost;dbname=ilay-nosy
;user="root"
;password=""

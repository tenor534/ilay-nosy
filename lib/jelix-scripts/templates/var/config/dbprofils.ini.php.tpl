;<?php die(''); ?>
;for security reasons, don't remove or modify the first line

; nom de la connexion utilisée par défaut
;default = myapp
default =

; chaque section correspond à une connexion
; le nom de la section est le nom de la connexion utilisé dans jDb et jDao
; la liste des paramètres dépend du driver.

;[myapp]

; pour la plupart des drivers :
;driver="mysql"
;database="jelix"
;host= "localhost"
;user= "root"
;password=
;persistent= on
; when you have charset issues, enable force_encoding so the connection will be
; made with the charset indicated in jelix config
;force_encoding = on

; pour pdo :
;driver=pdo
;dsn=mysql:host=localhost;dbname=test
;user=
;password=

<?php
/*
=====================================================================
#  PROJETO: Sa�po                                                   #
#  FUNCA��O ECUM�NICA DE PROTE��O AO EXCEPCIONAL                    #
#                                                                   #
#  Programa��o                                                      #
#	        - Jackson Brutkowski Vieira da Costa                    #
#  Design                                                           #
#           - Cleibson Aparecido de Almeida                         #
=====================================================================
*/

//Configura��es do Banco de Dados da Plataforma
define("_DB_TYPE_", 'mysql');
define("_DB_HOST_", 'localhost');
//define("_DB_NAME_", 'saapo');
define("_DB_NAME_", 'innodb_saapo');
define("_DB_USER_", 'saapo');
define("_DB_PASS_", '$@2p0|*');
define("_DB_PORT_", '3306');

//Configura��o da Imagem SEM FOTO
define("_SEM_FOTO", 'sem_foto.gif');

//Chaves de codifica��o
define("_KEY_USER",  'S4p0{u53]r');

//Configura��es do Sistema de Arquivos
define("_FILE_DIR", '/srv/www/htdocs/sapo/arquivos/');

//Configura��es do Sistema de Arquivos
define("_FILE_DIR_PERFIL", '/srv/www/htdocs/sapo/arquivos/perfil/');

//Configura��es de Acesso a Conte�dos via APACHE
define("APACHE_CONF", '/srv/www/htdocs/sapo/arquivos/apache.conf');

?>
<?php

$bd = 0;

if($bd ==1){
    define('BD_SERVIDOR', 'localhost');
    define('BD_USUARIO', '');
    define('BD_SENHA', '');
    define('BD_BANCO', '');
} else {
    define('BD_SERVIDOR', 'localhost');
    define('BD_USUARIO', 'root');
    define('BD_SENHA', 'root');
    define('BD_BANCO', 'sistema');
}

$conexao = mysqli_connect(BD_SERVIDOR, BD_USUARIO, BD_SENHA, BD_BANCO) or die('Não foi possivel conectar!');

?>
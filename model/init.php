
<?php

$bd = 0;

if($bd == 1){
    date_default_timezone_set('America/Sao_Paulo');
    define('BD_SERVIDOR','localhost');
    define('BD_USUARIO','');
    define('BD_SENHA','');
    define('BD_BANCO','');
} else {
    date_default_timezone_set('America/Sao_Paulo');
    define('BD_SERVIDOR','localhost');
    define('BD_USUARIO','root');
    define('BD_SENHA','root');
    define('BD_BANCO','sistema');
}

?>
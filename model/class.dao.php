<?php
require_once('init.php');
/*require_once('class.hash.php');*/

class Dao
{

  protected $mysql;

  public function conexao()
  {
    $this->mysql = new mysqli(BD_SERVIDOR, BD_USUARIO, BD_SENHA, BD_BANCO);
    if ($this->mysql->connect_error) {
      die("Falha de conexão: " . $this->mysql->connect_error);
    }
  }

  public function getInfo()
  {
    $ch = curl_init();
    $url = 'http://localhost:5069/api/listar-transacoes';
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $resposta = curl_exec($ch);
    curl_close($ch);

    echo $resposta;
  }
}

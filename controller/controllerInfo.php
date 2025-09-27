<?php
require_once('../model/class.info.php');
require_once "../model/class.info.php";
class ControllerInfo
{
    private $obj;
    function __construct()
    {
        $this->obj = new TransacaoModel();
        $this->obj->conexao();
    }

    function formatarReal($valor): string
    {
        return 'R$ ' . number_format((float) $valor, 2, ',', '.');
    }

    function formatarData($data): string
    {
        return date('d/m/Y', strtotime($data));
    }


    public function getTransacoes()
    {
        $ch = curl_init();
        $url = 'http://localhost:5069/api/listar-transacoes';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $resposta = curl_exec($ch);

        if ($resposta === false) {
            curl_close($ch);
            return [];
        }

        curl_close($ch);

        return json_decode($resposta, true);
    }

    public function getResumo()
    {
        $ch = curl_init();
        $url = 'http://localhost:5069/api/listar-resumo';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $resposta = curl_exec($ch);

        if ($resposta === false) {
            curl_close($ch);
            return [];
        }

        curl_close($ch);

        return json_decode($resposta, true);
    }

    public function updateTransacao($id, $descricao, $valor, $observacoes   )
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao'])) {
            if ($_POST['acao'] === 'updateTransacao') {
                $id = $_POST['id'];
                $descricao = $_POST['descricao'];
                $valor = $_POST['valor'];
                $observacao = $_POST['observacoes'];

                $resultado = $this->updateTransacaoApi($id, $descricao, $valor, $observacao);

                if (isset($resultado['erro'])) {
                    echo "Erro ao atualizar: " . $resultado['erro'];
                } else {
                    header("Location: ../view/painel.php?msg=Transação atualizada com sucesso");
                    exit;
                }
            }
        }
    }

    public function updateTransacaoApi($id, $descricao, $valor, $observacao)
    {
        $ch = curl_init();

        $url = "http://localhost:5069/api/transacoes/editar-transacoes/{$id}";

        $payload = json_encode([
            "id" => $id,
            "descricao" => $descricao,
            "valor" => $valor,
            "observacao" => $observacao
        ]);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload)
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $resposta = curl_exec($ch);

        if ($resposta === false) {
            $erro = curl_error($ch);
            curl_close($ch);
            return ["erro" => $erro];
        }

        curl_close($ch);

        return json_decode($resposta, true);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'updateTransacao') {
    $controller = new ControllerInfo();
    $controller->updateTransacao($_POST['id'], $_POST['descricao'], $_POST['valor'], $_POST['observacao']);
}

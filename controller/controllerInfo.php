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

    public function getCategorias()
    {
        $ch = curl_init();
        $url = 'http://localhost:5069/api/listar-categorias';
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

    public function createTransacao()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'createTransacao') {
            $id          = $_POST['id'] ?? 0;
            $descricao   = $_POST['descricao'] ?? '';
            $valor       = $_POST['valor'] ?? 0;
            $observacoes = $_POST['observacoes'] ?? '';
            $data        = $_POST['data'] ?? date('c'); // ISO 8601
            $categoriaId = $_POST['categoriaId'] ?? 0;
            $dataCriacao = $_POST['dataCriacao'] ?? date('c');
    
            $url = "http://localhost:5069/api/cadastrar-transacoes";
    
            $payload = json_encode([
                "id"          => (int) $id,
                "descricao"   => $descricao,
                "valor"       => (float) $valor,
                "data"        => $data,
                "categoriaId" => (int) $categoriaId,
                "observacoes" => $observacoes,
                "dataCriacao" => $dataCriacao,
            ], JSON_PRETTY_PRINT);
    
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); // <- troquei para POST
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($payload)
            ]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
            $resposta = curl_exec($ch);
    
            if ($resposta === false) {
                die("Erro cURL: " . curl_error($ch));
            }
    
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
    
            header("Location: ../view/painel.php?msg=Transação criada com sucesso");
            exit;
        }
    }    

    public function updateTransacao()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'updateTransacao') {
            $id          = $_POST['id'];
            $descricao   = $_POST['descricao'];
            $valor       = $_POST['valor'];
            $observacoes = $_POST['observacoes'];
            $data        = $_POST['data'];
            $categoriaId = $_POST['categoriaId'];
            $dataCriacao = $_POST['dataCriacao'];

            $url = "http://localhost:5069/api/editar-transacoes/{$id}";

            $payload = json_encode([
                "id"          => (int) $id,
                "descricao"   => $descricao,
                "valor"       => (float) $valor,
                "data"        => $data,
                "categoriaId" => (int) $categoriaId,
                "observacoes" => $observacoes,
                "dataCriacao" => $dataCriacao,
                "categoria"   => [
                    "id"    => (int) $categoriaId,
                    "nome"  => "string",
                    "tipo"  => "string",
                    "ativo" => true
                ]
            ]);

            $ch = curl_init();
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
                die("Erro ao atualizar: " . $erro);
            }

            curl_close($ch);

            $resultado = json_decode($resposta, true);

            if (isset($resultado['erro'])) {
                die("Erro ao atualizar: " . $resultado['erro']);
            }

            // sucesso
            header("Location: ../view/painel.php?msg=Transação atualizada com sucesso");
            exit;
        }
    }
}

$objControllerFunc = new controllerInfo();
$objControllerFunc->updateTransacao();
$objControllerFunc->createTransacao();

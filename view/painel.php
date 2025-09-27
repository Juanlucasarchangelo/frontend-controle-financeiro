<?php
require_once("../controller/controllerInfo.php");

session_start();

if (!$_SESSION['usuario']) {
  header('Location: ../index.php');
  exit;
}

$objControllerFunc = new controllerInfo();
$transacoes = $objControllerFunc->getTransacoes();
$resumos = $objControllerFunc->getResumo();

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <title>Sistema - Click</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foΩΩ-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="estilo/estilo.css">
  <link rel="shortcut icon" href="img/cropped-click-2-scaled-1.jpg">
  <style>
    .foto_perfil {
      border-radius: 100%;
    }
  </style>
</head>

<body style="background-color: #e6e6e6">

  <!-- M e n u - e - L o g o -->

  <nav class="navbar navbar-expand-md navbar-light shadow p-3 bg-white">

    <!-- L o g o t i p o -->

    <div class="container">
      <a class="navbar-brand text-primary" href="painel.php">
        <img src="https://mgcontecnica.com.br/wp-content/uploads/2025/04/logo-site-novo.png" width="100px" height="100px" class="">
        <b></b>
      </a>

      <button class="navbar-toggler navbar-toggler-right border-0" type="button" data-toggle="collapse" data-target="#navbar4">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- M e n u - E s c r i t o -->

      <div class="collapse navbar-collapse" id="navbar4">
        <ul class="navbar-nav ml-auto font-weight-bold">
          <li class="nav-item">
            <a class="nav-link" href="painel.php">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cadastroinfo.php">Cadastro</a>
          </li>

          <!--Mudar Botão Login -->

          <li class="nav-item">
            <a class="nav-link bg-danger text-light" href="../controller/logout.php">SAIR</a>
          </li>

      </div>
    </div>
  </nav>

  <!-- Informações do Cliente -->
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-3 col-lg-5 col-sm-12 bg-ligth shadow-lg p-3 mb-5 rounded text-center">
        <?php
        if ($_SESSION['usuario'] == "contato@juanarchangelo.com.br") {
          echo '<img src="img/juan_programador.jpg" alt="foto de perfil do usúario" width="120px" height="120px" class="foto_perfil">
        <div class="card-body">';
        } else {
          echo '<img src="https://mgcontecnica.com.br/wp-content/uploads/2025/04/logo-site-novo.png" alt="foto de perfil do usúario" width="120px" height="120px">
          <div class="card-body">';
        }
        ?>

        <h3>Usuário Logado:</h3>

        <h6 class="lead"><strong><?php echo $_SESSION['usuario']; ?></strong></h6>
      </div>
    </div>

    <!-- Area de listagem-->

    <div class="col-xl-9 col-lg-8 col-sm-12 card bg-light shadow-lg p-3 mb-5 rounded">
      <div class="row g-2">
        <div class="col-9 card">
          <h4 class="text-left pt-3 pb-3">Transações</h4>
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Descrição</th>
                <th scope="col">Valor</th>
                <th scope="col">Data</th>
                <th scope="col">Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($transacoes as $transacao) { ?>
                <tr>
                  <td><?= $transacao['id'] ?></td>
                  <td><?= $transacao['descricao'] ?></td>
                  <td><?= $objControllerFunc->formatarReal($transacao['valor']) ?></td>
                  <td><?= $objControllerFunc->formatarData($transacao['data']) ?></td>
                  <td>
                    <!-- Botão abre modal único -->
                    <a href="#editarTransacao<?= $transacao['id'] ?>"
                      data-bs-toggle="modal"
                      data-bs-target="#editarTransacao<?= $transacao['id'] ?>"
                      class="text-secondary">
                      Editar
                    </a>
                    <a href="#"
                      class="text-danger"
                      onclick="excluirTransacao(<?= $transacao['id'] ?>)">
                      Excluir
                    </a>
                  </td>
                </tr>

                <!-- Modal de edição para esta transação -->
                <div class="modal fade" id="editarTransacao<?= $transacao['id'] ?>" tabindex="-1" aria-labelledby="editarTransacaoLabel<?= $transacao['id'] ?>" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <form method="POST" action="../controller/controllerInfo.php">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="editarTransacaoLabel<?= $transacao['id'] ?>">Editar Transação</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                          <!-- id hidden -->
                          <input type="hidden" name="id" value="<?= $transacao['id'] ?>">
                          <div class="mb-3">
                            <label for="descricao<?= $transacao['id'] ?>" class="form-label">Descrição</label>
                            <input type="text" class="form-control" id="descricao<?= $transacao['id'] ?>" name="descricao" value="<?= $transacao['descricao'] ?>" required>
                          </div>

                          <div class="mb-3">
                            <label for="valor<?= $transacao['id'] ?>" class="form-label">Valor</label>
                            <input type="text" class="form-control" id="valor<?= $transacao['id'] ?>" name="valor" value="<?= $transacao['valor'] ?>" required>
                          </div>

                          <div class="mb-3">
                            <label for="observacoes<?= $transacao['id'] ?>" class="form-label">Observações</label>
                            <textarea class="form-control" id="observacoes<?= $transacao['id'] ?>" name="observacoes"><?= $transacao['observacoes'] ?? '' ?></textarea>

                          </div>
                        </div>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                          <button type="submit" name="acao" value="updateTransacao" class="btn btn-primary">Salvar alterações</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              <?php } ?>
            </tbody>
          </table>

        </div>
        <div class="col-3 card">
          <h4 class="text-left pt-3 pb-3">Resumo Financeiro</h4>
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Saldo</th>
                <th scope="col">Receita</th>
                <th scope="col">Despesas</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>
                  <?= $resumos['saldo'] ?>
                </th>
                <th>
                  <?= $resumos['receitas'] ?>
                </th>
                <th>
                  <?= $resumos['despesas'] ?>
                </th>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- F i n a l -->

  <div class="container">
    <footer class="py-3 my-4">
      <p class="text-center text-muted">Controle Financeiro © 2025</p>
    </footer>
  </div>

  <script>
    function excluirTransacao(id) {
      if (!confirm("Tem certeza que deseja excluir?")) return;

      fetch(`http://localhost:5069/api/deletar-transacoes/${id}`, {
          method: "DELETE"
        })
        .then(response => {
          if (response.ok) {
            alert("Transação excluída com sucesso!");
            location.reload(); // Recarrega página
          } else {
            alert("Erro ao excluir transação.");
          }
        })
        .catch(err => console.error(err));
    }
  </script>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
</body>

</html>
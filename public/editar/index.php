<?php

require_once '../../server/Controller.php';

$controller = new Controller();
$id = intval($_GET["id"]);
$client = $controller->getClient($id);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
        crossorigin="anonymous"></script>
        <script src="../statusFlag.js"></script>
    <title>cadastrar</title>
</head>

<body>
    <div class="container-flex">
        <div class="container">
            <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
                <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                    <svg class="bi me-2" width="40" height="32">
                        <use xlink:href="#bootstrap"></use>
                    </svg>
                    <span class="fs-4" style="margin-right: 100px;">Clientes</span>
                </a>
                <ul class="nav nav-pills">
                    <li class="nav-item"><a href="../cadastrar/index.php" class="nav-link" aria-current="page">CADASTRO</a></li>
                    <li class="nav-item"><a href="../consultar/index.php" class="nav-link">CONSULTA</a></li>
                </ul>
            </header>
        </div>
        <div id="status-flag"></div>
        <aside class="container">
            <h1 class="lead">Editar agendamentos de potenciais clientes</h1>
        </aside>
        <main class="container" style="margin: 5vh auto;">
            <form action="../../server/UpdateData.php" method="post" >
                <input type="number" name="id" id="idHideInput" style="display: none;" value="<?php echo $_GET["id"] ?>">
                <fieldset>
                    <div class="mb-3">
                        <label for="nameInput" class="form-label">nome</label>
                        <input name="name" type="text" class="form-control" id="nameInput" placeholder="Nome completo" autocapitalize="words" style="text-transform: capitalize;" value="<?php echo $client["nome"] ?>">
                    </div>
                </fieldset>
                <fieldset>
                    <div class="mb-3">
                        <label for="phoneInput" class="form-label">telefone</label>
                        <input name="phone" type="tel" class="form-control" id="phoneInput" placeholder="Telefone ou celular" value="<?php echo $client["telefone"] ?>">
                    </div>
                </fieldset>
                <fieldset>
                    <div class="mb-3">
                        <label for="originInput" class="form-label">origem</label>
                        <select name="origin" class="form-select" id="originInput" aria-label="Selecione uma origem">
                            <option <?php echo ($client["origem"] == "cel") ? "selected" : "" ?> value="cel">celular</option>
                            <option <?php echo ($client["origem"] == "fixo") ? "selected" : "" ?> value="tel">fixo</option>
                            <option <?php echo ($client["origem"] == "whatsapp") ? "selected" : "" ?> value="whatsapp">whatsapp</option>
                            <option <?php echo ($client["origem"] == "facebook") ? "selected" : "" ?> value="facebook">facebook</option>
                            <option <?php echo ($client["origem"] == "instagram") ? "selected" : "" ?> value="instagram">instagram</option>
                            <option <?php echo ($client["origem"] == "gmn") ? "selected" : "" ?> value="gmn">Google Meu Negocio</option>
                        </select>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="mb-3">
                        <label for="dateInput" class="form-label">data de contato</label>
                        <input name="contact_date" type="date" class="form-control" id="dateInput" value="<?php echo $client["data_contato"] ?>">
                    </div>
                </fieldset>
                <fieldset>
                    <div class="mb-3">
                        <label for="obsInput" class="form-label">observações</label>
                        <textarea name="note" class="form-control" id="obsInput" rows="4" maxlength="250"><?php echo $client["observação"] ?></textarea>
                      </div>
                </fieldset>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">editar</button>
                </div>
            </form>
        </main>
    </div>
    <script>
        showFlag({
            succesMsg: "Dados editados com sucesso!",
            failMsg: "Ocorreu um erro ao editar",
            element: document.querySelector('#status-flag')
        });
    </script>
</body>

</html>
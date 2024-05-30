<?php
include_once('config.php');

if (isset($_POST['submit'])) {
    $marca = mysqli_real_escape_string($conexao, $_POST['marca']);
    $modelo = mysqli_real_escape_string($conexao, $_POST['modelo']);
    $cor = mysqli_real_escape_string($conexao, $_POST['cor']);
    $ano = (int) $_POST['ano'];
    $valor = str_replace(['R$', ',', '.'], '', $_POST['valor']);
    $valor = floatval($valor);
    $statu = mysqli_real_escape_string($conexao, $_POST['statu']);

    $query = "INSERT INTO veiculos (marca, modelo, cor, ano, valor, statu) VALUES (?, ?, ?, ?, ?, ?)";
    if ($stmt = $conexao->prepare($query)) {
        $stmt->bind_param("sssids", $marca, $modelo, $cor, $ano, $valor, $statu);
        if ($stmt->execute()) {
            header('Location: sistema.php?success=1');
        } else {
            header('Location: sistema.php?error=1');
        }
        $stmt->close();
    } else {
        header('Location: sistema.php?error=1');
    }
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema A2</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
        }

        a {
            text-decoration: none;
            background-color: black;
            border: none;
            padding: 10px;
            border-radius: 10px;
            color: white;
            font-size: 15px;
        }

        .box {
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.6);
            padding: 15px;
            border-radius: 15px;
            width: 20%;
        }

        fieldset {
            border: 3px solid dodgerblue;
        }

        legend {
            border: 1px solid dodgerblue;
            padding: 10px;
            text-align: center;
            background-color: dodgerblue;
            border-radius: 8px;
        }

        .inputBox {
            position: relative;
        }

        .inputUser {
            background: none;
            border: none;
            border-bottom: 1px solid white;
            outline: none;
            color: white;
            font-size: 15px;
            width: 100%;
            letter-spacing: 2px;
        }

        .labelInput {
            position: absolute;
            top: 0px;
            left: 0px;
            pointer-events: none;
            transition: .5s;
        }

        .inputUser:focus~.labelInput,
        .inputUser:not(:placeholder-shown)~.labelInput {
            top: -20px;
            font-size: 12px;
            color: dodgerblue;
        }

        #submit {
            background-image: linear-gradient(to right, rgb(0, 92, 197), rgb(90, 20, 220));
            width: 100%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
        }

        #submit:hover {
            background-image: linear-gradient(to right, rgb(0, 80, 172), rgb(80, 19, 195));
        }
    </style>
</head>

<body>
    <a href="sistema.php">Sistema</a>
    <div class="box">
        <form action="cadastroVeiculo.php" method="POST">
            <fieldset>
                <legend><b>Cadastre seu veiculo</b></legend>
                <br>
                <div class="inputBox">
                    <input minlength="4" maxlength="15" type="text" name="marca" id="marca" class="inputUser" placeholder="" required>
                    <label for="marca" class="labelInput">Marca</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input minlength="4" maxlength="15" type="text" name="modelo" id="modelo" class="inputUser" placeholder="" required>
                    <label for="modelo" class="labelInput">Modelo</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input minlength="4" maxlength="15" type="text" name="cor" id="cor" class="inputUser" placeholder="" required>
                    <label for="cor" class="labelInput">Cor</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="number" name="ano" id="ano" class="inputUser" min="1990" max="<?php echo date("Y"); ?>" placeholder="" required>
                    <label for="ano" class="labelInput">Ano</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="valor" id="valor" class="inputUser" placeholder="" required>
                    <label for="valor" class="labelInput">Valor</label>
                </div>
                <br>
                <p>Status:</p>
                <input type="radio" id="novo" name="statu" value="novo" required>
                <label for="novo">Novo</label>

                <input type="radio" id="seminovo" name="statu" value="seminovo" required>
                <label for="seminovo">Seminovo</label>
                <br><br>
                <input type="submit" name="submit" id="submit">
            </fieldset>
        </form>
    </div>

    <script>
        document.getElementById('valor').addEventListener('input', function(e) {
            let valor = e.target.value.replace(/\D/g, ''); // Remove tudo que não é número
            valor = (valor / 100).toFixed(2) + ''; // Converte para decimal
            valor = valor.replace(".", ","); // Substitui ponto por vírgula
            valor = valor.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."); // Adiciona os pontos
            e.target.value = 'R$ ' + valor;
        });
    </script>
</body>

</html>
<?php
include_once('config.php');

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $sqlSelect = "SELECT * FROM veiculos WHERE id=$id";
    $result = $conexao->query($sqlSelect);
    if ($result->num_rows > 0) {
        while ($user_data = mysqli_fetch_assoc($result)) {
            $marca = $user_data['marca'];
            $modelo = $user_data['modelo'];
            $cor = $user_data['cor'];
            $ano = $user_data['ano'];
            $valor = $user_data['valor'];
            $statu = $user_data['statu'];
        }
    } else {
        header('Location: sistema.php');
    }
} else {
    header('Location: sistema.php');
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
        .inputUser:valid~.labelInput {
            top: -20px;
            font-size: 12px;
            color: dodgerblue;
        }


        #update {
            background-image: linear-gradient(to right, rgb(0, 92, 197), rgb(90, 20, 220));
            width: 100%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
        }

        #update:hover {
            background-image: linear-gradient(to right, rgb(0, 80, 172), rgb(80, 19, 195));
        }
    </style>
</head>

<body>
    <div class="box">
        <form action="saveEdit.php" method="POST">
            <fieldset>
                <legend><b>Edite o Veículo</b></legend>
                <br>
                <div class="inputBox">
                    <input value="<?php echo $marca ?>" minlength="8" type="text" name="marca" id="marca" class="inputUser" required>
                    <label for="marca" class="labelInput">Marca</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input value="<?php echo $modelo ?>" type="text" name="modelo" id="modelo" class="inputUser" required>
                    <label for="modelo" class="labelInput">Modelo</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input value="<?php echo $cor ?>" type="text" name="cor" id="cor" class="inputUser" required>
                    <label for="cor" class="labelInput">Cor</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input value="<?php echo $ano ?>" type="number" name="ano" id="ano" class="inputUser" required>
                    <label for="ano" class="labelInput">Ano</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input value="<?php echo $valor ?>" type="text" name="valor" id="valor" class="inputUser" required>
                    <label for="valor" class="labelInput">Valor</label>
                </div>
                <br>
                <p>Status:</p>
                <input value="novo" <?php echo ($statu == 'novo') ? 'checked' : '' ?> type="radio" id="novo" name="statu" value="novo" required>
                <label for="novo">Novo</label>

                <input value="seminovo" <?php echo ($statu == 'seminovo') ? 'checked' : '' ?> type="radio" id="seminovo" name="statu" value="seminovo" required>
                <label for="seminovo">Seminovo</label>
                <br><br>
                <input type="hidden" name="id" value=<?php echo $id; ?>>
                <input type="submit" name="update" id="update">
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
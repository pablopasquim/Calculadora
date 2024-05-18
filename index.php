<?php
require_once 'functions.php';

// Iniciar ou resumir a sessão
session_start();

// Limpar histórico
if (isset($_POST['clear'])) {
    $_SESSION['historic'] = [];
}

// Salvar valores para cálculo
if (isset($_POST['save'])) {
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $operation = $_POST['operation'];

    // Salvar os valores na sessão
    $_SESSION['saved_values'] = [
        'num1' => $num1,
        'num2' => $num2,
        'operation' => $operation
    ];

    // Limpar os campos de entrada após salvar os valores
    $num1 = '';
    $num2 = '';
}

// Pegar valores salvos
if (isset($_POST['getValues'])) {
    if (isset($_SESSION['saved_values'])) {
        $saved_values = $_SESSION['saved_values'];
        $num1 = $saved_values['num1'];
        $num2 = $saved_values['num2'];
        $operation = $saved_values['operation'];
    } else {
        $num1 = '';
        $num2 = '';
        $operation = '+';
    }
}

// Calcular e adicionar à lista histórica
if (isset($_POST['calculate'])) {
    if (isset($_POST['num1']) && isset($_POST['num2']) && isset($_POST['operation'])) {
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $operation = $_POST['operation'];
        $result = calcular($num1, $num2, $operation);

        // Adicionar operação ao histórico
        $_SESSION['historic'][] = [
            'num1' => $num1,
            'num2' => $num2,
            'operation' => $operation,
            'result' => $result
        ];

        $num1 = '';
        $num2 = '';
    }
}

// Salvar ou exibir valores
if (isset($_POST['memory'])) {
    if (isset($_SESSION['saved_values'])) {
        $saved_values = $_SESSION['saved_values'];
        $num1 = $saved_values['num1'];
        $num2 = $saved_values['num2'];
        $operation = $saved_values['operation'];
        unset($_SESSION['saved_values']); // Remover os valores salvos da sessão após exibir
    } else {
        // Salvar os valores na sessão
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $operation = $_POST['operation'];
        $_SESSION['saved_values'] = [
            'num1' => $num1,
            'num2' => $num2,
            'operation' => $operation
        ];

        // Limpar os campos de entrada após salvar os valores
        $num1 = '';
        $num2 = '';
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Calculadora PHP</title>
<link rel="stylesheet" type="text/css" href="estilo.css" media="screen">
</head>
<body>

<form method="post" class="meio">
<h1 class="font1">Calculadora PHP</h1>
<label for="num1" class="font1">Valor 1</label>
<input type="number" id="num1" name="num1" class="num1" value="<?php echo isset($num1) ? $num1 : ''; ?>">

<label for="operation" class="font1"></label>
<select id="operation" name="operation" class="operacao">
<option value="+" <?php echo isset($operation) && $operation == '+' ? 'selected' : ''; ?>>+</option>
<option value="-" <?php echo isset($operation) && $operation == '-' ? 'selected' : ''; ?>>-</option>
<option value="*" <?php echo isset($operation) && $operation == '*' ? 'selected' : ''; ?>>*</option>
<option value="/" <?php echo isset($operation) && $operation == '/' ? 'selected' : ''; ?>>/</option>
<option value="!" <?php echo isset($operation) && $operation == '!' ? 'selected' : ''; ?>>!</option>
<option value="^" <?php echo isset($operation) && $operation == '^' ? 'selected' : ''; ?>>^</option>
</select>

<label for="num2" class="font1">Valor 2</label>
<input type="number" id="num2" name="num2" class="num1" value="<?php echo isset($num2) ? $num2 : ''; ?>">

<br>
<div class="acoes">
<button type="submit" name="calculate">Calcular</button>
<button type="submit" name="save">Salvar</button>
<button type="submit" name="getValues">Pegar Valores</button>
<button type="submit" name="memory">M</button>
<button type="submit" name="clear">Apagar Histórico</button>
</div>
</form>

<br>
<div class="meio">
<div class="font1">
    
    <h2>Histórico</h2>
    <?php if (!empty($_SESSION['historic'])): ?>
        <table>
        <?php foreach ($_SESSION['historic'] as $operation): ?>
            <tr>
                <td>
                    <?php echo "{$operation['num1']} {$operation['operation']} {$operation['num2']} = {$operation['result']}"; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>
</div>

</body>
</html>
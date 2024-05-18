<?php

function validarDados($num1, $num2, $operation) {
    if (!is_numeric($num1) || !is_numeric($num2)) {
        return false;
    }

   
}

function calcular($num1, $num2, $operation) {
    switch ($operation) {
        case '+':
            return $num1 + $num2;
        case '-':
            return $num1 - $num2;
        case '*':
            return $num1 * $num2;
        case '/':
            if ($num2 == 0) {
                return 'Divisão por zero!';
            } else {
                return $num1 / $num2;
            }
        case '!':
            return fatorial($num1);
        case '^':
            return pow($num1, $num2);
        default:
            return 'Operação inválida';
    }
}

function fatorial($num) {
    $fatorial = 1;
    for ($i = 1; $i <= $num; $i++) {
        $fatorial *= $i;
    }
    return $fatorial;
}

function addToMemory($value) {
    if (!isset($_SESSION['memory'])) {
        $_SESSION['memory'] = [];
    }
    $_SESSION['memory'][] = $value;
}

function getMemoryValues() {
    if (isset($_SESSION['memory'])) {
        return end($_SESSION['memory']);
    }
    return null;
}

?>

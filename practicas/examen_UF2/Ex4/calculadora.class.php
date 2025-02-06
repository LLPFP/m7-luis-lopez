<?


class Calculadora{
    function sumar($a, $b){
        return $a + $b;
    }

    function restar($a, $b)
    {
        return $a - $b;
    }
}

$calc = new Calculadora();
echo $calc->sumar(5, 3);

echo $calc->restar(10, 4);

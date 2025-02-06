<?php

class Cotxe {
    public $marca;
    public $model;
 
    public function __construct($model, $marca){
        $this->marca = $marca;
        $this->model = $model;
    }

    function descripcio(){
        return "Aquest cotxe és un " . $this->marca . " " . $this->model;
    }


}


$cotxe = new Cotxe("Toyota", "Corolla");
echo $cotxe->descripcio();

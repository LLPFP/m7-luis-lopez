<?php

class JocAdivinacio{

    public $numeroSecret;
    public $intents; 

    public function __construct($numeroSecret, $intents){
        $this->numeroSecret = $numeroSecret;
        $this->intents = $intents;
    }
    

    public function comprovar($num){
        if($num == $this->numeroSecret){
            return "<p class='bold'>Has encertat el número secret! Has necessitat $this->intents intents.";
            
        }else if($num > $this->numeroSecret){
            echo "Has fallat. El numero es mes petit.";
        } else if ($num < $this->numeroSecret) {
            echo "Has fallat. El numero es mes gran.";
        }
    }
}






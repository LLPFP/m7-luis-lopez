<?php


//saiyajin.php
//sin parentesis como en las funciones
//definimos los atributos



class Saiyajin {
    // Primero modificaciones de acceso ( siempre publico de momento ) protected y private más adelante
    // No dejan de ser variables $
    // Se puede definir o no ( null )
    // Se puede tipar estricto o no (sino php entiende el tipo)
    // public $nombre = "Goku";
    // public $nombre;

    // Es opcional tipar el tipo de variable
    public string $nombre = "Goku";
    public int $nivel_pelea = 1000;

    // Primer metodo o funcion
    // Siempre en mayusculas la primera, ej: Saludar();
    // Podemos devolver mediante un return.
    // Si queremos usar atributos o metodos de dentro de nuestra clase hay que usar $this
    // Podemos tipar la funcion. Obligo a devolver el tipo que le pongas
   
    //                                ↓
    // public function Saludar () : string

    public function Saludar() : string
    {

        return "Hola, mi nombre es " . $this->nombre;
    }


    // Segundo metodo

    // Si añadimos un : int a la siguiente función, no devolvería la frase, ya que interpreta que es un numero integer.


    public function NivelDePelea()
    {
        return $this->nombre . "tiene un nivel de pelea de " . $this->nivel_pelea ;
    }



}



// Fuera de la clase 
// INSTANCIO UNA CLASE
// Creando así un objeto con new Clase()
// Goku u otro nombre
$objeto1 = new Saiyajin();
$goku = new Saiyajin();
$vegeta = new Saiyajin();



// Ambos objetos ahora tienen un nivel de pelea mil y un nombre asociado ( Goku )


// var_dump($goku);


// Con esto mostramos de Goku, el saludo. Todo esto, se muestra de la clase principal, llamando desde el objeto.
// echo $goku->Saludar();
// echo "Mi nivel de pelea es: " . $goku->NivelDePelea();


// var_dump($vegeta);
// Las propiedades seran fijas y las mismas, para eso existe los constructores: Sesión 2.


?>

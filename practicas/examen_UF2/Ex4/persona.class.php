<?

class Persona{
    public string $nom;
    public int $edat;

    function __construct(string $nom, int $edat){
        $this->nom = $nom;
        $this->edat = $edat;
    }
    
}

$persona = new Persona("Maria", "30");

echo $persona->edat;
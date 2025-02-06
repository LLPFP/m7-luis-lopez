<?

class Factura{
    public $client;
    public $producte;
    public $quantitat;
    public $preuUnitari;

    public function __construct($client, $producte, $quantitat, $preuUnitari){
        $this->client = $client;
        $this->producte = $producte;
        $this->quantitat = $quantitat;
        $this->preuUnitari = $preuUnitari;
    }

    public function calcularTotal(){
        return $this->quantitat * $this->preuUnitari;
    }

    public function aplicarDescompte($percentatge){
        $this->preuUnitari = $this->preuUnitari * (1 - $percentatge);
    }

    


}
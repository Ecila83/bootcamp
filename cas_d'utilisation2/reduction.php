<?php
declare(strict_types=1);

class panier{
    const PRIX_BANANE = 1;
    const PRIX_POMME = 1.50;
    const PRIX_VIN = 10;
    const TAXE6 = 1.06;
    const TAXE21 = 1.21;
    const REDUCTION =0.5;

    public $quantiteBanane;
    public $quantitePomme;
    public $quantiteVin;

    public function __construct(int $quantiteBanane, int $quantitePomme, int $quantiteVin){
        $this->quantiteBanane = $quantiteBanane;
        $this->quantitePomme = $quantitePomme;
        $this->quantiteVin = $quantiteVin;
    }

    public function prix(){
        $prix = $this->quantiteBanane * self::PRIX_BANANE +
                $this->quantitePomme * self::PRIX_POMME +
                $this->quantiteVin * self::PRIX_VIN;
        return $prix;
    }

    public function taxe(){
        $taxe6 = ($this->quantiteBanane * self::PRIX_BANANE + $this->quantitePomme * self::PRIX_POMME)/ self::TAXE6;
        $taxe21 = $this->quantiteVin * self::PRIX_VIN / self::TAXE21;
        return $taxe6 + $taxe21;
    }

    public function Htva(){
        $prixHtva = $this->prix()-$this->taxe();
        return $prixHtva;
    }

    public function reduction(){
        $prixFruit = $this->quantiteBanane * self::PRIX_BANANE +
                     $this->quantitePomme * self::PRIX_POMME; 
        $reductionFruit = $prixFruit * self::REDUCTION;
        return $reductionFruit;
    }
}

$panier = new panier(6, 3, 2);
echo "Prix total: " . $panier->prix() . "<br>";
echo "Taxe totale: " . $panier->taxe() . "<br>";
echo "prix Htva: " . $panier->Htva() . "<br>";
echo "reduction: " .$panier->reduction(). "<br>";
echo "prix total aprés reduction: ".($panier->prix()-$panier->reduction()). "<br>";
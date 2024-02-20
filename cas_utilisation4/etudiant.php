<?php
declare(strict_types=1);

class Etudiant {
    private string $nom;
    private float $note;

    public function __construct($nom, $note) {
        $this->nom = $nom;
        $this->note = $note;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getNote(): float {
        return $this->note;
    }
}

class Groupe {
    private array $etudiants;

    public function __construct($etudiants){
        $this->etudiants = $etudiants;
    }

    



}
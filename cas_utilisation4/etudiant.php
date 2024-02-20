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

    public function scoreMoyen(): float {
        $total = 0;
    
        foreach ($this->etudiants as $etudiant) {
            $total += $etudiant->getNote();
        }
    
        return $total / count($this->etudiants);
    }

    public function ajouterEtudiant(Etudiant $etudiant) {
        $this->etudiants[] = $etudiant;
    }

    public function deplacerEtudiant(string $nomEtudiant, Groupe $groupeChange) {
        foreach ($this->etudiants as $index => $etudiant) {
            if ($etudiant->getNom() === $nomEtudiant) {
                $groupeChange->ajouterEtudiant($etudiant);
                unset($this->etudiants[$index]);
                return true;
            }
        }
        return false;
    }
}

$etudiantsGroupe1 = [
    new Etudiant("Jagen", 18),
    new Etudiant("Sophie", 16),
    new Etudiant("Camille", 15),
    new Etudiant("Antoine", 14),
    new Etudiant("Julie", 17),
    new Etudiant("Marie", 19),
    new Etudiant("Luc", 20),
    new Etudiant("Emma", 13),
    new Etudiant("Nicolas", 13),
    new Etudiant("Thomas", 12)
];

$etudiantsGroupe2 = [
    new Etudiant("Mathieu", 14),
    new Etudiant("Elodie", 13),
    new Etudiant("Vincent", 15),
    new Etudiant("Clément", 18),
    new Etudiant("Pauline", 16),
    new Etudiant("Alexandre", 13),
    new Etudiant("Caroline", 19),
    new Etudiant("Julien", 13),
    new Etudiant("Aurélie", 11),
    new Etudiant("Emilie", 20)
];


$groupe1 = new Groupe($etudiantsGroupe1);
$groupe2 = new Groupe($etudiantsGroupe2);


$scoreMoyenGroupe1 = $groupe1->scoreMoyen();
$scoreMoyenGroupe2 = $groupe2->scoreMoyen();

echo "Étudiants du groupe 1 après le déplacement : <br>";
foreach ($groupe1->getEtudiants() as $etudiant) {
    echo $etudiant->getNom() . "<br>";
}

echo "Étudiants du groupe 2 après le déplacement : <br>";
foreach ($groupe2->getEtudiants() as $etudiant) {
    echo $etudiant->getNom() . "<br>";
}

echo "Score moyen du groupe 1 : " . $scoreMoyenGroupe1 . "<br>";
echo "Score moyen du groupe 2 : " . $scoreMoyenGroupe2 . "<br>";

$groupe1->deplacerEtudiant("Jagen", $groupe2);
$groupe2->deplacerEtudiant("Vincent", $groupe1);

echo "Étudiants du groupe 1 après le déplacement : <br>";
foreach ($groupe1->getEtudiants() as $etudiant) {
    echo $etudiant->getNom() . "<br>";
}

echo "Étudiants du groupe 2 après le déplacement : <br>";
foreach ($groupe2->getEtudiants() as $etudiant) {
    echo $etudiant->getNom() . "<br>";
}
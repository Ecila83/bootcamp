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

    public function getEtudiants(): array {
        return $this->etudiants;
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
    public function trouverMeilleurEtMoinsBonEtudiant(): array {
        $meilleurEtudiant = null;
        $moinsBonEtudiant = null;
        $meilleureNote = -INF;
        $moinsBonneNote = INF;
    
        foreach ($this->etudiants as $etudiant) {
            $note = $etudiant->getNote();
            if ($note > $meilleureNote) {
                $meilleureNote = $note;
                $meilleurEtudiant = $etudiant;
            }
            if ($note < $moinsBonneNote) {
                $moinsBonneNote = $note;
                $moinsBonEtudiant = $etudiant;
            }
        }
    
        return [$meilleurEtudiant, $moinsBonEtudiant];
    }
  
    public function echangerEtudiant(Groupe $autreGroupe) {
        [$meilleurEtudiantCeGroupe, $moinsBonEtudiantCeGroupe] = $this->trouverMeilleurEtMoinsBonEtudiant();
        [$meilleurEtudiantAutreGroupe, $moinsBonEtudiantAutreGroupe] = $autreGroupe->trouverMeilleurEtMoinsBonEtudiant();
        
        
        $this->deplacerEtudiant($moinsBonEtudiantCeGroupe->getNom(), $autreGroupe);
        $this->deplacerEtudiant($meilleurEtudiantCeGroupe->getNom(), $autreGroupe);
        $autreGroupe->deplacerEtudiant($moinsBonEtudiantAutreGroupe->getNom(), $this);
        $autreGroupe->deplacerEtudiant($meilleurEtudiantAutreGroupe->getNom(), $this);
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
    new Etudiant("Aurélie", 3),
    new Etudiant("Emilie", 20)
];

$groupe1 = new Groupe($etudiantsGroupe1);
$groupe2 = new Groupe($etudiantsGroupe2);


$scoreMoyenGroupe1 = $groupe1->scoreMoyen();
$scoreMoyenGroupe2 = $groupe2->scoreMoyen();

echo "<br>Étudiants du groupe 1 avant le déplacement : <br>";
foreach ($groupe1->getEtudiants() as $etudiant) {
    echo $etudiant->getNom() . "<br>";
}

echo "<br>Étudiants du groupe 2 avant le déplacement : <br>";
foreach ($groupe2->getEtudiants() as $etudiant) {
    echo $etudiant->getNom() . "<br>";
}

echo "<br>Score moyen du groupe 1 : " . $scoreMoyenGroupe1 . "<br>";
echo "Score moyen du groupe 2 : " . $scoreMoyenGroupe2 . "<br>";

$groupe1->deplacerEtudiant("Jagen", $groupe2);
$groupe2->deplacerEtudiant("Vincent", $groupe1);

echo "<br>Étudiants du groupe 1 après le déplacement : <br>";
foreach ($groupe1->getEtudiants() as $etudiant) {
    echo $etudiant->getNom() . "<br>";
}

echo "<br>Étudiants du groupe 2 après le déplacement : <br>";
foreach ($groupe2->getEtudiants() as $etudiant) {
    echo $etudiant->getNom() . "<br>";
}

[$meilleurEtudiantGroupe1, $moinsBonEtudiantGroupe1] = $groupe1->trouverMeilleurEtMoinsBonEtudiant();
[$meilleurEtudiantGroupe2, $moinsBonEtudiantGroupe2] = $groupe2->trouverMeilleurEtMoinsBonEtudiant();

echo "<br>Meilleur étudiant du groupe 1 : " . $meilleurEtudiantGroupe1->getNom() . " avec une note de " . $meilleurEtudiantGroupe1->getNote() . "<br>";
echo "Moins bon étudiant du groupe 1 : " . $moinsBonEtudiantGroupe1->getNom() . " avec une note de " . $moinsBonEtudiantGroupe1->getNote() . "<br>";
echo "Meilleur étudiant du groupe 2 : " . $meilleurEtudiantGroupe2->getNom() . " avec une note de " . $meilleurEtudiantGroupe2->getNote() . "<br>";
echo "Moins bon étudiant du groupe 2 : " . $moinsBonEtudiantGroupe2->getNom() . " avec une note de " . $moinsBonEtudiantGroupe2->getNote() . "<br>";


$groupe1->echangerEtudiant($groupe2);


echo "<br>Après l'échange des étudiants : <br>";

[$meilleurEtudiantGroupe1, $moinsBonEtudiantGroupe1] = $groupe1->trouverMeilleurEtMoinsBonEtudiant();
[$meilleurEtudiantGroupe2, $moinsBonEtudiantGroupe2] = $groupe2->trouverMeilleurEtMoinsBonEtudiant();

echo "<br>Meilleur étudiant du groupe 1 : " . $meilleurEtudiantGroupe1->getNom() . " avec une note de " . $meilleurEtudiantGroupe1->getNote() . "<br>";
echo "Moins bon étudiant du groupe 1 : " . $moinsBonEtudiantGroupe1->getNom() . " avec une note de " . $moinsBonEtudiantGroupe1->getNote() . "<br>";
echo "Meilleur étudiant du groupe 2 : " . $meilleurEtudiantGroupe2->getNom() . " avec une note de " . $meilleurEtudiantGroupe2->getNote() . "<br>";
echo "Moins bon étudiant du groupe 2 : " . $moinsBonEtudiantGroupe2->getNom() . " avec une note de " . $moinsBonEtudiantGroupe2->getNote(). "<br>";

echo "<br>Étudiants du groupe 1 après l'échange : <br>";
foreach ($groupe1->getEtudiants() as $etudiant) {
    echo $etudiant->getNom() . "<br>";
}

echo "<br>"."<br>";

echo "Étudiants du groupe 2 après l'échange : <br>";
foreach ($groupe2->getEtudiants() as $etudiant) {
    echo $etudiant->getNom() . "<br>";
}

echo "<br>Score moyen du groupe 1 : " . $groupe1->scoreMoyen() . "<br>";
echo "Score moyen du groupe 2 : " . $groupe2->scoreMoyen() . "<br>";

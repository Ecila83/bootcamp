<?php
declare(strict_types=1);

class Contenu {
    public $titre;
    public $texte;

    public function __construct(string $titre, string $texte){
        $this->titre = $titre;
        $this->texte = $texte;
    }

    public function afficherTitre(){
        return "<h2>".$this->titre . "</h2>";
    }

    public function afficherTexte(){
        return "<p>".$this->texte."</p>";
    }
}

Class Article extends Contenu {
    const BREAKINGNEWS = "Breaking News";
    const BREAKING = "BREAKING : ";

    public $titreSuivant;

    public function __construct(string $titre, string $texte, string $titreSuivant = null) {
        parent::__construct($titre, $texte);
        $this->titreSuivant = $titreSuivant;
    }
       
    public function titreArticle(){
       
        if($this->titre === self::BREAKINGNEWS && $this->titreSuivant !== null){
            return "<h2>".self::BREAKING.$this->titreSuivant."</h2>";
        }else{
            return parent::afficherTitre();
        }
    }

}

class Annonce extends Contenu {
    public function titreAnnonce(){
        return "<h2>" .mb_strtoupper($this->titre)."</h2>";
    }
}

class PosteVacant extends Contenu {
    public string $offre =" - Postulez maintenant!";

    public function titrePosteVacant(){
        return "<h2>" .$this->titre.$this->offre."</h2>";
    }
}

$contenus = [];


$contenus[] = new Article("Les avantages de la technologie moderne", "La technologie moderne a révolutionné notre façon de vivre et de travailler. Dans cet article, nous explorons les nombreux avantages de l'utilisation de la technologie dans différents aspects de notre vie quotidienne.");
$contenus[] = new Article("Breaking News", "Une nouvelle importante vient de tomber. Restez à l'écoute pour plus de détails.", "Fantastic!");

$contenus[] = new Annonce("Offre spéciale : Vente Flash !", "Ne manquez pas notre vente flash exclusive ! Des réductions incroyables sur une large gamme de produits. Faites vite, l'offre se termine bientôt !");

$contenus[] = new PosteVacant("Développeur Web Full Stack recherché", "Nous recherchons un développeur Web Full Stack talentueux pour rejoindre notre équipe dynamique. Si vous êtes passionné par la création de sites Web et que vous avez une expérience pratique avec les technologies de développement Web.");

foreach ($contenus as $contenu) {
    if ($contenu instanceof Article) {
        echo $contenu->titreArticle(); 
    } else {
        echo $contenu->afficherTitre(); 
    }
    echo $contenu->afficherTexte();
}



<?php

namespace App\Controller; // tous les namespace qui ne commencent pas par "APP" sont dans le vendor

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; //crée un alias pour la class pour faciliter le chemin pour retrouver la class
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @route("/test")
     */
    #[Route('/test', name: 'app_test')] //quand on veut créer une nouvelle route  on utilisera cette méthode (#)
        // pour créer un nouvel affichage c'est une nouvelle route
    public function index(): Response
    {
        return $this->render('test/index.html.twig', [
            'controller_name' => 'bonjour',
            'texte' => 'le texte que je veux afficher'
        ]);
    }

    /* Exercices :
    Ajouter une route pour le chemin "/test/calcul" qui utilise le fichier test/index.html.twig et qui affiche le résultat de 12+7
    */
    /**
     * @route("/test/calcul")
     */
    #[Route('/test/calcul', name:'test_calcul')]
    public function calcul(): Response
    {
        return $this->render('test/index.html.twig',[
            'controller_name' => 'Gaelle :',
            'texte' => 'Hello',
            'calcul' => 12 + 7
        ]);
    }

    /**
     * @route("/test/salut")
     */
    #[Route('/test/salut')]
    public function salut(){
         return $this->render("test/salut.html.twig", ["prenom" => "Gaelle"]);
    }

    /**
     * @route("/test/tableau")
     */
    #[Route('/test/tableau')]
    public function tableau(){
        $array = ["bonjour", "je m'appelle", 789, true];
        return $this->render("test/tableau.html.twig", [
            "tableau" => $array
        ]);
    }
}

<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\GameRepository;

class GameController extends AbstractController
{
    /**
     * @Route("/admin/game", name="app_admin_game")
     */
    public function index(GameRepository $gameRepository): Response
    {


        /* On ne PEUT PAS instancier d'objets d'une classe Repository
            on doit les passer dans les arguments d'une méthode d'un contrôleur
            NB : pour chaque classe Entity créée, il y a une classe Repository
                qui correspond et qui permet de faire des requêtes SELECT sur la
                table correspondante */
//        $gameRepository = new GameRepository;
        return $this->render('admin/game/index.html.twig', [
            'controller_name' => 'GameController',
            "games" => $gameRepository->findAll()
        ]);
    }
}

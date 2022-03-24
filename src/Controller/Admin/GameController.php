<?php

namespace App\Controller\Admin;

use App\Repository\PlayerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\GameRepository;

class GameController extends AbstractController
{
    /**
     * @Route("/admin/game", name="app_admin_game")
     */
    public function index(GameRepository $gameRepository, PlayerRepository $playerRepository): Response
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

//    /**
//     * @Route("/admin/game", name="app_admin_game")
//     * @Route("/admin/show/{id}", name="show")
//     *
//     */
//    public function index(GameRepository $gameRepository, PlayerRepository $playerRepository, $id = null): Response
//    {
//        // une table de BDD est correspondante à une entité dans l'app.
//        // Lorsque l'on souhaite récupérer des données d'une table en bdd ( requete de SELECT )
//        // il nous faut appeler le repository de l'entité (table) sur laquelle la requete a lieu
//        if ($id):
//            $player=$playerRepository->find($id);
//        else:
//            $player=false;
//        endif;
//
//
//        $players = $playerRepository->findAll();
//
////        dump($players);
//        //dd($players);
//
//
//        /* On ne PEUT PAS instancier d'objets d'une classe Repository
//            on doit les passer dans les arguments d'une méthode d'un contrôleur
//            NB : pour chaque classe Entity créée, il y a une classe Repository
//                qui correspond et qui permet de faire des requêtes SELECT sur la
//                table correspondante */
////        $gameRepository = new GameRepository;
//        return $this->render('admin/game/index.html.twig', [
//            'controller_name' => 'GameController',
//            "games" => $gameRepository->findAll(),
//            "players" => $players,
//            "player"=>$player
//        ]);
//    }
}

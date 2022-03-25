<?php

namespace App\Controller\Admin;

use App\Repository\PlayerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\GameRepository;
use App\Entity\Game;
use App\Form\GameType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



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

    /**
     * @Route("/admin/game/new", name="app_admin_game_new")
     *
     * La classe Request permet d'instancier un objet qui contient
     * toutes les valeurs des variables super-globales de PHP.
     * Ces valeurs sont dans des propriétés (qui sont des objets).
     *  $request->query      contient        $_GET
     *  $request->request    contient        $_POST
     *  $request->server     contient        $SERVER
     * ...
     *  Pour accéder aux valeurs, on utilisera sur ces propriétés la
     *  méthode ->get('indice')
     *
     * La classe EntityMangager va permettre d'exécuter les requêtes
     *  qui modifient les données (INSERT, UPDATE, DELETE).
     *  L'EntityManager va toujours utiliser des objets Entity pour
     *  modifier les données.
     */
    public function new(Request $request, EntityManagerInterface $em)
    {
        $jeu = new Game;
        /* On crée un objet $form pour gérer le formulaire. Il est créé
            à partir de la classe GameType. On relie ce formulaire à
            l'objet $jeu */
        $form = $this->createForm(GameType::class, $jeu);

        /* L'objet $form va gérer ce qui vient de la requête HTTP
            (avec l'objet $request) */
        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ){
            // la méthode persist() prépare la requête INSERT avec les données de l'objet passé en argument
            $em->persist($jeu);

            // la méthode flush() exécute les requêtes en attente et donc modifie la base de données
            $em->flush();
            //redirection vers une route du projet
            return $this->redirectToRoute("app_admin_game");
        }

        return $this->render("admin/game/form.html.twig", [
            "formGame" => $form->createView()
        ]);
    }
    /**
     * @Route("/admin/game/edit/{id}", name="app_admin_game_edit")
     */
    public function edit($id){
        dd($id);
    }
}

<?php

namespace App\Controller;

use App\Entity\Player;
use App\Entity\MatchMaker;
use App\Controller\PlayerController;
use App\Repository\MatchMakerRepository;
use App\Repository\PlayerRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home", methods={"GET"})
     */
    public function index(PlayerRepository $playerRepository, MatchMakerRepository $matchMakerRepository): Response
    {
        $me = $this->getUser();
        $players = $playerRepository->findAll();
        $top10Players = $playerRepository->top10($players);

        $myMatches = $matchMakerRepository->getMyMatches($me);

        return $this->render('home/index.html.twig', [
            'me' => $me,
            'top10Players' => $top10Players,
            'matches' => $myMatches
        ]);
    }

    /**
     * @Route("/name/{name}", name="displayName")
     */
    public function displayName(Request $request): Response
    {
        dump($name = $request->get('name'));

        return new Response($name);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Story;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_default')]
    public function index(EntityManagerInterface $manager): Response
    {
        $story = $manager->getRepository(Story::class)->getRandomStory();


        return $this->render("default.html.twig", array(
            "toto" => "Hello Hadel",
            "story" => $story
        ));
    }


    // #[Route('/apiRoute', name: 'apiRoute')]
    // public function apiRoute(HttpClientInterface $client): Response
    // {
    //     $reponse = $client->request('GET', 'https://baconipsum.com/api/?type=meat-and-filler&paras=5&format=text'); // POUR LES APIs
    //     $result = $reponse->getContent();


    //     // die('An error occurred');

    //     return $this->render("stories.html.twig", array(
    //         "result" => $result
    //     ));
    // }
}

// class Rand extends \Doctrine\ORM\Query\AST\Functions\FunctionNode
// {

//     public function parse(\Doctrine\ORM\Query\Parser $parser)
//     {
//         $parser->match(Lexer::T_IDENTIFIER);
//         $parser->match(Lexer::T_OPEN_PARENTHESIS);
//         $parser->match(Lexer::T_CLOSE_PARENTHESIS);
//     }

//     public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
//     {
//         return 'Rand()';
//     }
// }

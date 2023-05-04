<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/article', name: 'app_article', methods:['GET'])]
    public function index(): Response
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }

    #[Route('/article/{id}', name:'one_article', methods:['GET'])]
    public function get(EntityManagerInterface $em, $id){

        $article = $em->getRepository(Article::class)->findArticleById($id);
        
        if($article == null){
            return new JsonResponse('Article introuvable', 404);
        }

        return new JsonResponse($article, 200);
    }
}

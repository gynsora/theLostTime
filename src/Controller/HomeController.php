<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 18/12/2018
 * Time: 10:37
 */

namespace App\Controller;



use App\Entity\Article;
use App\Entity\Classe;
use App\Entity\Esprit;
use App\Entity\Sort;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{


    /**
     * @return Response
     * @Route("/")
     */
    public function home():Response
    {
        $articleRepository = $this->getDoctrine()->getRepository(Article::class);
        $article = $articleRepository->findBy(['isPublished' =>true]);
        return $this->render('index.html.twig',['articles'=>$article]);

    }
    /**
     * @return Response
     * @Route("/article/{id}")
     */
    public function detailArticle(Article $article):Response
    {
        //$articleRepository = $this->getDoctrine()->getRepository(Article::class);
        //$article = $articleRepository->findBy(['isPublished' =>true]);
        //return $this->render('article.html.twig',['articles'=>$article]);
        return $this->render('detail_article.html.twig',compact('article'));
    }
    /**
     * @return Response
     * @Route("/story")
     */
    public function gameStory():Response
    {
        return $this->render('story.html.twig');
    }
    /**
     * @return Response
     * @Route("/classe")
     */
    public function gameClasse():Response
    {
        //return $this->render('classe.html.twig');
		$classeRepository = $this->getDoctrine()->getRepository(Classe::class);
        $classe = $classeRepository->findAll();
		$espritRepository = $this->getDoctrine()->getRepository(Esprit::class);
        $esprit = $espritRepository->findAll();
        $sortRepository = $this->getDoctrine()->getRepository(Sort::class);
        $sort = $sortRepository->findAll();
        return $this->render('classe.html.twig',['classes'=>$classe, 'esper'=>$esprit ,'sorts'=>$sort]);
    }

    /**
     * @return Response
     * @Route("/inscription")
     */
    public function inscription():Response
    {
        return $this->render('inscription.html.twig');
    }



    
}
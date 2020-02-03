<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 19/12/2018
 * Time: 09:34
 */



namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/moderateur")
 */
class EditorController extends AbstractController
{
    /**
     * @return Response
     * @Route("/")
     */
    public function home():Response
    {
        $articleRepository = $this->getDoctrine()->getRepository(Article::class);
        $article = $articleRepository->findBy(['isPublished' =>true]);
        return $this->render('moderateur/index.html.twig',['articles'=>$article]);
    }
    /***************************************************************************
     * CREATE Article
     **************************************************************************/
    /**
     * @return Response
     * @throws \Exception
     * @Route("/article/creation")
     */
    public function createArticle(Request $request):Response
    {
        //Création du formulaire
        $article = new Article();
        $form = $this->createForm(ArticleType::class,$article);

        /*Traitement du formulaire*/
        // Récuperation $_POST
        $form->handleRequest($request);

        //verification validité des données
        if($form->isSubmitted() && $form->isValid()){
            //Données valider
            $article = $form->getData();
            //Insert
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($article);
            $manager->flush();
            $this->addFlash('success','article ajouté avec succès');
            return $this->redirectToRoute('app_editor_home');

        }

        //renvoi du formulaire à la vue
        return $this->render('moderateur/article/create.html.twig',['createForm'=>$form->createView()]);
    }

    /********************************************************************************
     * UPDATE Article
     ********************************************************************************/
    /**
     *  @Route("/article/edition/{id}")
     * @return Response
     */
    public function updateArticle(Article $article,Request $request):Response
    {
        //Création du formulaire
        $form = $this->createForm(ArticleType::class,$article);

        /*Traitement du formulaire*/
        // Récuperation $_POST
        $form->handleRequest($request);
        //verification validité des données
        if($form->isSubmitted() && $form->isValid()){
            //Données valider
            $article = $form->getData();
            //Insert
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($article);
            $manager->flush();
            $this->addFlash('warning','Votre article a bien été modifier');
            return $this->redirectToRoute('app_editor_home');
        }

        //renvoi du formulaire à la vue
        return $this->render('moderateur/article/update.html.twig',['createForm'=>$form->createView()]);

    }
    /***************************************************************************
     * DELETE Article
     **************************************************************************/
    /**
     * @Route("/article/delete/{id}")
     */
    public function deleteArticle(Article $article)
    {
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($article);
        $manager->flush();
        $this->addFlash('danger','Votre sort a bien été supprimer');
        return $this->redirectToRoute( " app_editor_home");
    }
}
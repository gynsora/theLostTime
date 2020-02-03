<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 18/12/2018
 * Time: 11:28
 */

namespace App\Controller;

use App\Entity\Classe;
use App\Entity\Element;
use App\Entity\Esprit;
use App\Entity\Image;
use App\Entity\Images;
use App\Entity\Sort;
use App\Form\ClasseType;
use App\Form\ElementType;
use App\Form\EspritType;
use App\Form\ImagesType;
use App\Form\ImageType;
use App\Form\SortType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 *  @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @return Response
     * @Route("/")
     */
    public function home():Response
    {

        return $this->render('admin/index.html.twig');
    }
    /***************************************************************************
     * READ Image
     **************************************************************************/
    /**
     * @return Response
     * @Route("/image")
     */
    public function readImage():Response
    {
        $imageRepository = $this->getDoctrine()->getRepository(Image::class);
        $images = $imageRepository->findAll();
        return $this->render('admin/image/index.html.twig',['images'=>$images]);
    }

    /***************************************************************************
     * CREATE Image
     **************************************************************************/
    /**
     * @return Response
     * @throws \Exception
     * @Route("/image/creation")
     */
    public function createImage(Request $request):Response
    {
        //Création du formulaire
        $image = new Image();
        $form = $this->createForm(ImageType::class,$image);

        /*Traitement du formulaire*/
        // Récuperation $_POST
        $form->handleRequest($request);

        //verification validité des données
        if($form->isSubmitted() && $form->isValid() ){
            //Données valider
            $image = $form->getData();
            //Insert
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($image);
            $manager->flush();
            $this->addFlash('success','image ajouté avec succès');
            return $this->redirectToRoute('app_admin_readimage');

        }

        //renvoi du formulaire à la vue
        return $this->render('admin/image/create.html.twig',['createForm'=>$form->createView()]);
    }


    /********************************************************************************
     * UPDATE Image
     ********************************************************************************/
    /**
     *  @Route("/image/edition/{id}")
     * @return Response
     */
    public function updateImage(Image $image,Request $request):Response
    {
        //Création du formulaire
        $form = $this->createForm(ImageType::class,$image);

        /*Traitement du formulaire*/
        // Récuperation $_POST
        $form->handleRequest($request);
        //verification validité des données
        if($form->isSubmitted() && $form->isValid()){
            //Données valider
            $image = $form->getData();
            //Insert
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($image);
            $manager->flush();
            $this->addFlash('warning','Votre imageà bien été modifiée');
            return $this->redirectToRoute('app_admin_readimage');
        }

        //renvoi du formulaire à la vue
        return $this->render('admin/image/update.html.twig',['createForm'=>$form->createView()]);

    }
    /***************************************************************************
     * DELETE Image
     **************************************************************************/
    /**
     * @Route("/image/delete/{id}")
     */
    public function deleteImage(Image $image)
    {
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($image);
        $manager->flush();
        $this->addFlash('danger','Votre image à bien été supprimée');
        return $this->redirectToRoute( "app_admin_readimage");
    }





    /***************************************************************************
     * READ Classe
     **************************************************************************/
    /**
     * @return Response
     * @Route("/classe")
     */
    public function readClasse():Response
    {
        $classeRepository = $this->getDoctrine()->getRepository(Classe::class);
        $classe = $classeRepository->findAll();
        return $this->render('admin/classe/index.html.twig',['classes'=>$classe]);
    }
    /***************************************************************************
     * CREATE Classe
     **************************************************************************/
    /**
     * @return Response
     * @throws \Exception
     * @Route("/classe/creation")
     */
    public function createClasse(Request $request):Response
    {
        //Création du formulaire
        $image = new Classe();
        $form = $this->createForm(ClasseType::class,$image);

        /*Traitement du formulaire*/
        // Récuperation $_POST
        $form->handleRequest($request);

        //verification validité des données
        if($form->isSubmitted() && $form->isValid()){
            //Données valider
            $image = $form->getData();
            //Insert
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($image);
            $manager->flush();
            $this->addFlash('success','classe ajoutée avec succès');
            return $this->redirectToRoute('app_admin_readclasse');

        }

        //renvoi du formulaire à la vue
        return $this->render('admin/classe/create.html.twig',['createForm'=>$form->createView()]);
    }
    /********************************************************************************
     * UPDATE Classe
     ********************************************************************************/
    /**
     *  @Route("/classe/edition/{id}")
     * @return Response
     */
    public function updateClasse(Classe $classe,Request $request):Response
    {
        //Création du formulaire
        $form = $this->createForm(ClasseType::class,$classe);

        /*Traitement du formulaire*/
        // Récuperation $_POST
        $form->handleRequest($request);
        //verification validité des données
        if($form->isSubmitted() && $form->isValid()){
            //Données valider
            $classe = $form->getData();
            //Insert
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($classe);
            $manager->flush();
            $this->addFlash('warning','Votre image à bien été modifiée');
            return $this->redirectToRoute('app_admin_readclasse');
        }

        //renvoi du formulaire à la vue
        return $this->render('admin/classe/update.html.twig',['createForm'=>$form->createView()]);

    }
    /***************************************************************************
     * DELETE Classe
     **************************************************************************/
    /**
     * @Route("/classe/delete/{id}")
     */
    public function deleteClasse(Classe $classe)
    {
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($classe);
        $manager->flush();
        $this->addFlash('danger','Votre classe à bien été supprimée');
        return $this->redirectToRoute( "app_admin_readclasse");
    }




    /***************************************************************************
     * READ Element
     **************************************************************************/
    /**
     * @return Response
     * @Route("/element")
     */
    public function readElement():Response
    {
        $elementRepository = $this->getDoctrine()->getRepository(Element::class);
        $element = $elementRepository->findAll();
        return $this->render('admin/element/index.html.twig',['elements'=>$element]);
    }
    /***************************************************************************
     * CREATE Element
     **************************************************************************/
    /**
     * @return Response
     * @throws \Exception
     * @Route("/element/creation")
     */
    public function createElement(Request $request):Response
    {
        //Création du formulaire
        $element = new Element();
        $form = $this->createForm(ElementType::class,$element);

        /*Traitement du formulaire*/
        // Récuperation $_POST
        $form->handleRequest($request);

        //verification validité des données
        if($form->isSubmitted() && $form->isValid()){
            //Données valider
            $image = $form->getData();
            //Insert
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($image);
            $manager->flush();
            $this->addFlash('success','élément ajouté avec succès');
            return $this->redirectToRoute('app_admin_readelement');

        }

        //renvoi du formulaire à la vue
        return $this->render('admin/element/create.html.twig',['createForm'=>$form->createView()]);
    }
    /********************************************************************************
     * UPDATE Element
     ********************************************************************************/
    /**
     *  @Route("/element/edition/{id}")
     * @return Response
     */
    public function updateElement(Element $element,Request $request):Response
    {
        //Création du formulaire
        $form = $this->createForm(ElementType::class,$element);

        /*Traitement du formulaire*/
        // Récuperation $_POST
        $form->handleRequest($request);
        //verification validité des données
        if($form->isSubmitted() && $form->isValid()){
            //Données valider
            $element = $form->getData();
            //Insert
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($element);
            $manager->flush();
            $this->addFlash('warning','Votre élément à bien été modifié');
            return $this->redirectToRoute('app_admin_readelement');
        }

        //renvoi du formulaire à la vue
        return $this->render('admin/element/update.html.twig',['createForm'=>$form->createView()]);

    }
    /***************************************************************************
     * DELETE Element
     **************************************************************************/
    /**
     * @Route("/element/delete/{id}")
     */
    public function deleteElement(Element $element)
    {
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($element);
        $manager->flush();
        $this->addFlash('danger','Votre element à bien été supprimé');
        return $this->redirectToRoute( "app_admin_readelement");
    }





    /***************************************************************************
     * READ Esprit
     **************************************************************************/
    /**
     * @return Response
     * @Route("/esprit")
     */
    public function readEsprit():Response
    {
        $espritRespository = $this->getDoctrine()->getRepository(Esprit::class);
        $esprit = $espritRespository->findAll();
        return $this->render('admin/esprit/index.html.twig',['esprits'=>$esprit]);
    }
    /***************************************************************************
     * CREATE Esprit
     **************************************************************************/
    /**
     * @return Response
     * @throws \Exception
     * @Route("/esprit/creation")
     */
    public function createEsprit(Request $request):Response
    {
        //Création du formulaire
        $element = new Esprit();
        $form = $this->createForm(EspritType::class,$element);

        /*Traitement du formulaire*/
        // Récuperation $_POST
        $form->handleRequest($request);

        //verification validité des données
        if($form->isSubmitted() && $form->isValid()){
            //Données valider
            $image = $form->getData();
            //Insert
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($image);
            $manager->flush();
            $this->addFlash('success','esprit ajouté avec succès');
            return $this->redirectToRoute('app_admin_readesprit');

        }

        //renvoi du formulaire à la vue
        return $this->render('admin/esprit/create.html.twig',['createForm'=>$form->createView()]);
    }
    /********************************************************************************
     * UPDATE Esprit
     ********************************************************************************/
    /**
     *  @Route("/esprit/edition/{id}")
     * @return Response
     */
    public function updateEsprit(Esprit $esprit,Request $request):Response
    {
        //Création du formulaire
        $form = $this->createForm(EspritType::class,$esprit);

        /*Traitement du formulaire*/
        // Récuperation $_POST
        $form->handleRequest($request);
        //verification validité des données
        if($form->isSubmitted() && $form->isValid()){
            //Données valider
            $esprit = $form->getData();
            //Insert
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($esprit);
            $manager->flush();
            $this->addFlash('warning','Votre esprit à bien été modifié');
            return $this->redirectToRoute('app_admin_readesprit');
        }

        //renvoi du formulaire à la vue
        return $this->render('admin/esprit/update.html.twig',['createForm'=>$form->createView()]);

    }
    /***************************************************************************
     * DELETE Esprit
     **************************************************************************/
    /**
     * @Route("/esprit/delete/{id}")
     */
    public function deleteEsprit(Esprit $esprit)
    {
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($esprit);
        $manager->flush();
        $this->addFlash('danger','Votre esprit à bien été supprimé');
        return $this->redirectToRoute( "app_admin_readesprit");
    }





    /***************************************************************************
     * READ Sort
     **************************************************************************/
    /**
     * @return Response
     * @Route("/sort")
     */
    public function readSort():Response
    {
        $sortRespository = $this->getDoctrine()->getRepository(Sort::class);
        $sort = $sortRespository->findAll();
        return $this->render('admin/sort/index.html.twig',['sorts'=>$sort]);
    }
    /***************************************************************************
     * CREATE Sort
     **************************************************************************/
    /**
     * @return Response
     * @throws \Exception
     * @Route("/sort/creation")
     */
    public function createSort(Request $request):Response
    {
        //Création du formulaire
        $sort = new Sort();
        $form = $this->createForm(SortType::class,$sort);

        /*Traitement du formulaire*/
        // Récuperation $_POST
        $form->handleRequest($request);

        //verification validité des données
        if($form->isSubmitted() && $form->isValid()){
            //Données valider
            $sort = $form->getData();
            //Insert
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($sort);
            $manager->flush();
            $this->addFlash('success','sort ajouté avec succès');
            return $this->redirectToRoute('app_admin_readsort');

        }

        //renvoi du formulaire à la vue
        return $this->render('admin/sort/create.html.twig',['createForm'=>$form->createView()]);
    }
    /********************************************************************************
     * UPDATE Sort
     ********************************************************************************/
    /**
     *  @Route("/sort/edition/{id}")
     * @return Response
     */
    public function updateSort(Sort $sort,Request $request):Response
    {
        //Création du formulaire
        $form = $this->createForm(SortType::class,$sort);

        /*Traitement du formulaire*/
        // Récuperation $_POST
        $form->handleRequest($request);
        //verification validité des données
        if($form->isSubmitted() && $form->isValid()){
            //Données valider
            $sort = $form->getData();
            //Insert
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($sort);
            $manager->flush();
            $this->addFlash('warning','Votre sort à bien été modifié');
            return $this->redirectToRoute('app_admin_readsort');
        }

        //renvoi du formulaire à la vue
        return $this->render('admin/sort/update.html.twig',['createForm'=>$form->createView()]);

    }
    /***************************************************************************
     * DELETE Esprit
     **************************************************************************/
    /**
     * @Route("/sort/delete/{id}")
     */
    public function deleteSort(Sort $sort)
    {
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($sort);
        $manager->flush();
        $this->addFlash('danger','Votre sort à bien été supprimé');
        return $this->redirectToRoute( "app_admin_readsort");
    }






    /**
     * @Route("/upload")
     */
    public function createUpload(Request $request):Response
    {
        $images = new Images();
        $form = $this->createForm(ImagesType::class,$images);

        /*Traitement du formulaire*/
        // Récuperation $_POST
        $form->handleRequest($request);

        //verification validité des données
        if($form->isSubmitted() && $form->isValid()){
            //Données valider
            $images = $form->getData();
            //Insert
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($images);
            $manager->flush();
            $this->addFlash('success','image uploader avec succès');
            return $this->redirectToRoute('app_admin_readimage');

        }

        $createForm = $this->createForm(ImagesType::class, $images);
        return $this->render('admin/create_upload.html.twig',["createForm" => $createForm->createView()]);
    }
    /********************************************************************************
     * UPDATE upload
     ********************************************************************************/
    /**
     *  @Route("/upload/edition/{id}")
     * @return Response
     */
    public function updateUpload(Request $request,string $id ):Response
    {
        $images = $this->getDoctrine()->getRepository(Images::class)->find($id);
        //Création du formulaire
        $form = $this->createForm(ImagesType::class,$images);

        /*Traitement du formulaire*/
        // Récuperation $_POST
        $form->handleRequest($request);
        //verification validité des données
        if($form->isSubmitted() && $form->isValid()){
            //Données valider
            $images = $form->getData();
            //Insert
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($images);
            dump($images);
            $manager->flush();
            dump($images);
            $this->addFlash('warning','Votre image à bien été modifié');
            return $this->redirectToRoute('app_admin_readimage');
        }

        //renvoi du formulaire à la vue
        return $this->render('admin/update_upload.html.twig',['createForm'=>$form->createView()]);

    }
}
<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 20/12/2018
 * Time: 16:20
 */

namespace App\Controller;


use App\Entity\User;
use App\Form\UserEditType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /***************************************************************************
     * READ User
     **************************************************************************/
    /**
     * @return Response
     * @Route("/admin/user")
     */
    public function readUser():Response
    {
        $userRepository = $this->getDoctrine()->getRepository(User::class);
        $user = $userRepository->findAll();
        return $this->render('admin/user/index.html.twig',['users'=>$user]);
    }
    /**
     * @param User $user
     * @return Response
     * @Route("admin/user/edit/{id}")
     */
    public function updateUser(User $user, Request $request):Response
    {

        //Création du formulaire
        $form = $this->createForm(UserEditType::class,$user);

        /*Traitement du formulaire*/
        // Récuperation $_POST
        $form->handleRequest($request);
        //verification validité des données
        if($form->isSubmitted() && $form->isValid()){
            //Données valider
            $user = $form->getData();
            //Insert
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();
            $this->addFlash('warning',"les droits de l'utilisateur ont bien été modifier");
            return $this->redirectToRoute('app_user_readuser');
        }

        //renvoi du formulaire à la vue
        return $this->render('admin/user/edit.html.twig',['createForm'=>$form->createView()]);

    }

}
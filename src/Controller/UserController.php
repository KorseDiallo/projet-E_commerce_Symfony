<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin')]
final class UserController extends AbstractController
{
    #[Route('/users', name: 'app_user')]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/users/{id}/to/editor', name: 'app_user_to_editor')]
    public function changeRole(User $user, EntityManagerInterface $em):Response
    {
        $user->setRoles(["ROLE_EDITOR","ROLE_USER"]);
        $em->flush();
        $this->addFlash("success","Le rôle éditeur a été ajouté à votre utilisateur");
       return  $this->redirectToRoute("app_user");
        
    }

    #[Route('/users/{id}/remove/editor/role', name: 'app_user_remove_editor_role')]
    public function editorRoleRemove(User $user, EntityManagerInterface $em):Response
    {
        $user->setRoles([]);
        $em->flush();
        $this->addFlash("success","Le rôle éditeur a été retiré à votre utilisateur");
       return  $this->redirectToRoute("app_user");
        
    }

     #[Route('/users/{id}/remove', name: 'app_user_remove')]
    public function userRemove(User $user, EntityManagerInterface $em):Response
    {
        $em->remove($user);
        $em->flush();
        $this->addFlash('danger','Utilisateur  supprimé avec succès');
        return  $this->redirectToRoute("app_user");
        
    }
}

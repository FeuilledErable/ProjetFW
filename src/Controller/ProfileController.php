<?php

namespace App\Controller;

use App\Repository\AtelierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(AtelierRepository $atelierRepository): Response
    {
        if ($this->isGranted("ROLE_INSTRUCTEUR")) {
            $ateliers = $atelierRepository->findBy(array('instructeur' => $this->getUser()));

            return $this->render("/profile/instructor.html.twig", [
                'ateliers' => $ateliers,
                'instructeur' => $this->getUser(),
            ]);
        }
        elseif ($this->isGranted("ROLE_APPRENTI")) {
            $ateliers = $atelierRepository->findByApprenti($this->getUser());

            return $this->render('/profile/apprenti.html.twig', [
               'ateliers' => $ateliers,
               'apprenti' => $this->getUser(),
            ]);
        }
        else {
            return $this->redirectToRoute('app_atelier_index', []);
        }
    }
}

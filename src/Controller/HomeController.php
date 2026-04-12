<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/informations', name: 'app_informations')]
    public function informations(): Response
    {
        return $this->render('pages/informations.html.twig');
    }

    #[Route('/foire-aux-questions', name: 'app_faq')]
    public function faq(): Response
    {
        return $this->render('pages/faq.html.twig');
    }

    #[Route('/nous-contacter', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('pages/contact.html.twig');
    }

    #[Route('/liste-mariage', name: 'app_liste_mariage')]
    public function listeMariage(): Response
    {
        return $this->render('pages/liste_mariage.html.twig');
    }
}

<?php

declare(strict_types=1);

namespace App\Controller;

use DateTimeImmutable;
use DateTimeZone;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(): Response
    {
        $wedding = (new DateTimeImmutable('2028-09-09', new DateTimeZone('Europe/Paris')))->setTime(0, 0, 0);
        $now = new DateTimeImmutable('now', new DateTimeZone('Europe/Paris'));
        $diffSeconds = $wedding->getTimestamp() - $now->getTimestamp();
        $ended = $diffSeconds <= 0;

        $countdown = [
            'ended' => $ended,
            'endIso' => $wedding->format('c'),
            'days' => $ended ? 0 : intdiv($diffSeconds, 86400),
            'hours' => $ended ? '00' : sprintf('%02d', intdiv($diffSeconds % 86400, 3600)),
            'minutes' => $ended ? '00' : sprintf('%02d', intdiv($diffSeconds % 3600, 60)),
            'seconds' => $ended ? '00' : sprintf('%02d', $diffSeconds % 60),
        ];

        return $this->render('home/index.html.twig', [
            'countdown' => $countdown,
        ]);
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

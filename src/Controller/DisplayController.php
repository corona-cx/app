<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DisplayController extends AbstractController
{
    #[Route('/coords', name: 'display_coords', options: ['expose' => true])]
    public function displayCoords(): Response
    {
        return $this->render('frontpage/index.html.twig');
    }

    #[Route('/{slug}', name: 'display_city', options: ['expose' => true])]
    public function displayCity(): Response
    {
        return $this->render('frontpage/index.html.twig');
    }
}

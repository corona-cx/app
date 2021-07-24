<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DisplayController extends AbstractController
{
    #[Route('/coords', name: 'display_coords', options: ['expose' => true])]
    public function displayCoords(Request $request): Response
    {
        $latitude = (float) $request->query->get('latitude');
        $longitude = (float) $request->query->get('longitude');

        $apiUrl = sprintf('https://localhost:8000/?latitude=%f&longitude=%f', $latitude, $longitude);

        $content = file_get_contents($apiUrl);

        $jsonContent = json_decode($content);

        $areaName = $jsonContent->area->name;
        $dateTime = new \DateTime($jsonContent->date_time);
        $incidence = $jsonContent->cases7_per100k;

        return $this->render('display/coord.html.twig', [
            'area_name' => $areaName,
            'date_time' => $dateTime,
            'incidence' => $incidence,
        ]);
    }

    #[Route('/{slug}', name: 'display_city', options: ['expose' => true])]
    public function displayCity(): Response
    {
        return $this->render('frontpage/index.html.twig');
    }
}

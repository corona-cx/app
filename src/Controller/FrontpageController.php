<?php declare(strict_types=1);

namespace App\Controller;

use Geocoder\Model\AddressCollection;
use Geocoder\Provider\Provider;
use Geocoder\Query\GeocodeQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontpageController extends AbstractController
{
    #[Route('/', name: 'frontpage', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('frontpage/index.html.twig');
    }

    #[Route('/', name: 'query', methods: ['POST'])]
    public function query(Request $request, Provider $nominatimGeocoder): Response
    {
        $query = $request->request->get('query');

        $geocodeQuery = GeocodeQuery::create(sprintf('%s, Germany', $query));

        /** @var AddressCollection $result */
        $result = $nominatimGeocoder->geocodeQuery($geocodeQuery);

        $bestMatch = $result->first();

        if (!$bestMatch) {
            return $this->redirectToRoute('frontpage');
        }

        $latitude = $bestMatch->getCoordinates()->getLatitude();
        $longitude = $bestMatch->getCoordinates()->getLongitude();

        return $this->redirectToRoute('display_coords', [
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);
    }
}

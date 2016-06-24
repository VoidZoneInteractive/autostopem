<?php

namespace LocationBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use LocationBundle\Entity\City;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * City controller.
 *
 */
class CityController extends Controller
{
    /**
     * Returns list of cities for autocomplete action.
     * @param $term
     * @param Request $request
     * @return JsonResponse
     */
    public function autocompleteAction($term, Request $request)
    {
        $locale = $request->getLocale();
        $em = $this->getDoctrine()->getManager();

        $response = array(
            'status' => Response::HTTP_OK,
            'content' => null,
        );

        $cities = $em->getRepository('LocationBundle:City')->findCitiesByNameForAutocomplete($term, $locale);

        // No cities were found
        if (!count($cities)) {
            $translator = $this->get('translator');
            $response['status'] = Response::HTTP_NOT_FOUND;
            $response['content'] = array($translator->trans('trip.travel.message.not_found', array('%term%' => $term)));
        } else {
            $response['content'] = $cities;
        }

        return new JsonResponse($response);
    }

    /**
     * Finds and displays a City entity.
     *
     */
    public function showAction(City $city)
    {

        return $this->render('city/show.html.twig', array(
            'city' => $city,
        ));
    }
}

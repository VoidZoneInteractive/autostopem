<?php

namespace AdminBundle\Controller;

use LocationBundle\Entity\City;
use LocationBundle\Form\CityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CityController extends Controller
{
    public function newAction(Request $request)
    {
        $city = new City();
//        $em = $this->getDoctrine()->getManager();
//        $repository = $em->getRepository('LocationBundle:City');
//        $city = $repository->find(2);

        $form = $this->createForm(CityType::class, $city, [
            'action' => $this->generateUrl('admin_city_create'),
        ]);

        return $this->render('AdminBundle:City:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function createAction(Request $request)
    {
        $city = new City();

        $form = $this->createForm(CityType::class, $city, [
            'action' => $this->generateUrl('admin_city_create'),
        ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($city);
            $em->flush();
        }

        return $this->render('AdminBundle:City:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }



    public function insertAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('LocationBundle:City');

        $city = $repository->findOneBy(array(
            'name' => 'Poznań',
        ));

        $city->setName('Posen');
        $city->setTranslatableLocale('pl'); // change locale

        $em->persist($city);

        $em->flush();

        dump($city);

        exit();
    }
}

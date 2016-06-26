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
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('LocationBundle:City');
        $city = $repository->find(2);
//        $city->setName('Posen');
//
//        $city->setTranslatableLocale('de'); // change locale
//
//        $em->persist($city);
//        $em->flush();
//        exit();


        $form = $this->createForm(CityType::class, $city)->createView();

        return $this->render('AdminBundle:City:new.html.twig', array(
            'form' => $form,
        ));
    }

    public function createAction()
    {
        return $this->render('AdminBundle:City:create.html.twig', array(
            // ...
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

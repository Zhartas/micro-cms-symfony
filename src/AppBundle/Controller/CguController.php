<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CguController extends Controller
{

    public function mentionsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $admin = $em->getRepository('AppBundle:Admin')->findOneBy(array(), array('id' => 'DESC'));
        $site = $em->getRepository('AppBundle:Site')->findOneBy(array(), array('id' => 'DESC'));
        $mention = $em->getRepository('AppBundle:Mention')->findOneBy(array(), array('id' => 'DESC'));
        $locales = $em->getRepository('AppBundle:Locale')->findByStatus();
        $services = $em->getRepository('AppBundle:Services')->findAll();
        $params = [
            "admin" => $admin,
            "site" => $site,
            "mention" => $mention,
            'locales' => $locales,
            'services' => $services
        ];
        return $this->render('@views/front/cgu/mentions.html.twig', $params);
    }


    public function cookiesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $admin = $em->getRepository('AppBundle:Admin')->findOneBy(array(), array('id' => 'DESC'));
        $site = $em->getRepository('AppBundle:Site')->findOneBy(array(), array('id' => 'DESC'));
        $locales = $em->getRepository('AppBundle:Locale')->findByStatus();
        $services = $em->getRepository('AppBundle:Services')->findAll();
        $params = [
            "admin" => $admin,
            "site" => $site,
            'locales' => $locales,
            'services' => $services
        ];
        return $this->render('@views/front/cgu/cookies.html.twig', $params);
    }
}
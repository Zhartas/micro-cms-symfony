<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ServicesController extends Controller
{
    public function indexAction($urlServices = null)
    {
        $em = $this->getDoctrine()->getManager();
        if (!$this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN') and !$this->container->get('security.authorization_checker')->isGranted('ROLE_MASTER')) {
            $admin = $em->getRepository('AppBundle:Admin')->find(1);
            if(empty($admin) || $admin->isConstructor()) {
                $site = $em->getRepository('AppBundle:Site')->find(1);
                return $this->render('@views/front/constructor/index.html.twig', ['site' => $site]);
            };
        }

        $services = $em->getRepository('AppBundle:Services')->findAll();
        $service = $em->getRepository('AppBundle:Services')->findOneBy(array('url' => $urlServices));
        $images = $em->getRepository('AppBundle:Image')->findAllByPosition();
        $admin = $em->getRepository('AppBundle:Admin')->findOneBy(array(), array('id' => 'DESC'));
        $site = $em->getRepository('AppBundle:Site')->findOneBy(array(), array('id' => 'DESC'));
        $locales = $em->getRepository('AppBundle:Locale')->findByStatus();

        if (empty($service))
            return $this->redirectToRoute('home');

        $params = [
            'currentPage' => 'services',
            'locales' => $locales,
            'services' => $services,
            'site' => $site,
            'images' => $images,
            'service' => $service,
            'admin' => $admin
        ];
        return $this->render('@views/front/services/index.html.twig', $params);
    }
}
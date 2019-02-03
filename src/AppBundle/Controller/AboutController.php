<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class AboutController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if (!$this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN') and !$this->container->get('security.authorization_checker')->isGranted('ROLE_MASTER')) {
            $admin = $em->getRepository('AppBundle:Admin')->find(1);
            if(empty($admin) || $admin->isConstructor()) {
                $site = $em->getRepository('AppBundle:Site')->find(1);
                return $this->render('@views/front/constructor/index.html.twig', ['site' => $site]);
            };
        }
        $locales = $em->getRepository('AppBundle:Locale')->findByStatus();
        $timelines = $em->getRepository('AppBundle:Timeline')->findByDate();
        $resumes = $em->getRepository('AppBundle:Resume')->findAll();
        $social = $em->getRepository('AppBundle:Social')->findOneBy(array(), array('id' => 'DESC'));
        $admin = $em->getRepository('AppBundle:Admin')->findOneBy(array(), array('id' => 'DESC'));
        $site = $em->getRepository('AppBundle:Site')->findOneBy(array(), array('id' => 'DESC'));
        $services = $em->getRepository('AppBundle:Services')->findAll();
        $vps = $em->getRepository('AppBundle:Vp')->findAll();
        $images = $em->getRepository('AppBundle:Image')->findAllByPosition();

        $params = [
            'currentPage' => 'about',
            'vps' => $vps,
            'locales' => $locales,
            'resumes' => $resumes,
            'social' => $social,
            'admin' => $admin,
            'site' => $site,
            'images' => $images,
            'services' => $services,
            'timelines' => $timelines
        ];
        return $this->render('@views/front/about/index.html.twig', $params);
    }
}
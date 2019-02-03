<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Timeline;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BackTimelineController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $timelines = $em->getRepository('AppBundle:Timeline')->findByDate();
        $parameters = array(
            'current' => 'timeline',
            'timelines' => $timelines,
        );
        return $this->render('@views/back/timeline/index.html.twig', $parameters);
    }

    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        if($id !== '0')
            $timeline = $em->getRepository('AppBundle:Timeline')->find($id);
        else
            $timeline = new Timeline();


        $form = $this->createForm(\AppBundle\Form\TimelineType::class, $timeline);
        if ($form->handleRequest($request)->isValid()) {
            $em->persist($timeline);
            $em->flush();
            return $this->redirectToRoute('admin_timeline');
        };
        $parameters = array(
            'current' => 'timeline',
            'form' => $form->createView()
        );
        return $this->render('@views/back/timeline/edit.html.twig', $parameters);
    }

    public function removeAction($id) {
        $em = $this->getDoctrine()->getManager();
        $timeline = $em->getRepository('AppBundle:Timeline')->find($id);
        $em->remove($timeline);
        $em->flush();
        return $this->redirectToRoute('admin_timeline');
    }
}
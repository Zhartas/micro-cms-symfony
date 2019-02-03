<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Card;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BackCardController extends Controller
{
    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $card = new Card();
        $form = $this->createForm(\AppBundle\Form\CardType::class, $card);
        $cards = $em->getRepository('AppBundle:Card')->findAll();

        if ($form->handleRequest($request)->isValid()) {
            $em->persist($card);
            $em->flush();
            return $this->redirectToRoute('admin_card');
        };
        $parameters = array(
            'current' => 'card',
            'cards' => $cards,
            'form' => $form->createView()
        );
        return $this->render('@views/back/card/index.html.twig', $parameters);
    }

    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        if($id !== '0')
            $card = $em->getRepository('AppBundle:Card')->find($id);
        else
            $card = new Card();


        $form = $this->createForm(\AppBundle\Form\CardType::class, $card);
        if ($form->handleRequest($request)->isValid()) {
            $em->persist($card);
            $em->flush();
            return $this->redirectToRoute('admin_card');
        };
        $parameters = array(
            'current' => 'card',
            'form' => $form->createView()
        );
        return $this->render('@views/back/card/edit.html.twig', $parameters);
    }



    public function removeAction($id) {
        $em = $this->getDoctrine()->getManager();
        $card = $em->getRepository('AppBundle:Card')->find($id);
        $em->remove($card);
        $em->flush();
        return $this->redirectToRoute('admin_card');
    }
}
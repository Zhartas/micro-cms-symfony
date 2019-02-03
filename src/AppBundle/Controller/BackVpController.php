<?php
/**
 * Created by PhpStorm.
 * User: Anthony
 * Date: 08/11/2018
 * Time: 19:09
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Vp;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BackVpController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $vps = $em->getRepository('AppBundle:Vp')->findAll();
        $parameters = array(
            'current' => 'vp',
            'vps' => $vps,
        );

        return $this->render('@views/back/vp/index.html.twig', $parameters);
    }

    public function editAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        if($id !== '0')
            $vp = $em->getRepository('AppBundle:Vp')->find($id);
        else
            $vp = new Vp();


        $form = $this->createForm(\AppBundle\Form\VpType::class, $vp);

        if ($form->handleRequest($request)->isValid()) {
            $em->persist($vp);
            $em->flush();
            return $this->redirectToRoute('admin_vp');
        };
        $parameters = array(
            'current' => 'vp',
            'form' => $form->createView()
        );
        return $this->render('@views/back/vp/edit.html.twig', $parameters);
    }


    public function removeAction($id) {
        $em = $this->getDoctrine()->getManager();
        $vp = $em->getRepository('AppBundle:Vp')->find($id);
        $em->remove($vp);
        $em->flush();
        return $this->redirectToRoute('admin_vp');
    }

}
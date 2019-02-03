<?php
/**
 * Created by PhpStorm.
 * User: mbm
 * Date: 17/10/2018
 * Time: 14:34
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Resume;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BackResumeController extends Controller
{
    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $resumes = $em->getRepository('AppBundle:Resume')->findAll();
        $parameters = array(
            'resumes' => $resumes,
            'current' => 'resume',
        );
        return $this->render('@views/back/resume/index.html.twig', $parameters);
    }

    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $resumes = $em->getRepository('AppBundle:Resume')->findAll();

        if ($id !== '0')
            $resume = $em->getRepository('AppBundle:Resume')->find($id);
        else
            $resume = new Resume();


        $form = $this->createForm(\AppBundle\Form\ResumeType::class, $resume);
        if ($form->handleRequest($request)->isValid()) {
            $em->persist($resume);
            $em->flush();
            return $this->redirectToRoute('admin_resume');
        };
        $parameters = array(
            'resumes' => $resumes,
            'current' => 'resume',
            'form' => $form->createView()
        );
        return $this->render('@views/back/resume/edit.html.twig', $parameters);
    }


    public function removeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $resume = $em->getRepository('AppBundle:Resume')->find($id);
        $em->remove($resume);
        $em->flush();
        return $this->redirectToRoute('admin_resume');
    }

}
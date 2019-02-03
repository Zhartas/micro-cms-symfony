<?php


namespace AppBundle\Controller;


use AppBundle\Entity\Mentions;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BackMentionsController extends Controller
{
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $mention = $em->getRepository('AppBundle:Mentions')->findOneBy(array(), array('id' => 'DESC'));
        if(empty($mention))
            $mention = new Mentions();

        $form = $this->createForm(\AppBundle\Form\MentionsType::class, $mention);

        if ($form->handleRequest($request)->isValid()) {
            $em->persist($mention);
            $em->flush();
            return $this->redirectToRoute('admin_mentions');
        }
        $parameters = array(
            'current' => 'mentions',
            'form' => $form->createView(),
            'mention' => $mention
        );
        return $this->render('@views/back/mentions/index.html.twig', $parameters);
    }
}
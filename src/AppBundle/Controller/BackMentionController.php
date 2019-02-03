<?php


namespace AppBundle\Controller;


use AppBundle\Entity\Mention;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BackMentionController extends Controller
{
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $mention = $em->getRepository('AppBundle:Mention')->findOneBy(array(), array('id' => 'DESC'));
        if(empty($mention))
            $mention = new Mention();

        $form = $this->createForm(\AppBundle\Form\MentionType::class, $mention);

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
        return $this->render('@views/back/mention/index.html.twig', $parameters);
    }
}
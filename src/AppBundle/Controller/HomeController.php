<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use \Datetime;

class HomeController extends Controller
{

    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        if (!$this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN') and !$this->container->get('security.authorization_checker')->isGranted('ROLE_MASTER')) {
            $admin = $em->getRepository('AppBundle:Admin')->find(1);
            if (empty($admin) || $admin->isConstructor()) {
                $site = $em->getRepository('AppBundle:Site')->find(1);
                return $this->render('@views/front/constructor/index.html.twig', ['site' => $site]);
            };
        }


        $message = new Message();
        $form = $this->createForm(\AppBundle\Form\MessageType::class, $message);
        $locales = $em->getRepository('AppBundle:Locale')->findByStatus();
        $social = $em->getRepository('AppBundle:Social')->findOneBy(array(), array('id' => 'DESC'));
        $admin = $em->getRepository('AppBundle:Admin')->findOneBy(array(), array('id' => 'DESC'));
        $site = $em->getRepository('AppBundle:Site')->findOneBy(array(), array('id' => 'DESC'));
        $cards = $em->getRepository('AppBundle:Card')->findAll();
        $images = $em->getRepository('AppBundle:Image')->findAllByPosition();
        $services = $em->getRepository('AppBundle:Services')->findAll();
        $params = [
            'currentPage' => 'home',
            'locales' => $locales,
            'social' => $social,
            'cards' => $cards,
            'site' => $site,
            'admin' => $admin,
            'images' => $images,
            'services' => $services,
            'form' => $form->createView()
        ];

        if ($form->handleRequest($request)->isValid()) {
            if (!$this->captchaverify($request)) {
                $params['errorCaptcha'] = true;
                return $this->render('@views/front/home/index.html.twig', $params);
            }

            $currentDate = new DateTime();
            $last_send = $em->getRepository('AppBundle:Message')->findBy(array('email' => $message->getEmail()));
            if (!empty($last_send)) {
                foreach ($last_send as $last) {
                    if (($last->getSubmittedAt()->getTimestamp() + 120) > $currentDate->getTimestamp()) {
                        $params['lastMsg'] = true;
                        return $this->render('@views/front/home/index.html.twig', $params);
                    }
                }
            }

            $em->persist($message);
            $em->flush();
            if (!empty($this->getParameter('mailer_user')) && $admin->getEmail()) {
                $message = \Swift_Message::newInstance()
                    ->setSubject("Vous avez reçu un nouveau message depuis votre site !")
                    ->setFrom(array((String)$this->getParameter('mailer_user') => 'TALENTID Administration'))
                    ->setTo($admin->getEmail())
                    ->setBody(
                        $this->renderView(
                            '@views/email/contact.html.twig', array('message' => $message))
                        , 'text/html'
                    );
                //$this->get('mailer')->send($message);
                $params['sendMsg'] = true;
            }
            return $this->render('@views/front/home/index.html.twig', $params);
        }

        return $this->render('@views/front/home/index.html.twig', $params);
    }

    public function captchaverify($request)
    {
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $secret_key = "6Lf2x44UAAAAAONCjV5iTLmvrYr9qx2JrEkTk4Ev";
        $g_recaptcha_response = $request->get('g-recaptcha-response');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $kernel = $this->get('kernel');
        if ($kernel->getEnvironment() === 'dev')
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array("secret" => $secret_key, "response" => $g_recaptcha_response));
        $response = curl_exec($ch);
        $data = json_decode($response);
        curl_close($ch);
        return $data->success;
    }


}
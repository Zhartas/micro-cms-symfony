<?php


namespace AppBundle\Controller;


use AppBundle\Entity\Services;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Classe\ConvertUrl;
use Doctrine\Common\Collections\ArrayCollection;

class BackServicesController extends Controller
{
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $services = $em->getRepository('AppBundle:Services')->findAll();

        $parameters = array(
            'current' => 'services',
            'services' => $services
        );
        return $this->render('@views/back/services/index.html.twig', $parameters);
    }

    public function editAction(Request $request, $url = null) {
        $em = $this->getDoctrine()->getManager();
        if ($url === 'new') {
            $service = new Services();
        } else {
            $service = $em->getRepository('AppBundle:Services')->findOneBy(array('url' => $url));
            $originalBenefits = new ArrayCollection();
            foreach ($service->getBenefits() as $benefit) {
                $originalBenefits->add($benefit);
            }
        }

        $form = $this->createForm(\AppBundle\Form\ServicesType::class, $service);

        if ($form->handleRequest($request)->isValid()) {
            $service->setUrl(ConvertUrl::convert($service->getUrl()));
            if($url !== 'new') {
                foreach ($originalBenefits as $benefit) {
                    if (false === $service->getBenefits()->contains($benefit)) {
                        $em->remove($benefit);
                    }
                }

            }
            $em->persist($service);
            $em->flush();
            return $this->redirectToRoute('admin_services');
        }


        $parameters = array(
            'current' => 'services',
            'form' => $form->createView()
        );
        return $this->render('@views/back/services/edit.html.twig', $parameters);
    }

    public function removeAction(Request $request, $id = null) {
        $em = $this->getDoctrine()->getManager();
        $service = $em->getRepository('AppBundle:Services')->find($id);
        $originalBenefits = new ArrayCollection();
        foreach ($service->getBenefits() as $benefit) {
            $originalBenefits->add($benefit);
        }

        foreach ($originalBenefits as $benefit) {

            if (true === $service->getBenefits()->contains($benefit)) {
                $em->remove($benefit);
            }
        }

        $em->remove($service);
        $em->flush();
        return $this->redirectToRoute('admin_services');
    }

}
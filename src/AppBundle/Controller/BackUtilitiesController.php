<?php

namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;



class BackUtilitiesController extends Controller {

    public function cacheAction(KernelInterface $kernel) {
        $application = new Application($this->get('kernel'));
        $application->setAutoExit(false);
        $input = new ArrayInput([
            'command' => 'cache:clear'
        ]);
        $output = new BufferedOutput();
        $runCode = $application->run($input, $output);
        return $this->redirect($this->generateUrl('administration'));
    }

    public function updateBDDAction(KernelInterface $kernel) {
        $application = new Application($this->get('kernel'));
        $application->setAutoExit(false);
        $input = new ArrayInput([
            'command' => 'doctrine:schema:update',
            '--force'   => true
        ]);
        $output = new BufferedOutput();
        $runCode = $application->run($input, $output);
        return $this->redirect($this->generateUrl('administration'));
    }
}
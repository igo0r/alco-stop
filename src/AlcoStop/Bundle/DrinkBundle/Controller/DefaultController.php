<?php

namespace AlcoStop\Bundle\DrinkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('DrinkBundle:Default:index.html.twig', array('name' => $name));
    }
}

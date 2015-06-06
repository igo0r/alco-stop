<?php

namespace AlcoStop\Bundle\PartyTimeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PartyTimeBundle:Default:index.html.twig', array('name' => $name));
    }
}

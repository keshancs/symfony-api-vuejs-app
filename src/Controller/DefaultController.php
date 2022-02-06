<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DefaultController
 */
class DefaultController extends AbstractController
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('base.html.twig');
    }
}
<?php

namespace App\Controller;

use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    private CarRepository $carRepository;

    public function __construct(CarRepository $carRepository)
    {

        $this->carRepository = $carRepository;
    }

    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        $cars = $this->carRepository->findAll();


        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'cars' => $cars,
        ]);
    }

    /**
     * @Route("/{id}", name="detail")
     */
    public function detail()
    {
        return $this->render('default/detail.html.twig', [
        ]);
    }
}

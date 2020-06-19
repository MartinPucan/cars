<?php

namespace App\Controller;

use App\Repository\BrandRepository;
use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    private CarRepository $carRepository;
    private BrandRepository $brandRepository;

    public function __construct(CarRepository $carRepository, BrandRepository $brandRepository)
    {

        $this->carRepository = $carRepository;
        $this->brandRepository = $brandRepository;
    }

    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        $cars = $this->carRepository->findAll();
        $brands = $this->brandRepository->findAll();

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'cars' => $cars,
            'brands' => $brands,
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

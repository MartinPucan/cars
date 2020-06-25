<?php

namespace App\Controller;

use App\Entity\Car;
use App\Repository\BrandRepository;
use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    private CarRepository $carRepository;
    private BrandRepository $brandRepository;

    public function __construct(
        CarRepository $carRepository,
        BrandRepository $brandRepository
    ) {
        $this->carRepository = $carRepository;
        $this->brandRepository = $brandRepository;
    }

    /**
     * @Route("/default", name="default")
     */
    public function index()
    {
        $cars = $this->carRepository->findAll();
        $brands = $this->brandRepository->findAll();

        return $this->render('default/index.html.twig', [
            'cars' => $cars,
            'brands' => $brands,
        ]);
    }

    /**
     * @Route("/default/{id}", name="detail")
     * @param Car $car
     * @return Response
     */
    public function detail(?Car $car)
    {
        if ($car === null) {
            throw new NotFoundHttpException;
        }

        return $this->render('default/detail.html.twig', [
        ]);
    }

    /**
     * @Route("/{id}", name="car_delete", methods={"DELETE"})
     * @param Request $request
     * @param Car $car
     * @return Response
     */
    public function delete(Request $request, Car $car): Response
    {
        if ($this->isCsrfTokenValid('delete'.$car->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($car);
            $entityManager->flush();
        }

        return $this->redirectToRoute('default');
    }

//    public function getMaxPrice()
//    {
//        $allPrices = $this->carEntity->getPrice();
//
//        return max($allPrices);
//    }
//
//    public function getMinPrice()
//    {
//        $allPrices = $this->carEntity->getPrice();
//
//        return min($allPrices);
//    }
}

<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\SearchFormType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
  public function __construct(
    private ProductRepository $productRepository,
    private RequestStack $requestStack
  ) {
  }

  #[Route('/', name: 'index')]
  public function index()
  {
    return $this->render('search/index.html.twig');
  }

  #[Route('/search', name: 'search')]
  public function search()
  {
    $type = SearchFormType::class;
    $model = new Product();
    $form = $this->createForm($type, $model);
    $form->handleRequest($this->requestStack->getCurrentRequest());
    return $this->render('search/search.html.twig', [
      'products' =>
      $this->productRepository->findAll(), 'form' => $form->createView(),
      'query' => $this->productRepository->search($form["price"]->getData())->getResult()
    ]);
  }
}

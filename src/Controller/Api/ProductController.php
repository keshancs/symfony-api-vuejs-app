<?php

namespace App\Controller\Api;

use App\Entity\Product;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProductController
 */
#[Route(path: '/api', name: 'api_')]
class ProductController extends ApiController
{
    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    #[Route(path: '/products', name: 'products')]
    public function collection(Request $request): JsonResponse
    {
        $products = $this->getRepository(Product::class)->findAll();

        return $this->response($request, $products);
    }

    /**
     * @param Request $request
     * @param int     $id
     *
     * @return JsonResponse
     */
    #[Route(path: '/products/{id}', name: 'product', requirements: ['id' => '\d+'])]
    public function item(Request $request, int $id): JsonResponse
    {
        $product = $this->getRepository(Product::class)->find($id);

        return $this->response($request, $product);
    }

    /**
     * @param Request $request
     * @param string  $slug
     *
     * @return JsonResponse
     */
    #[Route(path: '/products/{slug}', name: 'product_by_slug', requirements: ['slug' => '[\w-]+'])]
    public function itemBySlug(Request $request, string $slug): JsonResponse
    {
        $product = $this->getRepository(Product::class)->findOneBy(['slug' => $slug]);

        return $this->response($request, $product);
    }
}
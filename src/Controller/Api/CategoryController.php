<?php

namespace App\Controller\Api;

use App\Entity\Category;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CategoryController
 */
#[Route(path: '/api', name: 'api_')]
class CategoryController extends ApiController
{
    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    #[Route(path: '/categories', name: 'categories')]
    public function collection(Request $request): JsonResponse
    {
        $qb = $this->getRepository(Category::class)->createQueryBuilder('o');

        if ('' === $request->query->get('parent')) {
            $qb->andWhere($qb->expr()->isNull('o.parent'));
        }

        $categories = $qb->getQuery()->getResult();

        return $this->response($request, $categories);
    }

    /**
     * @param Request $request
     * @param int     $id
     *
     * @return JsonResponse
     */
    #[Route(path: '/categories/{id}', name: 'category', requirements: ['id' => '\d+'])]
    public function item(Request $request, int $id): JsonResponse
    {
        $category = $this->getRepository(Category::class)->find($id);

        return $this->response($request, $category);
    }

    /**
     * @param Request $request
     * @param string  $slug
     *
     * @return JsonResponse
     */
    #[Route(path: '/categories/{slug}', name: 'category_by_slug', requirements: ['slug' => '[\w-]+'])]
    public function itemBySlug(Request $request, string $slug): JsonResponse
    {
        $category = $this->getRepository(Category::class)->findOneBy(['slug' => $slug]);

        return $this->response($request, $category);
    }
}
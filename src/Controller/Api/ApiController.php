<?php

namespace App\Controller\Api;

use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class ApiController
 */
class ApiController extends AbstractController
{
    /**
     * @var ManagerRegistry
     */
    private ManagerRegistry $managerRegistry;

    /**
     * @var SerializerInterface
     */
    private SerializerInterface $serializer;

    /**
     * @param ManagerRegistry $managerRegistry
     * @param SerializerInterface $serializer
     */
    public function __construct(ManagerRegistry $managerRegistry, SerializerInterface $serializer)
    {
        $this->managerRegistry = $managerRegistry;
        $this->serializer      = $serializer;
    }

    /**
     * @param string $resourceClass
     *
     * @return ObjectRepository
     */
    protected function getRepository(string $resourceClass): ObjectRepository
    {
        return $this->managerRegistry->getRepository($resourceClass);
    }

    /**
     * @param Request $request
     * @param mixed   $data
     * @param array   $groups
     *
     * @return JsonResponse
     */
    protected function response(Request $request, mixed $data, array $groups = []): JsonResponse
    {
        $json = $this->serializer->serialize($data, 'json', [
            'groups' => $groups ?: (array)$request->get('groups', ['default']),
        ]);

        return new JsonResponse($json, 200, [], true);
    }
}
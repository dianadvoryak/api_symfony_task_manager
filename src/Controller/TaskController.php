<?php

namespace App\Controller;

use App\Attribute\RequestBody;
use App\Model\ErrorResponse;
use App\Model\TaskDetails;
use App\Model\TaskListResponse;
use App\Model\TaskUpdateRequest;
use App\Service\TaskService;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    public function __construct(private readonly TaskService $taskService)
    {
    }

    #[Route(path: '/api/v1/tasks', methods: ['GET'])]
    #[OA\Tag(name: 'Task API')]
    #[OA\Response(response: 200, description: 'Returns tasks', attachables: [new Model(type: TaskListResponse::class)])]
    public function categories(): Response
    {
        return $this->json($this->taskService->getTasks());
    }

    #[Route(path: '/api/v1/tasks/create', methods: ['POST'])]
    #[OA\Tag(name: 'Task API')]
    #[OA\Response(response: 200, description: 'Create a new task')]
    #[OA\Response(response: 400, description: 'Validation failed', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\RequestBody(attachables: [new Model(type: TaskUpdateRequest::class)])]
    public function createTask(#[RequestBody] TaskUpdateRequest $request): Response
    {
        return $this->json($this->taskService->createTask($request));
    }

    #[Route(path: '/api/v1/task/{id}', methods: ['GET'])]
    #[OA\Tag(name: 'Task API')]
    #[OA\Response(response: 200, description: 'Returns task detail information', attachables: [new Model(type: TaskDetails::class)])]
    #[OA\Response(response: 404, description: 'task not found', attachables: [new Model(type: ErrorResponse::class)])]
    public function taskById(int $id): Response
    {
        return $this->json($this->taskService->getTaskById($id));
    }

    #[Route(path: '/api/v1/task/{id}', methods: ['POST'])]
    #[OA\Tag(name: 'Task API')]
    #[OA\Response(response: 200, description: 'Update a task')]
    #[OA\Response(response: 400, description: 'Validation failed', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\RequestBody(attachables: [new Model(type: TaskUpdateRequest::class)])]
    public function updateTask(int $id, #[RequestBody] TaskUpdateRequest $request): Response
    {
        $this->taskService->updateTask($id, $request);

        return $this->json(null);
    }

    #[Route(path: '/api/v1/task/{id}/execute', methods: ['POST'])]
    #[OA\Tag(name: 'Task API')]
    #[OA\Response(response: 200, description: 'Execute a task')]
    #[OA\Response(response: 400, description: 'Validation failed', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\RequestBody(attachables: [new Model(type: TaskUpdateRequest::class)])]
    public function executedTask(int $id): Response
    {
        $this->taskService->executedTask($id);

        return $this->json(null);
    }

    #[Route(path: '/api/v1/task/{id}', methods: ['DELETE'])]
    #[OA\Tag(name: 'Task API')]
    #[OA\Response(response: 200, description: 'Delete a task category')]
    #[OA\Response(response: 404, description: 'Task not found', attachables: [new Model(type: ErrorResponse::class)])]
    public function deleteTask(int $id): Response
    {
        $this->taskService->deleteTask($id);

        return $this->json(null);
    }
}
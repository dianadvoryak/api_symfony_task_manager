<?php

namespace App\Service;

use App\Entity\Task;
use App\Model\IdResponse;
use App\Model\TaskDetails;
use App\Model\TaskListResponse;
use App\Model\TaskModel;
use App\Model\TaskUpdateRequest;
use App\Repository\RepositoryModifyTrait;
use App\Repository\TaskRepository;
use DateTimeImmutable;

class TaskService
{
    public function __construct(
        private readonly TaskRepository $taskRepository)
    {
    }

    public function getTasks(): TaskListResponse
    {
        $tasks = $this->taskRepository->findAll();
        $items = array_map(
            fn (Task $task) => new TaskModel(
                $task->getId(),
                $task->getTitle(),
                $task->getDescription(),
                $task->getCreatedAt(),
                $task->getDateComplete(),
                $task->isStatus()
            ),
            $tasks
        );

        return new TaskListResponse($items);
    }

    public function createTask(TaskUpdateRequest $updateRequest): IdResponse
    {
        $task = new Task();

        $task->setTitle($updateRequest->getTitle())
            ->setDescription($updateRequest->getDescription())
            ->setCreatedAt((new DateTimeImmutable()));

        $this->taskRepository->saveAndCommit($task);

        return new IdResponse($task->getId());
    }

    public function getTaskById(int $id): TaskDetails
    {
        $task = $this->taskRepository->getTaskById($id);

        return (new TaskDetails())
            ->setTitle($task->getTitle())
            ->setDescription($task->getDescription())
            ->setCreatedAt($task->getCreatedAt())
            ->setDateComplete($task->getDateComplete())
            ->setStatus($task->isStatus());
    }

    public function updateTask(int $id, TaskUpdateRequest $updateRequest): void
    {
        $task = $this->taskRepository->getTaskById($id);

        $task->setTitle($updateRequest->getTitle())->setDescription($updateRequest->getDescription());

        $this->taskRepository->saveAndCommit($task);
    }

    public function deleteTask(int $id): void
    {
        $book = $this->taskRepository->getTaskById($id);

        $this->taskRepository->removeAndCommit($book);
    }

    public function executedTask(int $id): void
    {
        $task = $this->taskRepository->getTaskById($id);

        $task->setStatus(true)->setDateComplete((new DateTimeImmutable()));

        $this->taskRepository->saveAndCommit($task);
    }
}
<?php

namespace App\Model;

class TaskListResponse
{
    /**
     * @param TaskModel[] $items
     */
    public function __construct(private readonly array $items)
    {
    }

    /**
     * @return TaskModel[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
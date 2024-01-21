<?php

namespace App\Model;

use DateTimeImmutable;

class TaskModel
{
    public function __construct(
        private readonly int $id,
        private readonly ?string $title,
        private readonly ?string $description,
        private readonly ?DateTimeImmutable $createdAt,
        private readonly ?DateTimeImmutable $dateComplete,
        private readonly ?bool $status)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getDateComplete(): ?DateTimeImmutable
    {
        return $this->dateComplete;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

}
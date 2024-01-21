<?php

namespace App\Model;

class TaskDetails
{
    private ?int $id = null;

    private ?string $title = null;

    private ?string $description = null;

    private ?\DateTimeImmutable $createdAt = null;

    private ?\DateTimeImmutable $dateComplete = null;

    private ?bool $status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getDateComplete(): ?\DateTimeImmutable
    {
        return $this->dateComplete;
    }

    public function setDateComplete(?\DateTimeImmutable $dateComplete): static
    {
        $this->dateComplete = $dateComplete;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): static
    {
        $this->status = $status;

        return $this;
    }
}
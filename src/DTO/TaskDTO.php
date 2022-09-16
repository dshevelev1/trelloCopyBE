<?php

declare(strict_types=1);

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class TaskDTO
{
    #[Assert\NotBlank(message: "Task name is required")]
    private string $name;

    #[Assert\NotBlank(message: "Column id is required")]
    private int $statusId;

    #[Assert\NotBlank(message: "Task description is required")]
    private string $description;

    /**
     * @param string $name
     * @param int $statusId
     * @param string $description
     */
    public function __construct(string $name, int $statusId, string $description)
    {
        $this->name = $name;
        $this->statusId = $statusId;
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getStatusId(): int
    {
        return $this->statusId;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}

<?php

declare(strict_types=1);

namespace App\Entities\Concerns;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

trait EntityIdTrait
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     *
     * @ORM\id
     * @ORM\Column(name="id", type="uuid", nullable=false, unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="\Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    public function getId(): UuidInterface
    {
        return $this->id;
    }
}

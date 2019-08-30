<?php

declare(strict_types=1);

namespace App\Entities;

use App\Entities\Concerns\EntityIdTrait;
use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Past
{

    use EntityIdTrait;

    /**
     * @var string
     * @ORM\Column(name="encrypted", type="string", nullable=false)
     */
    private $encrypted;

    /**
     * @var \Carbon\Carbon
     * @ORM\Column(name="created_at", type="carbondatetime", nullable=false, options={"default": "CURRENT_TIMESTAMP"})
     */
    private $created_at;

    /**
     * @var \Carbon\Carbon
     * @ORM\Column(name="expire_at", type="carbondatetime", nullable=false)
     */
    private $expire_at;

    /**
     * @return string
     */
    public function getEncrypted(): string
    {
        return $this->encrypted;
    }

    /**
     * @param string $encrypted
     *
     * @return Past
     */
    public function setEncrypted(string $encrypted): Past
    {
        $this->encrypted = $encrypted;

        return $this;
    }

    /**
     * @return \Carbon\Carbon
     */
    public function getCreatedAt(): Carbon
    {
        return $this->created_at;
    }

    /**
     * @return \Carbon\Carbon
     */
    public function getExpireAt(): Carbon
    {
        return $this->expire_at;
    }

    /**
     * @param \Carbon\Carbon $expire_at
     *
     * @return Past
     */
    public function setExpireAt(Carbon $expire_at): Past
    {
        $this->expire_at = $expire_at;

        return $this;
    }

}

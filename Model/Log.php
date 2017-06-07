<?php

namespace DomTomProject\LoggerBundle\Model;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Log implements LogInterface {

    public const PRIORITY_LOW = 0;
    public const PRIORITY_MEDIUM = 1;
    public const PRIORITY_HIGH = 2;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="integer")
     */
    protected $priority;

    /**
     * @ORM\Column(name="is_failure", type="boolean")
     */
    protected $failure;
    private $microtime;

    public function __construct() {
        $this->createdAt = new DateTime();
        $this->priority = self::PRIORITY_LOW;
        $this->failure = false;
        $this->microtime = microtime(true);
    }

    public function getCeatedAt(): ?DateTime {
        return $this->createdAt;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getPriority(): ?int {
        return $this->priority;
    }

    public function setCreatedAt(DateTime $createdAt) {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function setPriority(int $priority) {
        $this->priority = $priority;
        return $this;
    }

    public function isFailure(): ?bool {
        return $this->failure;
    }

    public function setFailure(bool $failure) {
        $this->failure = $failure;
    }

    public function getCreatedMicrotime(): float {
        return $this->microtime;
    }

}

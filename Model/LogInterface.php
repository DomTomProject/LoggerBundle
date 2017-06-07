<?php

namespace DomTomProject\LoggerBundle\Model;

use DateTime;

interface LogInterface {

    public function getId(): ?int;

    public function getPriority(): ?int;

    public function setPriority(int $priority);

    public function setCreatedAt(DateTime $createdAt);

    public function getCeatedAt(): ?DateTime;

    public function isFailure(): ?bool;

    public function setFailure(bool $failure);
    
    public function getCreatedMicrotime(): float;
}

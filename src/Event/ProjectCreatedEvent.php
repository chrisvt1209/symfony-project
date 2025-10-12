<?php

namespace App\Event;

use App\Entity\Project;
use Symfony\Contracts\EventDispatcher\Event;

final class ProjectCreatedEvent extends Event
{
    public function __construct(
        protected Project $project,
    ) {
        
    }

    public function getProject(): Project
    {
        return $this->project;
    }
}

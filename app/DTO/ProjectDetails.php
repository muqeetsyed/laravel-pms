<?php


namespace App\DTO;

class ProjectDetails
{
    public function __construct(
        public string $id,
        public string $title,
        public ?string $description,
        public array $employees,
        public string $priority,
        public ?string $startingDate,
        public ?string $finishedDate,
    ){

    }
}

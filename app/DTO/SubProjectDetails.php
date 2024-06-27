<?php


namespace App\DTO;

use Illuminate\Http\UploadedFile;

final class SubProjectDetails{
    public function __construct(
        public string $id,
        public string $title,
        public string $description,
        public string $priority,
        public string $status,
        public ?string $timeEstimate,
        public array $employeesSelected,
        public ?string $attachment,
    ) {
    }
}

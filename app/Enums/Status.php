<?php

namespace App\Enums;

enum Status: string {
    case ReadyForPlanning = 'ReadyForPlanning';
    case ToDo = 'ToDo';
    case InProgress = 'InProgress';
    case TestPhase = 'TestPhase';
    case CodeReview = 'CodeReview';
    case Merged = 'Merged';
}

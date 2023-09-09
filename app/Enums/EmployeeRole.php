<?php

namespace App\Enums;

enum EmployeeRole: string {
    case Developer = 'developer';
    case Tester = 'tester';
    case QA = 'qa';
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;

    public function employees():BelongsToMany {
        return $this->belongsToMany(Employee::class, 'employee_project', 'project_id', 'employee_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubProject extends Model
{
    use HasFactory;

    public function attachments():HasMany {
        return $this->hasMany(Attachment::class, 'sub_project_id',);
    }
}

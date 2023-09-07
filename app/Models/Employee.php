<?php

namespace App\Models;

use App\Enums\EmployeeRole;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


//Employeename, username, password, emailid, phonenumber, role


class Employee extends Model
{
    //use HasFactory;

    /**
     * The table associated with the model
     *
     * @var string
     *
     */
    protected $table = 'employees';

    protected $casts = [
        'role' => EmployeeRole::class
    ];

    //column `password`
    public function setPasswordAttribute(string $password): void
    {
       $this->attributes['password'] = bcrypt($password);
    }

    //column `name`
    public function Name(): Attribute
    {
       return Attribute::make(
        set: fn (string $value) => \ucfirst($value)
       );

    }


}

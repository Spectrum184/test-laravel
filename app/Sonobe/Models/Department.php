<?php

namespace App\Sonobe\Models;

use App\Laravue\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Department extends Model
{
    use Notifiable;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'manager_id', 'department_code'
    ];

    /**
     * @return void
     * Create relations with department model 
     */
    public function employees()
    {
        return $this->hasMany(User::class);
    }

    /**
     * @return void
     * Create relations with department model 
     */
    public function manager()
    {
        return $this->hasOne(User::class, 'manager_id');
    }
}

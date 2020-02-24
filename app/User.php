<?php

namespace App;

use App\Models\Department;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    const DEEP          = 5;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'email', 'password', 'deep', 'parent_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'hiring_time' => 'datetime',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function children()
    {
        return $this->hasMany($this, 'parent_id', 'id')->with('department')
            ->whereNotNull('parent_id')
            ->where('deep','<',self::DEEP)
            ->orderBy('position');
    }

    public function parent()
    {
        return $this->BelongsTo($this, 'id', 'parent_id');
    }
}

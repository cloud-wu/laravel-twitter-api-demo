<?php

namespace App\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class User.
 *
 * @package namespace App\Entities;
 */
class User extends Authenticatable implements Transformable
{
    use TransformableTrait;

    protected $with = ['tokens'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['uid', 'name'];

    public function tokens()
    {
        return $this->hasMany(Token::class);
    }

    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    public function getTokenAttribute()
    {
        return $this->tokens->last();
    }
}

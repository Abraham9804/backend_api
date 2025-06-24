<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function person()
    {
        return $this->hasOne(Person::class);
    }

    public function role()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    /*public function assingRole($role){
        if(is_string($role)){
            $role = Role::where("name",$role)->firstOrFail;
        }
        $this->role()->sync($role, false);
    }*/

    //obtener permisos del usuario
    public function permission(){
        return $this->role->map->permission->flatten()->pluck("name")->unique();
    }

    public function branch()
    {
        return $this->belongsToMany(Branch::class)->withTimestamps();
    }

    public function transactionNote()
    {
        return $this->hasMany(TransactionNote::class);
    }

}

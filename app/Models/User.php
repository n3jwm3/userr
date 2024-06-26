<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    
    /**
    * The attributes that should be hidden for serialization.
    *
    * @var array<int, string>
    */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    /**
    * The attributes that should be cast.
    *
    * @var array<string, string>
    */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    static public function getSingle($id){
        return self::find($id);
        
    }
    static public function getAdmin(){
        return User::select('users.*')->where('user_type','=',1)
        ->orderBy('id', 'desc')->get();
    }
    static public function getTeacher(){
        return User::select('users.*')->where('user_type','=',2)
        ->orderBy('id', 'desc')->get();
    }
    static public function getEmailSingle($email){
        return User::where('email' , '=' , $email)->first();
        
    }
    static public function getTokenSingle($remember_token){
        return User::where('remember_token' , '=' , $remember_token)->first();
        
    }
    
    // la fonction pour relier user et crenaux :
    public function crenaus()
    {
        return $this->belongsToMany(Crenau::class, 'crenaus_users');
    }
    
    // la relation avec examen:
    public function examens()
    {
        return $this->belongsToMany(Examen::class, 'examens_users');
    }
    
    // fonction pour relier avec module
    public function modules()
    {
        return $this->belongsToMany(Module::class, 'users_modules');
    }
    
    
    
}

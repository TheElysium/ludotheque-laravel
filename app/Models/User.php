<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    function commentaires() {
        return $this->hasMany(Commentaire::class);
    }

    function creation() {
        return $this->hasMany(Jeu::class);
    }

    function ludo_perso() {
        return $this->belongsToMany(Jeu::class, 'achats')
            ->as('achat')
            ->withPivot('prix', 'lieu', 'date_achat');
    }

    public function jeuxNotInLudo(){
        $jeux_achetes = DB::table('achats')->where('user_id','=',Auth::id())->get();
        $jeux_achetes_id = $jeux_achetes->pluck('jeu_id');

        $jeux = Jeu::All()->whereNotIn('id',$jeux_achetes_id);

        return $jeux;
    }
}

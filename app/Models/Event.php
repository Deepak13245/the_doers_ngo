<?php

namespace App\Models;

use App\Triats\Maps;
use App\User;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use CrudTrait;
    use Maps;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'events';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = [ 'user_id', 'title', 'description', 'address', 'start', 'end', 'category_id', 'interest_id', 'lat', 'lng' ];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    function category()
    {
        return $this->belongsTo(Category::class);
    }

    function interest()
    {
        return $this->belongsTo(Interest::class);
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function distance($user)
    {
        return $this->getMapDistance($this->lat, $this->lng, $user->lat, $user->lng);
    }
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}

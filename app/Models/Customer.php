<?php

namespace App\Models;

use App\Models\Extend\ModelInterface;
use App\Models\Extend\SerializeDate;
use App\Models\Extend\ServicesAccessor;
use Askedio\SoftCascade\Traits\SoftCascadeTrait as SoftCascade;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable implements ModelInterface
{
    use HasApiTokens, HasFactory, Notifiable, 
    SoftDeletes, SoftCascade, ServicesAccessor, SerializeDate;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'nickname', 'status', 'properties', 'login_id', 'email',
        'birthday', 'tel', 'icon', 'password', 'note', 'display_to_ranking', 'visited_shop_ids',
        'visiting_shop_id', 'visiting_shop_name', 'latest_visit_id', 'latest_visited_date', 'latest_visited_at', 
        'total_chip', 'total_mile', 'total_visit', 'total_minutes', 'total_amount',
        'token', 'qr_token', 'latest_login_at', 'transferred_customer_id',
        'transferred_at', 'agreed_terms_id', 'agreed_at', 'agreed_signature_id', 'agreed_shop_id', 'changed_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => \App\Casts\Master::class,
        'properties' => \App\Casts\MultipleMaster::class,
        'birthday' => 'date:Y-m-d',
        'icon' => \App\Casts\Image::class .':customer/icon/',
        'visited_shop_ids' => \App\Casts\ShopIds::class,
        'latest_visited_date' => 'date:Y-m-d',
        'latest_visited_at' => 'datetime',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        // 'token' => \App\Casts\Token::class,
        'latest_login_at' => 'datetime',
        'display_to_ranking' => 'boolean',
        'transferred_at' => 'datetime',
        'agreed_at' => 'datetime',
        'changed_at' => 'datetime',
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Properties to be softcasde.
     *
     * @return array
     */
    protected $softCascade = [
        'details', 'ranks', 'device', 'authenticate_histories', 'agreed_signature', 'channels',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'latest_login_at', 'transferred_at',
        'agreed_terms_id', 'agreed_at', 'agreed_signature_id',
        'created_at', 'updated_at', 'deleted_at',
    ];

    #region relations

    public function details()
    {
        return $this->hasMany(CustomerDetail::class)->orderBy('latest_visited_at', 'desc');
    }

    public function ranks()
    {
        return $this->hasMany(CustomerRank::class)->orderBy('started_date', 'desc');
    }

    public function device()
    {
        return $this->hasOne(Device::class)->orderBy('latest_login_at', 'desc');
    }

    public function authenticate_histories()
    {
        return $this->hasMany(CustomerAuthenticateHistory::class)->orderBy('created_at', 'desc');
    }

    public function visits()
    {
        return $this->hasMany(Visit::class)->orderBy('started_at', 'desc');
    }

    public function latest_visit()
    {
        return $this->belongsTo(Visit::class, 'latest_visit_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function exchanges()
    {
        return $this->hasMany(Exchange::class)->orderBy('updated_at', 'desc');
    }

    public function expired_miles()
    {
        return $this->hasMany(ExpiredMile::class)->orderBy('date', 'desc');
    }

    public function expired_mile()
    {
        return $this->hasOne(ExpiredMile::class)
            ->where('expired_miles.visit_id', $this->latest_visit_id)
            ->orderBy('date', 'desc');
    }

    public function transferred()
    {
        return $this->belongsTo(Customer::class, 'id', 'transferred_customer_id')->withTrashed()->orderBy('transferred_at', 'desc');
    }

    public function agreed_terms()
    {
        return $this->hasOne(Terms::class, 'id', 'agreed_terms_id');
    }

    public function agreed_signature()
    {
        return $this->hasOne(Signature::class, 'id', 'agreed_signature_id');
    }

    public function agreed_shop()
    {
        return $this->hasOne(Shop::class, 'id', 'agreed_shop_id');
    }

    public function channels()
    {
        return $this->hasMany(Channel::class);
    }

    #endregion

}

<?php

namespace App\Models;

use WizwebBe\OrmApiBaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends OrmApiBaseModel
{
    protected $table = 'users';

    public $timestamps = false;

    protected $primaryKey = 'id';

    public function parentRelationships()
    {
        return [

        ];
    }

    public function spouseRelationships()
    {
        return [

        ];
    }

    public function childRelationships()
    {
        return [
            'mails' => []
        ];
    }

    public function rules()
    {
        return [
            'old_id' => 'nullable',
            'name' => 'nullable',
            'email' => 'sometimes:required',
            //'email_verified_at' => 'nullable',
            //'password' => 'sometimes:required',
            //'status' => 'sometimes:required',
            //'remember_token' => 'nullable',
            'created_at' => 'nullable',
            'updated_at' => 'nullable',
            'company_name' => 'nullable',
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'mobile_number' => 'nullable',
            'profile_photo' => 'nullable'
        ];
    }

    protected $fillable = [
        'old_id',
        'name',
        'email',
        //'email_verified_at',
        //'password',
        //'status',
        //'remember_token',
        'created_at',
        'updated_at',
        'company_name',
        'first_name',
        'last_name',
        'mobile_number',
        'profile_photo'
    ];



        public function mails(): HasMany
    {
        return $this->hasMany(Mail::class, 'recipient_id');
    }


}

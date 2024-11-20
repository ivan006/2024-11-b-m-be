<?php

namespace App\Models;

use WizwebBe\OrmApiBaseModel;

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
        ];
    }

    public function rules()
    {
        return [
            'old_id' => 'nullable',
            'name' => 'sometimes:required',
            //'email' => 'sometimes:required',
            //'email_verified_at' => 'nullable',
            //'password' => 'sometimes:required',
            //'status' => 'sometimes:required',
            //'remember_token' => 'nullable',
            'created_at' => 'nullable',
            'updated_at' => 'nullable'
        ];
    }

    protected $fillable = [
        'old_id',
        'name',
        //'email',
        //'email_verified_at',
        //'password',
        //'status',
        //'remember_token',
        'created_at',
        'updated_at'
    ];



}

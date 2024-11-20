<?php

namespace App\Models;

use WizwebBe\OrmApiBaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class EmailMessage extends OrmApiBaseModel
{
    protected $table = 'mails';

    public $timestamps = false;

    protected $primaryKey = 'id';

    public function parentRelationships()
    {
        return [
            'recipient' => []
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
            'recipient_id' => 'sometimes:required',
            'email_body' => 'sometimes:required',
            'created_at' => 'nullable',
            'updated_at' => 'nullable'
        ];
    }

    protected $fillable = [
        'recipient_id',
        'email_body',
        'created_at',
        'updated_at'
    ];

        public function recipient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }




}

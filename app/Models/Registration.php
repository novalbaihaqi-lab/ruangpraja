<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'user_id',
        'webinar_id',
        'certificate_number',
        'certificate_generated_at',
        'survey_proof_path',
    ];

    protected $casts = [
        'certificate_generated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function webinar()
    {
        return $this->belongsTo(Webinar::class);
    }

    public function hasSurveyProof(): bool
    {
        return !is_null($this->survey_proof_path);
    }
}
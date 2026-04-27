<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Webinar extends Model
{
    protected $fillable = [
        'title',
        'description',
        'speaker',
        'scheduled_at',
        'quota',
        'status',
        'zoom_link',
        'documentation_url',
        'poster_path',
        'certificate_template_path',
        'cert_name_x',
        'cert_name_y',
        'cert_name_size',
        'cert_name_color',
        'cert_font',
        'survey_url',
        'materi_url'
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function participants()
    {
        return $this->hasManyThrough(User::class, Registration::class, 'webinar_id', 'id', 'id', 'user_id');
    }
}
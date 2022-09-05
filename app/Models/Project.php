<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Project extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    public const STATUS = ['open', 'in_progress', 'blocked', 'cancelled', 'completed'];
    public $translatable = ['title', 'description'];
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'client_id',
        'deadline',
        'status'
    ];

    public function GetUserAttribute()
    {
        $profile_ids = null;
        $profiles = $this->user()->get('name');
        foreach ($profiles as $profile) {
            $profile_ids = $profile->name;
        }

        return $profile_ids;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}

<?php

namespace App\Models;

use Faker\Provider\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Str;

class Task extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    public const STATUS = ['open', 'inـprogress', 'pending', 'waiting client', 'blocked', 'closed'];
    public $translatable = ['title', 'description'];
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'client_id',
        'project_id',
        'deadline',
        'status',
        'TaskCode'
    ];


    public static function boot()
    {
        parent::boot();
        self::creating(function ($task) {
            $task->TaskCode = (string)Str::uuid();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}

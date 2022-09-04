<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Client extends Model
{
    use HasFactory, SoftDeletes,HasTranslations;

    public $translatable = ['company','vat','address'];

    protected $fillable = [
        'company',
        'vat',
        'address',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}

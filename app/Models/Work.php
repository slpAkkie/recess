<?php

namespace App\Models;

use App\Models\WorkObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type_id',
        'country',
        'city',
        'shooted_at',
    ];

    public function getVideo()
    {
        return $this->objects()->where('type_id', 1)->orderBy('id', 'DESC')->first();
    }

    public function getPhotos()
    {
        return $this->objects()->where('type_id', 2)->limit(5)->get();
    }

    public function objects()
    {
        return $this->hasMany(WorkObject::class);
    }

    public function type()
    {
        return $this->belongsTo(ShootingType::class);
    }
}

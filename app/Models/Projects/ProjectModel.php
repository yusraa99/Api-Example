<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectModel extends Model
{
    use HasFactory;
    protected $table='projects';

    protected $fillable = [
        'name_ar',
        'name_en',
        'description',
        'created_at',
        'updated_at',
    ];
}

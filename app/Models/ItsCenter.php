<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItsCenter extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'its_centers';

    public function courses()
    {
        return $this->hasMany(Course::class, 'its_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'its_id');
    }
}

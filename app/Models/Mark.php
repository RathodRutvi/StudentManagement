<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mark extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $table="marks";
    protected $fillable= ['id','student_id','english','hindi','gujarati','deleted_at'];

    public function student()
    {
        return $this->belongsTo(Student::class,'student_id','id');
    }
}

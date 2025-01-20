<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spost extends Model
{
    use SoftDeletes;
    use HasFactory;
    public function scategory(){
        return $this->belongsTo(Scategory::class);
    }
}

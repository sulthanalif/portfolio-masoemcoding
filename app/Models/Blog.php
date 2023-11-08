<?php

namespace App\Models;

use App\Helper\UuidGenerator;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use UuidGenerator;
    
    protected $keyType = 'string';
    protected $primaryKey = 'id';
    public $incrementing = false;
    
    protected $fillable = [
        'tittle', 'user_id', 'content', 'image'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}

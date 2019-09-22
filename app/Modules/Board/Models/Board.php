<?php 

namespace App\Modules\Board\Models;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    public $timestamps = false;

    protected $table = 'board';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'users_id',
    ];
}
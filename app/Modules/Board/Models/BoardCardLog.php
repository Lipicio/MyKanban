<?php 

namespace App\Modules\Board\Models;

use Illuminate\Database\Eloquent\Model;

class BoardCardLog extends Model
{
    public $timestamps = false;

    protected $table = 'board_card_log';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'description',
        'date',
        'board_card_id',
        'users_id'
    ];
}
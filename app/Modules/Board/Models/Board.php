<?php 

namespace App\Modules\Board\Models;

use App\User;
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

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function lists()
    {
    	return $this->hasMany(BoardList::class, 'board_id', 'id');
    }
}
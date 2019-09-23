<?php 

namespace App\Modules\Board\Models;

use Illuminate\Database\Eloquent\Model;

class BoardList extends Model
{
    public $timestamps = false;

    protected $table = 'board_list';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'date_inserted',
        'board_id'
    ];

    public function cards()
    {
    	return $this->hasMany(BoardCard::class, 'board_list_id', 'id');
    }
}
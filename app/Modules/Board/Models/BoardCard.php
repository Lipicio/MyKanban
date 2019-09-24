<?php 

namespace App\Modules\Board\Models;

use Illuminate\Database\Eloquent\Model;

class BoardCard extends Model
{
    public $timestamps = false;

    protected $table = 'board_card';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'description',
        'due_date',
        'board_list_id'
    ];
}
<?php 

namespace App\Modules\Board\Requests;

use Validator;
use App\Modules\Board\Models\Board;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class BaseBoardRequest extends FormRequest
{
    function __construct()
    {
        parent::__construct();

        Validator::extend('validate_boardId', function($attribute, $value, $parameters, $validator) {
            $user = Auth::user();
            $board = Board::where('id', $value)->where('users_id', $user->id)->first();
            return !empty($board);
        },'The board id is invalid.');
    }
}

<?php 

namespace App\Modules\Board\Requests\Lists;

use App\Modules\Board\Requests\BaseBoardRequest;

class DeleteBoardListRequest extends BaseBoardRequest
{
    public function rules()
    {
        return [
            'listId' => 'required|validate_listId'
        ];
    }

    protected function validationData()
    {
        return array_merge($this->request->all(), [
            'listId' => \Route::input('listId'),
        ]);
    }

    public function response(array $errors)
    {
        return response()->json(['error'=>$errors], 400);
    }
}

<?php 

namespace App\Modules\Board\Requests\Lists;

use App\Modules\Board\Requests\BaseBoardRequest;

class CreateOrEditListRequest extends BaseBoardRequest
{
    public function rules()
    {
        return [
            'listId' => 'nullable|validate_listId',
            'boardId' => 'required_without:listId|validate_boardId',
            'listName' => 'required|max:45'
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
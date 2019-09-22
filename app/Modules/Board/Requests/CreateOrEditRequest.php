<?php 

namespace App\Modules\Board\Requests;

class CreateOrEditRequest extends BaseBoardRequest
{
    public function rules()
    {
        return [
            'boardId' => 'nullable|validate_boardId',
            'boardName' => 'required|max:80'
        ];
    }

    public function response(array $errors)
    {
        return response()->json(['error'=>$errors], 400);
    }
}

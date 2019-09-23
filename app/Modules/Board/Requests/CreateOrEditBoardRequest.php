<?php 

namespace App\Modules\Board\Requests;

class CreateOrEditBoardRequest extends BaseBoardRequest
{
    public function rules()
    {
        return [
            'boardId' => 'nullable|validate_boardId',
            'boardName' => 'required|max:80'
        ];
    }

    protected function validationData()
    {
        return array_merge($this->request->all(), [
            'boardId' => \Route::input('boardId'),
        ]);
    }

    public function response(array $errors)
    {
        return response()->json(['error'=>$errors], 400);
    }
}

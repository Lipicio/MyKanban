<?php 

namespace App\Modules\Board\Requests;

class DeleteRequest extends BaseBoardRequest
{
    public function rules()
    {
        return [
            'boardId' => 'required|validate_boardId'
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

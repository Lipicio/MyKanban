<?php 

namespace App\Modules\Board\Requests\Card;

use App\Modules\Board\Requests\BaseBoardRequest;

class CreateOrEditCardRequest extends BaseBoardRequest
{
    public function rules()
    {
        return [
            'listId' => 'required|validate_listId',
            'cardName' => 'required|max:80',
            'cardDescription' => 'nullable|max:2000',
            'cardDateLimit' => 'nullable|date_format:Y-m-d H:i:s',
            'cardId' => 'nullable|exists:board_card,id',
        ];
    }

    protected function validationData()
    {
        return array_merge($this->request->all(), [
            'cardId' => \Route::input('cardId'),
        ]);
    }

    public function response(array $errors)
    {
        return response()->json(['error'=>$errors], 400);
    }
}
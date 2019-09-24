<?php 

namespace App\Modules\Board\Services;

use App\Modules\Board\Models\BoardCard;

class BoardCardService
{
	public function createOrEdit($listId, $cardName, $cardDescription, $cardDateLimit, $cardId = null)
	{
		$card = empty($cardId) ? new BoardCard() : BoardCard::find($cardId);
        $card->fill([
	        'name' => $cardName,
	        'description' => $cardDescription,
	        'due_date' => $cardDateLimit,
	        'board_list_id' => $listId
        ]);
        $card->save();

        return ['cardId' => $card->id, 'cardName' => $card->name];
	}

	public function delete($cardId)
	{
		$card = BoardCard::find($cardId);
		$card->delete();
		
		return [];
	}
}
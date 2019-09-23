<?php 

namespace App\Modules\Board\Services;

use App\Modules\Board\Models\BoardList;

class BoardListService
{
	public function createOrEdit($listName, $boardId, $listId = null)
	{
		$data = ['name' => $listName];
		if(!empty($boardId)) $data['board_id'] = $boardId;

		$list = empty($listId) ? new BoardList() : BoardList::find($listId);
        $list->fill($data);
        $list->save();

        return ['listId' => $list->id, 'listName' => $list->name];
	}

	public function delete($listId)
	{
		$list = BoardList::find($listId);
		$list->cards()->delete();
		$list->delete();
		
		return [];
	}
}
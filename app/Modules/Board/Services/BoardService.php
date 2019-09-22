<?php 

namespace App\Modules\Board\Services;

use App\Modules\Board\Models\Board;

class BoardService
{
	public function createOrEdit($user, $boardName, $boardId = null)
	{
		$board = empty($boardId) ? new Board() : Board::find($boardId);
        $board->fill(['name' => $boardName, 'users_id' => $user->id]);
        $board->save();
        $board = collect($board);

        return ['boardId' => $board['id'], 'boardName' => $board['name']];
	}

	public function delete($boardId)
	{
		$board = Board::find($boardId);
		$board->delete();
		
		return [];
	}
}
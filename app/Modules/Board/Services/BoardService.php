<?php 

namespace App\Modules\Board\Services;

use App\Modules\Board\Models\Board;

class BoardService
{
	public function getBoard($boardId)
	{
		$board = Board::with([
					'user' => function($query){
						$query->select('id', 'name', 'email');
					},
					'lists.cards'
				])->find($boardId);

		return $board;
	}

	public function createOrEdit($user, $boardName, $boardId = null)
	{
		$board = empty($boardId) ? new Board() : Board::find($boardId);
        $board->fill(['name' => $boardName, 'users_id' => $user->id]);
        $board->save();

        return ['boardId' => $board->id, 'boardName' => $board->name];
	}

	public function delete($boardId)
	{
		$board = Board::find($boardId);
		$board->delete();
		
		return [];
	}
}
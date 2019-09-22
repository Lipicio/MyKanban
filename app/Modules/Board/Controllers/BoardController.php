<?php

namespace App\Modules\Board\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Modules\Board\Services\BoardService;
use App\Modules\Board\Requests\CreateOrEditRequest;
use App\Modules\Board\Requests\DeleteRequest;

class BoardController extends Controller
{
    public function createOrEdit(CreateOrEditRequest $request, BoardService $service)
    {
        \DB::beginTransaction();
        try 
        {
            $user = Auth::user();
            $boardName = $request->get('boardName', '');
            $boardId = $request->get('boardId', '');
            $response = $service->createOrEdit($user, $boardName, $boardId);

            \DB::commit();
            return response()->json($response, 200);
        } catch (\Exception $ex) {
          \DB::rollback();
          \Log::error([$ex->getMessage(), $ex->getFile(), $ex->getLine(), $ex->getTraceAsString()]);
          return response()->json(['error'=>'Internal Servidor Error'], 500);
        }
    }

    public function delete($boardId, DeleteRequest $request, BoardService $service)
    {
        \DB::beginTransaction();
        try 
        {
            $response = $service->delete($boardId);
            \DB::commit();
            return response()->json($response, 200);
        } catch (\Exception $ex) {
          \DB::rollback();
          \Log::error([$ex->getMessage(), $ex->getFile(), $ex->getLine(), $ex->getTraceAsString()]);
          return response()->json(['error'=>'Internal Servidor Error'], 500);
        }
    }
}
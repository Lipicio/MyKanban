<?php

namespace App\Modules\Board\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Modules\Board\Services\BoardListService;
use App\Modules\Board\Requests\GetBoardListRequest;
use App\Modules\Board\Requests\DeleteBoardListRequest;
use App\Modules\Board\Requests\CreateOrEditBoardListRequest;

class BoardListController extends Controller
{

    private $service;

    function __construct(BoardListService $service)
    {
        $this->service = $service;
    }

    public function create(CreateOrEditBoardListRequest $request)
    {
        \DB::beginTransaction();
        try 
        {
            $listName = $request->get('listName', '');
            $boardId = $request->get('boardId', '');
            $response = $this->service->createOrEdit($listName, $boardId);

            \DB::commit();
            return response()->json($response, 200);
        } catch (\Exception $ex) {
          \DB::rollback();
          \Log::error([$ex->getMessage(), $ex->getFile(), $ex->getLine(), $ex->getTraceAsString()]);
          return response()->json(['error'=>'Internal Servidor Error'], 500);
        }
    }

    public function edit($listId, CreateOrEditBoardListRequest $request)
    {
        \DB::beginTransaction();
        try 
        {
            $listName = $request->get('listName', '');
            $boardId = $request->get('boardId', '');
            $response = $this->service->createOrEdit($listName, $boardId, $listId);

            \DB::commit();
            return response()->json($response, 200);
        } catch (\Exception $ex) {
          \DB::rollback();
          \Log::error([$ex->getMessage(), $ex->getFile(), $ex->getLine(), $ex->getTraceAsString()]);
          return response()->json(['error'=>'Internal Servidor Error'], 500);
        }
    }

    public function delete($listId, DeleteBoardListRequest $request)
    {
        \DB::beginTransaction();
        try 
        {
            $response = $this->service->delete($listId);
            \DB::commit();
            return response()->json($response, 200);
        } catch (\Exception $ex) {
          \DB::rollback();
          \Log::error([$ex->getMessage(), $ex->getFile(), $ex->getLine(), $ex->getTraceAsString()]);
          return response()->json(['error'=>'Internal Servidor Error'], 500);
        }
    }
}
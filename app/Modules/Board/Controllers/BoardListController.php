<?php

namespace App\Modules\Board\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Board\Services\BoardListService;
use App\Modules\Board\Requests\Lists\DeleteListRequest;
use App\Modules\Board\Requests\Lists\CreateOrEditListRequest;

class BoardListController extends Controller
{

    private $service;

    function __construct(BoardListService $service)
    {
        $this->service = $service;
    }

    public function create(CreateOrEditListRequest $request)
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

    public function edit($listId, CreateOrEditListRequest $request)
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

    public function delete($listId, DeleteListRequest $request)
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
<?php

namespace App\Modules\Board\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Modules\Board\Services\BoardService;
use App\Modules\Board\Requests\GetBoardRequest;
use App\Modules\Board\Requests\CreateOrEditRequest;
use App\Modules\Board\Requests\DeleteRequest;

class BoardController extends Controller
{

    private $service;

    function __construct(BoardService $service)
    {
        $this->service = $service;
    }

    public function get($boardId, GetBoardRequest $request)
    {
        try
        {
            $response = $this->service->getBoard($boardId);
            return response()->json($response, 200);
        } catch (\Exception $ex) {
          \Log::error([$ex->getMessage(), $ex->getFile(), $ex->getLine(), $ex->getTraceAsString()]);
          return response()->json(['error'=>'Internal Servidor Error'], 500);
        }
    }

    public function create(CreateOrEditRequest $request)
    {
        \DB::beginTransaction();
        try 
        {
            $user = Auth::user();
            $boardName = $request->get('boardName', '');
            $response = $this->service->createOrEdit($user, $boardName);

            \DB::commit();
            return response()->json($response, 200);
        } catch (\Exception $ex) {
          \DB::rollback();
          \Log::error([$ex->getMessage(), $ex->getFile(), $ex->getLine(), $ex->getTraceAsString()]);
          return response()->json(['error'=>'Internal Servidor Error'], 500);
        }
    }

    public function edit($boardId, CreateOrEditRequest $request)
    {
        \DB::beginTransaction();
        try 
        {
            $user = Auth::user();
            $boardName = $request->get('boardName', '');
            $response = $this->service->createOrEdit($user, $boardName, $boardId);

            \DB::commit();
            return response()->json($response, 200);
        } catch (\Exception $ex) {
          \DB::rollback();
          \Log::error([$ex->getMessage(), $ex->getFile(), $ex->getLine(), $ex->getTraceAsString()]);
          return response()->json(['error'=>'Internal Servidor Error'], 500);
        }
    }

    public function delete($boardId, DeleteRequest $request)
    {
        \DB::beginTransaction();
        try 
        {
            $response = $this->service->delete($boardId);
            \DB::commit();
            return response()->json($response, 200);
        } catch (\Exception $ex) {
          \DB::rollback();
          \Log::error([$ex->getMessage(), $ex->getFile(), $ex->getLine(), $ex->getTraceAsString()]);
          return response()->json(['error'=>'Internal Servidor Error'], 500);
        }
    }
}
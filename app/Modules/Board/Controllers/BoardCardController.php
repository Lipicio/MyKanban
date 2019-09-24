<?php

namespace App\Modules\Board\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Board\Services\BoardCardService;
use App\Modules\Board\Requests\Card\DeleteCardRequest;
use App\Modules\Board\Requests\Card\CreateOrEditCardRequest;

class BoardCardController extends Controller
{

    private $service;

    function __construct(BoardCardService $service)
    {
        $this->service = $service;
    }

    public function create(CreateOrEditCardRequest $request)
    {
        \DB::beginTransaction();
        try
        {
            $listId = $request->get('listId', '');
            $cardName = $request->get('cardName', '');
            $cardDescription = $request->get('cardDescription', '');
            $cardDateLimit = $request->get('cardDateLimit', '');

            $response = $this->service->createOrEdit($listId, $cardName, $cardDescription, $cardDateLimit);
            \DB::commit();
            return response()->json($response, 200);
        } catch (\Exception $ex) {
          \DB::rollback();
          \Log::error([$ex->getMessage(), $ex->getFile(), $ex->getLine(), $ex->getTraceAsString()]);
          return response()->json(['error'=>'Internal Servidor Error'], 500);
        }
    }

    public function edit($cardId, CreateOrEditCardRequest $request)
    {
        \DB::beginTransaction();
        try
        {
            $listId = $request->get('listId', '');
            $cardName = $request->get('cardName', '');
            $cardDescription = $request->get('cardDescription', '');
            $cardDateLimit = $request->get('cardDateLimit', '');

            $response = $this->service->createOrEdit($listId, $cardName, $cardDescription, $cardDateLimit, $cardId);
            \DB::commit();
            return response()->json($response, 200);
        } catch (\Exception $ex) {
          \DB::rollback();
          \Log::error([$ex->getMessage(), $ex->getFile(), $ex->getLine(), $ex->getTraceAsString()]);
          return response()->json(['error'=>'Internal Servidor Error'], 500);
        }
    }

    public function delete($cardId, DeleteCardRequest $request)
    {
        \DB::beginTransaction();
        try 
        {
            $response = $this->service->delete($cardId);
            \DB::commit();
            return response()->json($response, 200);
        } catch (\Exception $ex) {
          \DB::rollback();
          \Log::error([$ex->getMessage(), $ex->getFile(), $ex->getLine(), $ex->getTraceAsString()]);
          return response()->json(['error'=>'Internal Servidor Error'], 500);
        }
    }
}
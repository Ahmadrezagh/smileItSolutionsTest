<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Transfer\IndexTransferRequest;
use App\Http\Requests\Api\V1\Transfer\StoreTransferRequest;
use App\Http\Resources\TransferResource;
use App\Models\Account;
use App\Models\Transfer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexTransferRequest $request): AnonymousResourceCollection
    {
        $transactions = Transfer::query()
            ->filterByAccountCardNumber($request->card_number)
            ->filterByFromAccountCardNumber($request->from_card_number)
            ->filterByToAccountCardNumber($request->to_card_number)
            ->orderBy($request->orderBy, $request->orderType)
            ->paginate($request->perPage, ['*'], 'page', $request->page);

        return TransferResource::collection($transactions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransferRequest $request): TransferResource
    {
        $transfer = Transfer::query()->create($request->convertedData());
        return new TransferResource($transfer);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return TransferResource
     */
    public function show(Transfer $transfer): TransferResource
    {
        return new TransferResource($transfer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transfer $transfer): Response
    {
        $transfer->delete();
        return response()->noContent();
    }
}

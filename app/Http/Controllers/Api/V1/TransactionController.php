<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Transaction\IndexTransactionRequest;
use App\Http\Requests\Api\V1\Transaction\StoreTransactionRequest;
use App\Http\Resources\AccountResource;
use App\Http\Resources\BaseResource;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexTransactionRequest $request
     * @return AnonymousResourceCollection
     */
    public function index(IndexTransactionRequest $request): AnonymousResourceCollection
    {
        $transactions = Transaction::query()
            ->filterByAccountCardNumber($request->card_number)
            ->orderBy($request->orderBy, $request->orderType)
            ->paginate($request->perPage, ['*'], 'page', $request->page);

        return TransactionResource::collection($transactions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return TransactionResource
     */
    public function store(StoreTransactionRequest $request): TransactionResource
    {
        $transaction = Transaction::query()->create($request->convertedData());
        return new TransactionResource($transaction);
    }

    /**
     * Display the specified resource.
     *
     * @param Transaction $transaction
     * @return TransactionResource
     */
    public function show(Transaction $transaction): TransactionResource
    {
        return new TransactionResource($transaction);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Transaction $transaction
     * @return Response
     */
    public function destroy(Transaction $transaction): Response
    {
        $transaction->delete();
        return response()->noContent();
    }
}

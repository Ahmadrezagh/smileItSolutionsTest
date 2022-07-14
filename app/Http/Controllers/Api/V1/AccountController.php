<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Account\IndexAccountRequest;
use App\Http\Requests\Api\V1\Account\StoreAccountRequest;
use App\Http\Requests\Api\V1\Account\UpdateAccountRequest;
use App\Http\Resources\AccountResource;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class AccountController extends Controller
{
    /**
     * Display a listing of the account.
     *
     * @param IndexAccountRequest $request
     * @return AnonymousResourceCollection
     */
    public function index(IndexAccountRequest $request): AnonymousResourceCollection
    {
        $accounts = Account::query()
            ->filterByUserEmail($request->user_email)
            ->orderBy($request->orderBy, $request->orderType)
            ->paginate($request->perPage, ['*'], 'page', $request->page);

        return AccountResource::collection($accounts);
    }

    /**
     * Store a newly created account in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return AccountResource
     */
    public function store(StoreAccountRequest $request):AccountResource
    {
        $account = Account::query()->create($request->safe()->toArray());
        return new AccountResource($account);
    }

    /**
     * Display the specified account.
     *
     * @param Account $account
     * @return AccountResource
     */
    public function show(Account $account): AccountResource
    {
        return new AccountResource($account);
    }

    /**
     * Update the specified account in storage.
     *
     * @param Request $request
     * @param Account $account
     * @return AccountResource
     */
    public function update(UpdateAccountRequest $request, Account $account): AccountResource
    {
        $account->update($request->safe()->toArray());
        return new AccountResource($account);
    }

    /**
     * Remove the specified account from storage.
     *
     * @param Account $account
     * @return Response
     */
    public function destroy(Account $account): Response
    {
        $account->delete();
        return response()->noContent();
    }
}

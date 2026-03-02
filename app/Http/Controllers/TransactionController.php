<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Services\CategoryService;
use App\Services\TransactionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TransactionController extends Controller
{
    protected TransactionService $transactionService;
    protected CategoryService $categoryService;

    public function __construct(
        TransactionService $transactionService,
        CategoryService $categoryService
    ) {
        $this->transactionService = $transactionService;
        $this->categoryService = $categoryService;
    }

    /**
     * Fungsi menuju halaman utama
     *
     * @return View
     */
    public function index(): View
    {
        $totalIncome = $this->transactionService->totalIncome();
        $totalExpense = $this->transactionService->totalExpense();
        $balance = $this->transactionService->balance();

        return $this->responseView('transactions.index', compact(
            'totalIncome',
            'totalExpense',
            'balance'
        ));
    }

    /**
     * Fungsi datatable transaksi
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function datatable(Request $request): JsonResponse
    {
        return $this->transactionService->handleGetTransactionDatatable($request)->getResult()->make(true);
    }

    /**
     * Fungsi store transaksi baru
     *
     * @param StoreTransactionRequest $request
     * @return JsonResponse
     */
    public function store(StoreTransactionRequest $request): JsonResponse
    {
        return $this->transactionService->handleStoreTransaction($request)->json();
    }

    /**
     * Fungsi delete transaksi
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        return $this->transactionService->handleDeleteTransaction($id)->json();
    }

    public function show($id)
    {
        return $this->transactionService->getTransactionById($id);
    }

    public function update(UpdateTransactionRequest $request, int $id): JsonResponse
    {
        return $this->transactionService->handleUpdateTransaction($request, $id)->json();
    }
}

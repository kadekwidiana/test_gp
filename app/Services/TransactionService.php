<?php

namespace App\Services;

use App\Models\Transaction;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TransactionService extends BaseService
{
    protected TransactionRepository $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * Handle get transaction datatable.
     *
     * @param Request $request
     * @return $this
     */
    public function handleGetTransactionDatatable(Request $request): self
    {
        try {
            $query = $this->transactionRepository->builderTransactionForDatatable([
                'type' => $request->type,
            ]);

            if ($request->start_date) {
                $query->whereDate('transaction_date', '>=', $request->start_date);
            }

            if ($request->end_date) {
                $query->whereDate('transaction_date', '<=', $request->end_date);
            }

            $dataTable = DataTables::eloquent($query)
                ->addIndexColumn()
                ->addColumn('formatted_date', fn($row) => $row->formatted_date)
                ->addColumn('category_name', fn($row) => $row->category->name ?? '-')
                ->addColumn('formatted_amount', fn($row) => formatRupiah($row->amount))
                ->addColumn('action', function ($row) {
                    return '
        <button class="btn btn-sm btn-warning btn-edit" data-id="' . $row->id . '">
            <i class="bi bi-pencil"></i>
        </button>
        <button class="btn btn-sm btn-outline-danger btn-delete" data-id="' . $row->id . '">
            <i class="bi bi-trash"></i>
        </button>
        ';
                })
                ->rawColumns(['action']);

            return $this->setSuccess(true)
                ->setResult($dataTable)
                ->setMessage('DataTable transaksi')
                ->setCode(200);
        } catch (\Exception $e) {
            return $this->exceptionResponse($e);
        }
    }

    /**
     * Handle store transaction.
     *
     * @param Request $request
     * @return $this
     */
    public function handleStoreTransaction(Request $request): self
    {
        try {
            $this->transactionRepository->storeTransaction([
                'category_id' => $request->category_id,
                'type' => $request->type,
                'amount' => $request->amount,
                'description' => $request->description,
                'transaction_date' => $request->transaction_date,
            ]);

            return $this->setSuccess(true)
                ->setMessage('Transaksi berhasil disimpan!')
                ->setCode(201);
        } catch (\Exception $e) {
            return $this->exceptionResponse($e);
        }
    }


    /**
     * Handle delete transaction.
     *
     * @param int $id
     * @return $this
     */
    public function handleDeleteTransaction(int $id): self
    {
        try {
            $transaction = $this->transactionRepository->findTransactionById($id);

            $this->transactionRepository->deleteTransaction($transaction);

            return $this->setSuccess(true)
                ->setMessage('Transaksi berhasil dihapus!')
                ->setCode(200);
        } catch (\Exception $e) {
            return $this->exceptionResponse($e);
        }
    }

    public function findTransactionById(int $id): ?Transaction
    {
        return $this->transactionRepository->findTransactionById($id);
    }

    public function handleUpdateTransaction(Request $request, int $id): self
    {
        try {
            $transaction = $this->transactionRepository->findTransactionById($id);

            $this->transactionRepository->updateTransaction($transaction, [
                'category_id' => $request->category_id,
                'type' => $request->type,
                'amount' => $request->amount,
                'description' => $request->description,
                'transaction_date' => $request->transaction_date,
            ]);

            return $this->setSuccess(true)
                ->setMessage('Transaksi berhasil diupdate!')
                ->setCode(200);
        } catch (\Exception $e) {
            return $this->exceptionResponse($e);
        }
    }

    public function totalIncome(): int
    {
        return $this->transactionRepository->totalIncome();
    }

    public function totalExpense(): int
    {
        return $this->transactionRepository->totalExpense();
    }
    public function balance(): int
    {
        return $this->transactionRepository->balance();
    }

    public function getTransactionById(int $id)
    {
        try {
            $transaction = $this->transactionRepository->findTransactionById($id);

            return response()->json([
                'success' => true,
                'data' => $transaction
            ]);
        } catch (\Exception $e) {
            return $this->exceptionResponse($e);
        }
    }
}

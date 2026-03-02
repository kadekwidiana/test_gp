<?php

namespace App\Repositories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder;

class TransactionRepository
{
    /**
     * Eloquent get transactions for datatable with filter.
     *
     * @param array $filter
     * @return Builder
     */
    public function builderTransactionForDatatable(array $filter): Builder
    {
        return Transaction::with('category')
            ->when($filter['type'], fn(Builder $query, string $type) =>
            $query->where('type', $type))
            ->orderBy('transaction_date', 'desc');
    }

    /**
     * Eloquent store new transaction.
     *
     * @param array $data
     * @return Transaction
     */
    public function storeTransaction(array $data): Transaction
    {
        return Transaction::create($data);
    }

    /**
     * Eloquent find transaction by ID.
     *
     * @param int $id
     * @return Transaction|null
     */
    public function findTransactionById(int $id): ?Transaction
    {
        return Transaction::with('category')
            ->findOrFail($id);
    }

    /**
     * Eloquent delete transaction.
     *
     * @param Transaction $transaction
     * @return bool|null
     */
    public function deleteTransaction(Transaction $transaction)
    {
        return $transaction->delete();
    }

    public function updateTransaction(Transaction $transaction, array $data)
    {
        return $transaction->update($data);
    }

    public function totalIncome(): int
    {
        return Transaction::income()->sum('amount');
    }

    public function totalExpense(): int
    {
        return Transaction::expense()->sum('amount');
    }

    public function balance(): int
    {
        return $this->totalIncome() - $this->totalExpense();
    }
}

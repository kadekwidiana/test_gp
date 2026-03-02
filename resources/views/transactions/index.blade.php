@extends("layouts.app")

@section("title", "Transaksi - Financial Management")

@section("content")
  <!-- Summary Cards -->
  <div class="row mb-4">
    <div class="col-md-4 mb-3">
      <div class="card summary-card bg-white">
        <div class="card-body">
          <p class="card-title mb-1">Total Pemasukan</p>
          <p class="card-value text-success mb-0" id="totalIncome">
            {{ formatRupiah($totalIncome) }}
          </p>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card summary-card bg-white">
        <div class="card-body">
          <p class="card-title mb-1">Total Pengeluaran</p>
          <p class="card-value text-danger mb-0" id="totalExpense">
            {{ formatRupiah($totalExpense) }}
          </p>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card summary-card bg-white">
        <div class="card-body">
          <p class="card-title mb-1">Saldo</p>
          <p class="card-value {{ $balance >= 0 ? "text-primary" : "text-danger" }} mb-0" id="totalBalance">
            {{ formatRupiah($balance) }}
          </p>
        </div>
      </div>
    </div>
  </div>

  <!-- Action Button -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Daftar Transaksi</h4>
    <button class="btn btn-primary" id="btnAddTransaction">
      <i class="bi bi-plus-circle me-1"></i> Tambah Transaksi
    </button>
  </div>

  <!-- Date Range Filter -->
  <div class="card mb-3">
    <div class="card-body">
      <div class="row align-items-end pb-3">
        <div class="col-md-4">
          <label for="filter_start_date" class="form-label mb-1 small text-muted">Dari Tanggal</label>
          <input type="date" class="form-control form-control-sm" id="filter_start_date">
        </div>
        <div class="col-md-4">
          <label for="filter_end_date" class="form-label mb-1 small text-muted">Sampai Tanggal</label>
          <input type="date" class="form-control form-control-sm" id="filter_end_date">
        </div>
        <div class="col-md-4 d-flex gap-2">
          <button class="btn btn-sm btn-primary" id="btnApplyFilter">
            <i class="bi bi-funnel me-1"></i> Filter
          </button>
          <button class="btn btn-sm btn-outline-secondary" id="btnResetFilter">
            <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Tabs -->
  <ul class="nav nav-tabs" id="transactionTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="income-tab" data-bs-toggle="tab" data-bs-target="#income" type="button"
        role="tab" aria-controls="income" aria-selected="true">
        <i class="bi bi-arrow-down-circle text-success me-1"></i> Pemasukan
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="expense-tab" data-bs-toggle="tab" data-bs-target="#expense" type="button"
        role="tab" aria-controls="expense" aria-selected="false">
        <i class="bi bi-arrow-up-circle text-danger me-1"></i> Pengeluaran
      </button>
    </li>
  </ul>

  <!-- Tab Content -->
  <div class="tab-content bg-white border border-top-0 rounded-bottom p-3" id="transactionTabContent">
    <!-- Income Tab -->
    <div class="tab-pane fade show active" id="income" role="tabpanel" aria-labelledby="income-tab">
      <div class="table-responsive">
        <table class="table table-hover align-middle" id="incomeTable" style="width:100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Tanggal</th>
              <th>Kategori</th>
              <th>Deskripsi</th>
              <th class="text-end">Jumlah</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>

    <!-- Expense Tab -->
    <div class="tab-pane fade" id="expense" role="tabpanel" aria-labelledby="expense-tab">
      <div class="table-responsive">
        <table class="table table-hover align-middle" id="expenseTable" style="width:100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Tanggal</th>
              <th>Kategori</th>
              <th>Deskripsi</th>
              <th class="text-end">Jumlah</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>

  <!-- Transaction Modal (Reusable Partial) -->
  @include("transactions._modal")
@endsection

@push("scripts")
  <script>
    window.transactionStoreUrl = '{{ route("transactions.store") }}';
    window.transactionUpdateUrl = '{{ url("transactions") }}';
    window.transactionDeleteUrl = '{{ url("transactions") }}';
    window.transactionDatatableUrl = '{{ route("transactions.datatable") }}';
  </script>
  <script src="{{ asset("js/transactions/index.js") }}"></script>
@endpush

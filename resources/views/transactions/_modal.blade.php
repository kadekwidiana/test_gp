<!-- Transaction Modal (Reusable) -->
<div class="modal fade" id="transactionModal" tabindex="-1" aria-labelledby="transactionModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="transactionModalLabel">
          <i class="bi bi-plus-circle me-2" id="modalIcon"></i>
          <span id="modalTitleText">Tambah Transaksi</span>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="transactionForm">
        <input type="hidden" id="transaction_id">
        <div class="modal-body">
          <!-- Type -->
          <div class="mb-3">
            <label for="type" class="form-label">Tipe Transaksi <span class="text-danger">*</span></label>
            <select class="form-select" id="type" name="type" required>
              <option value="">-- Pilih Tipe --</option>
              <option value="income">Pemasukan</option>
              <option value="expense">Pengeluaran</option>
            </select>
            <div class="invalid-feedback" id="error-type"></div>
          </div>

          <!-- Category -->
          <div class="mb-3">
            <label for="category_id" class="form-label">Kategori <span class="text-danger">*</span></label>
            <select class="form-select" id="category_id" name="category_id" required disabled>
              <option value="">-- Pilih Tipe Terlebih Dahulu --</option>
            </select>
            <div class="invalid-feedback" id="error-category_id"></div>
          </div>

          <!-- Amount -->
          <div class="mb-3">
            <label for="amount" class="form-label">Jumlah (Rp) <span class="text-danger">*</span></label>
            <div class="input-group">
              <span class="input-group-text">Rp</span>
              <input type="text" class="form-control" id="amount" name="amount" placeholder="Contoh: 1.000.000"
                required>
            </div>
            <div class="invalid-feedback" id="error-amount"></div>
          </div>

          <!-- Description -->
          <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="2"
              placeholder="Opsional - Keterangan transaksi"></textarea>
            <div class="invalid-feedback" id="error-description"></div>
          </div>

          <!-- Transaction Date -->
          <div class="mb-3">
            <label for="transaction_date" class="form-label">Tanggal <span class="text-danger">*</span></label>
            <input type="date" class="form-control" id="transaction_date" name="transaction_date" required>
            <div class="invalid-feedback" id="error-transaction_date"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary" id="btnSubmit">
            <i class="bi bi-save me-1"></i> Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

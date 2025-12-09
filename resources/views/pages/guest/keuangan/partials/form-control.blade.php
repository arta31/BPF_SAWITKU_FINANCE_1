<div class="mb-4">
    <label class="form-label fw-bold text-secondary small text-uppercase">Tanggal Transaksi</label>
    <div class="input-group shadow-sm">
        <span class="input-group-text bg-white border-end-0 rounded-start-pill ps-3 text-success">
            <i class="fas fa-calendar-alt"></i>
        </span>
        <input type="date" name="tanggal" class="form-control border-start-0 rounded-end-pill py-3" 
               value="{{ old('tanggal', $catatan->tanggal ?? date('Y-m-d')) }}" required>
    </div>
</div>

<div class="mb-4">
    <label class="form-label fw-bold text-secondary small text-uppercase">Jenis Transaksi</label>
    <div class="input-group shadow-sm">
        <span class="input-group-text bg-white border-end-0 rounded-start-pill ps-3 text-success">
            <i class="fas fa-exchange-alt"></i>
        </span>
        <select name="jenis" class="form-select border-start-0 rounded-end-pill py-3" required style="cursor: pointer;">
            <option value="" disabled selected>-- Pilih Jenis --</option>
            <option value="pemasukan" class="text-success fw-bold" {{ (old('jenis', $catatan->jenis ?? '') == 'pemasukan') ? 'selected' : '' }}>
                &#xf062; Pemasukan (Uang Masuk)
            </option>
            <option value="pengeluaran" class="text-danger fw-bold" {{ (old('jenis', $catatan->jenis ?? '') == 'pengeluaran') ? 'selected' : '' }}>
                &#xf063; Pengeluaran (Uang Keluar)
            </option>
        </select>
    </div>
</div>

<div class="mb-4">
    <label class="form-label fw-bold text-secondary small text-uppercase">Keterangan</label>
    <div class="input-group shadow-sm">
        <span class="input-group-text bg-white border-end-0 rounded-start-pill ps-3 text-success">
            <i class="fas fa-align-left"></i>
        </span>
        <input type="text" name="deskripsi" class="form-control border-start-0 rounded-end-pill py-3" 
               placeholder="Contoh: Jual TBS 1 Ton, Beli Pupuk..." 
               value="{{ old('deskripsi', $catatan->deskripsi ?? '') }}" required>
    </div>
</div>

<div class="mb-4">
    <label class="form-label fw-bold text-secondary small text-uppercase">Nominal (Rupiah)</label>
    <div class="input-group shadow-sm">
        <span class="input-group-text bg-success text-white border-0 rounded-start-pill ps-3 fw-bold">
            Rp
        </span>
        <input type="number" name="nominal" class="form-control border-0 rounded-end-pill py-3 bg-light" 
               placeholder="0" 
               value="{{ old('nominal', $catatan->nominal ?? '') }}" required>
    </div>
</div>

<div class="mb-5">
    <label class="form-label fw-bold text-secondary small text-uppercase">Bukti / Nota (Opsional)</label>
    <div class="card border-dashed border-2 bg-light rounded-4 text-center p-3">
        <input type="file" name="bukti" class="form-control" id="fileInput">
        <small class="text-muted mt-2 d-block">Format: JPG, PNG, PDF (Max 2MB)</small>
        
        @if(isset($catatan) && $catatan->bukti)
            <div class="mt-3 p-2 bg-white rounded border d-inline-flex align-items-center gap-2 shadow-sm">
                <i class="fas fa-check-circle text-success"></i>
                <span class="small">File tersimpan.</span>
                <a href="{{ asset('storage/'.$catatan->bukti) }}" target="_blank" class="btn btn-xs btn-outline-primary rounded-pill py-0 px-2" style="font-size: 0.75rem;">Lihat</a>
            </div>
        @endif
    </div>
</div>

<div class="d-grid">
    <button type="submit" class="btn btn-success btn-lg rounded-pill shadow hover-scale fw-bold">
        <i class="fas fa-save me-2"></i> {{ $submit_text }}
    </button>
</div>

<style>
    /* Sedikit CSS tambahan biar makin smooth */
    .form-control:focus, .form-select:focus {
        box-shadow: none;
        border-color: #2E7D32;
    }
    .hover-scale { transition: transform 0.2s; }
    .hover-scale:hover { transform: scale(1.02); }
    .border-dashed { border-style: dashed !important; border-color: #ccc !important; }
</style>
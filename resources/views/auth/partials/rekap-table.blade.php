<div class="rekap-card">
  <div class="rekap-card-header">Tabel Rekapitulasi Jumlah Pemakai</div>
  <div class="rekap-card-body">
    <div class="table-responsive">
      <table class="rekap-table">
        <thead>
          <tr>
            <th>Tahun</th>
            <th>Jan</th><th>Peb</th><th>Mar</th><th>Apr</th><th>Mei</th><th>Jun</th>
            <th>Jul</th><th>Agu</th><th>Sep</th><th>Okt</th><th>Nop</th><th>Des</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          @forelse($rekap as $tahun => $bulan)
            <tr>
              <td class="col-tahun">{{ $tahun }}</td>
              @for($b = 1; $b <= 12; $b++)
                <td>{{ $bulan[$b] ?? 0 }}</td>
              @endfor
              <td class="col-total">{{ array_sum($bulan) }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="14" class="text-center">Belum ada data pemakaian.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
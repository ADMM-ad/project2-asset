@extends('master')
@section('title', 'Daftar Asset')

@section('content')

<!-- CSS KHUSUS UNTUK 1.5 KOLOM (Laptop/Desktop) -->
<style>
    @media (min-width: 768px) {
        .col-md-1-5-custom {
            flex: 0 0 12.5%;     /* 1.5 dari 12 kolom = 12.5% */
            max-width: 12.5%;
        }
    }
    
    /* HP: Tombol jadi 6 kolom (masing-masing 50%) */
    @media (max-width: 767.98px) {
        .col-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }
    }
</style>

<div class="container-fluid py-4">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center mb-4 gap-3">
        <h5 class="mb-0"  style="color: #06b6d4 !important;">  <i class="fas fa-box-open" style="color: #06b6d4 !important;"></i> Daftar Asset</h5>
        <a href="{{ route('assets.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Tambah 
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

   <!-- SEARCH & FILTER -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: var(--radius-lg);">
    <div class="card-body">
        <form method="GET" action="{{ route('assets.index') }}">
            <div class="row g-3 align-items-end">
                
                <!-- No Asset -->
                <div class="col-12 col-md-3">
                    <input type="text" name="no_asset" class="form-control" 
                           placeholder="Cari No Asset..." 
                           value="{{ request('no_asset') }}">
                </div>

                <!-- Nama Asset -->
                <div class="col-12 col-md-3">
                    <input type="text" name="nama_asset" class="form-control" 
                           placeholder="Cari Nama Asset..." 
                           value="{{ request('nama_asset') }}">
                </div>

                <!-- Diinput Oleh -->
                <div class="col-12 col-md-3">
                    <select name="user_id" class="form-select">
                        @foreach($users as $id => $name)
                            <option value="{{ $id }}" {{ request('user_id') == $id ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tombol Cari & Reset (1.5 kolom di laptop) -->
                <div class="col-6 col-md-1-5-custom d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>
                <div class="col-6 col-md-1-5-custom d-flex gap-2">
                    <a href="{{ route('assets.index') }}" class="btn btn-secondary w-100">
                        <i class="fas fa-sync"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>



    <!-- TABEL ASSET -->
    <div class="card border-0 shadow-sm" style="border-radius: var(--radius-lg); overflow:hidden;">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
               <thead class="table-light">
    <tr>
        <th class="text-nowrap" width="4%">No</th>
        <th class="text-nowrap" width="8%">No Asset</th>
        <th class="text-nowrap" width="12%">Nama Asset</th>
        <th class="text-nowrap" width="9%">Kategori</th>
        <th class="text-nowrap" width="9%">Sub Kategori</th>
        <th class="text-nowrap" width="7%">Merek</th>
        <th class="text-nowrap" width="7%">Tipe / Model</th>
        <th class="text-nowrap" width="8%">Nomor Seri</th>
        <th class="text-nowrap" width="5%">Tahun</th>
        <th class="text-nowrap" width="9%">Lokasi</th>
        <th class="text-nowrap" width="9%">Penanggung</th>
        <th class="text-nowrap" width="6%">Kondisi</th>
        <th class="text-nowrap" width="6%">Status</th>
        <th class="text-nowrap" width="9%">Harga</th>
        <th class="text-nowrap" width="9%">Nilai</th>
        <th class="text-nowrap" width="10%">Latitude</th>
        <th class="text-nowrap" width="10%">Longitude</th>
        <th class="text-nowrap" width="9%">Diinput Oleh</th>
        <th class="text-nowrap" width="10%">Update Terakhir</th>
        <th class="text-nowrap text-center">Aksi</th>
    </tr>
</thead>
                <tbody>
    @forelse($assets as $index => $asset)
    <tr>
        <td class="text-center">{{ $assets->firstItem() + $index }}</td>
        <td><strong>{{ $asset->no_asset }}</strong></td>
        <td>
            <span title="{{ $asset->nama_asset }}">{{ Str::limit($asset->nama_asset, 50) }}</span>
        </td>
        <td><span title="{{ $asset->ketagori ?? '-'}} ">{{ Str::limit($asset->ketagori ?? '-', 50) }}</span></td>
        <td><span title="{{ $asset->sub_kategori ?? '-'}}">{{ Str::limit($asset->sub_kategori ?? '-', 50) }}</span></td>
        <td><span title="{{ $asset->merek ?? '-'}}">{{ Str::limit($asset->merek ?? '-', 50) }}</span></td>
        <td><span title="{{ $asset->tipe ?? '-'}}">{{ Str::limit($asset->tipe ?? '-', 50) }}</span></td>
        <td><span title="{{ $asset->nomor ?? '-'}}">{{ Str::limit($asset->nomor ?? '-', 50) }}</span></td>
        <td class="text-center">{{ $asset->tahun ?? '-' }}</td>
        <td><span title="{{ $asset->lokasi ?? '-'}}">{{ Str::limit($asset->lokasi ?? '-', 50) }}</span></td>
        <td><span title="{{ $asset->penanggung ?? '-'}}">{{ Str::limit($asset->penanggung?? '-', 50) }}</span></td>

        <!-- Kondisi & Status → TETAP ADA BATAS 50 -->
        <td>
            <span title="{{ $asset->kondisi ?? '-' }}">
                {{ Str::limit($asset->kondisi ?? '-', 50) }}
            </span>
        </td>
        <td>
            <span title="{{ $asset->status ?? '-' }}">
                {{ Str::limit($asset->status ?? '-', 50) }}
            </span>
        </td>

        <!-- HARGA & NILAI → TANPA BATAS 50 (FULL TAMPIL) -->
        <td>
            <span title="{{ $asset->harga ? 'Rp ' . number_format($asset->harga) : '-' }}">
                {{ $asset->harga ? 'Rp ' . number_format($asset->harga) : '-' }}
            </span>
        </td>
        <td>
            <span title="{{ $asset->nilai ?  number_format($asset->nilai) : '-' }}">
                {{ $asset->nilai ?  number_format($asset->nilai) : '-' }}
            </span>
        </td>

        <!-- Latitude & Longitude → TETAP ADA BATAS 50 -->
        <td class="text-nowrap">
            <span title="{{ $asset->latitude ?? '-' }}">{{ Str::limit($asset->latitude ?? '-', 50) }}</span>
        </td>
        <td class="text-nowrap">
            <span title="{{ $asset->longtitude ?? '-' }}">{{ Str::limit($asset->longtitude ?? '-', 50) }}</span>
        </td>

        <!-- Diinput oleh & Update terakhir -->
        <td>
            <span title="{{ $asset->user->name }}">{{ Str::limit($asset->user->name, 50) }}</span>
        </td>
        <td class="text-nowrap">
            {{ $asset->updated_at->format('d/m/Y H:i') }}
        </td>

        <!-- Aksi -->
     <td class="text-center">
    <div class="btn-group" role="group" style="gap: 6px;">

        <!-- LIHAT DETAIL -->
        <a href="{{ route('assets.show', $asset) }}"
           class="btn btn-sm btn-info text-white d-inline"
           title="Lihat Detail Asset">
             Detail
        </a>

        <!-- EDIT -->
        <a href="{{ route('assets.edit', $asset) }}"
           class="btn btn-sm btn-warning text-white d-inline-flex align-items-center"
           title="Edit Asset">
             Edit
        </a>

        <!-- HAPUS -->
        <button type="button"
                class="btn btn-sm btn-danger text-white d-inline-flex align-items-center"
                onclick="confirmDelete({{ $asset->id }}, '{{ addslashes($asset->no_asset) }}')"
                title="Hapus Asset">
             Hapus
        </button>
    </div>
</td>
    </tr>
    @empty
    <tr>
        <td colspan="20" class="text-center py-5 text-muted">
            Belum ada data asset.
        </td>
    </tr>
    @endforelse
</tbody>
            </table>
        </div>

        <!-- PAGINATION BOOTSTRAP 5 -->
        <div class="card-footer bg-white border-0 py-3">
            {{ $assets->onEachSide(1)->links() }}
        </div>
    </div>
</div>

<!-- SweetAlert2 + Script Delete -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(id, noAsset) {
    Swal.fire({
        title: 'Yakin hapus?',
        html: `Asset <strong>${noAsset}</strong> akan dihapus permanen!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/assets/${id}`;
            form.style.display = 'none';

            const token = document.createElement('input');
            token.name = '_token';
            token.value = '{{ csrf_token() }}';
            form.appendChild(token);

            const method = document.createElement('input');
            method.name = '_method';
            method.value = 'DELETE';
            form.appendChild(method);

            document.body.appendChild(form);
            form.submit();
        }
    });
}
</script>
@endsection
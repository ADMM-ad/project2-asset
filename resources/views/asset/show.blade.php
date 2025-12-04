@extends('master')
@section('title', 'Detail Asset - ' . $asset->no_asset)

@section('content')
<div class="container-fluid py-4">
    
            
                <div class="card-header bg-white border-0">
                  <h5 class="mb-0" style="color: #06b6d4 !important;">
    <i class="fas fa-box-open "></i> Asset <strong>{{ $asset->no_asset }}</strong>
</h5>
                </div>

               <div class="card-body p-4">
                    <div class="row g-4">
                        <!-- Informasi Utama -->
                        <div class="col-lg-6">
                            <h5 class="border-bottom pb-3 mb-4 text-primary" style="color: #06b6d4 !important;">
                                <i class="fas fa-info-circle"style="color: #06b6d4 !important;"></i> Informasi Asset
                            </h5>

                            <table class="table table-borderless">
                                <tr>
                                    <th width="30%">No Asset</th>
                                    <td><strong>{{ $asset->no_asset }}</strong></td>
                                </tr>
                                <tr>
                                    <th>Nama Asset</th>
                                    <td>{{ $asset->nama_asset }}</td>
                                </tr>
                                <tr>
    <th>Kategori</th>
    <td>
        @if($asset->ketagori)
            {{ $asset->ketagori }}
        @else
            <em class="text-muted">Tidak diisi</em>
        @endif
    </td>
</tr>
<tr>
    <th>Sub Kategori</th>
    <td>
        @if($asset->sub_kategori)
            {{ $asset->sub_kategori }}
        @else
            <em class="text-muted">Tidak diisi</em>
        @endif
    </td>
</tr>
<tr>
    <th>Merek</th>
    <td>
        @if($asset->merek)
            {{ $asset->merek }}
        @else
            <em class="text-muted">Tidak diisi</em>
        @endif
    </td>
</tr>
<tr>
    <th>Tipe / Model</th>
    <td>
        @if($asset->tipe)
            {{ $asset->tipe }}
        @else
            <em class="text-muted">Tidak diisi</em>
        @endif
    </td>
</tr>
<tr>
    <th>Nomor Seri</th>
    <td>
        @if($asset->nomor)
            {{ $asset->nomor }}
        @else
            <em class="text-muted">Tidak diisi</em>
        @endif
    </td>
</tr>
<tr>
    <th>Tahun</th>
    <td>
        @if($asset->tahun)
            {{ $asset->tahun }}
        @else
            <em class="text-muted">Tidak diisi</em>
        @endif
    </td>
</tr>
<tr>
    <th>Lokasi</th>
    <td>
        @if($asset->lokasi)
            {{ $asset->lokasi }}
        @else
            <em class="text-muted">Tidak diisi</em>
        @endif
    </td>
</tr>
<tr>
    <th>Penanggung Jawab</th>
    <td>
        @if($asset->penanggung)
            {{ $asset->penanggung }}
        @else
            <em class="text-muted">Tidak diisi</em>
        @endif
    </td>
</tr>
                                <tr>
                                    <th>Kondisi</th>
                                    <td>
                                        @if($asset->kondisi)
                                            {{ $asset->kondisi }}
                                        @else
                                            <em class="text-muted">Tidak diisi</em>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if($asset->status)
                                            {{ $asset->status }}
                                        @else
                                            <em class="text-muted">Tidak diisi</em>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Harga</th>
                                    <td>
                                        @if($asset->harga)
                                            Rp {{ number_format($asset->harga, 0, ',', '.') }}
                                        @else
                                            <em class="text-muted">Tidak diisi</em>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Nilai</th>
                                    <td>
                                        @if($asset->nilai)
                                            Rp {{ number_format($asset->nilai, 0, ',', '.') }}
                                        @else
                                            <em class="text-muted">Tidak diisi</em>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Dibuat oleh</th>
                                    <td>{{ $asset->user->name }} pada ({{ $asset->created_at->format('d/m/Y H:i') }})</td>
                                </tr>
                                <tr>
                                    <th>Update terakhir</th>
                                    <td>{{ $asset->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>

                        <!-- Peta Lokasi -->
                        <div class="col-lg-6">
                            <h5 class="border-bottom pb-3 mb-4 text-primary" style="color: #06b6d4 !important;">
                                <i class="fas fa-map-marker-alt"style="color: #06b6d4 !important;"></i> Lokasi Asset
                            </h5>

                            @if($asset->latitude && $asset->longtitude)
                                <div id="map" style="height: 400px; border-radius: var(--radius-md); overflow:hidden; box-shadow: var(--shadow-md);"></div>

                                <div class="mt-3 text-center">
                                    <small class="text-muted">
                                        Lat: {{ $asset->latitude }} | Long: {{ $asset->longtitude }}
                                    </small>
                                </div>
                            @else
                                <div class="text-center py-5 bg-light rounded" style="border: 2px dashed #ccc;">
                                    <i class="fas fa-map-marked-alt fa-3x text-muted mb-3"></i>
                                    <p class="text-muted mb-0">Lokasi GPS belum diinput</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="mt-5 text-end">
                       
                        <a href="{{ route('assets.index') }}" class="btn btn-secondary">
                            <i class="fas fa-reply"></i> Kembali
                        </a>
                    </div>
                </div>
</div>
        </div>
    </div>
</div>

<!-- Leaflet.js untuk Peta -->
@if($asset->latitude && $asset->longtitude)
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const lat = {{ $asset->latitude }};
    const lng = {{ $asset->longtitude }};

    const map = L.map('map').setView([lat, lng], 16);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    L.marker([lat, lng])
        .addTo(map)
        .bindPopup('<strong>{{ addslashes($asset->nama_asset) }}</strong><br>{{ $asset->no_asset }}')
        .openPopup();

    // Auto adjust map
    map.invalidateSize();
});
</script>
@endif
@endsection
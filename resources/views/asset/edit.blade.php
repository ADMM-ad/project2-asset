@extends('master')
@section('title', 'Edit Asset' )
@section('content')
<div class="container-fluid py-4">
    
            
                <div class="card-header bg-white border-0">
                  <h5 class="mb-0" style="color: #06b6d4 !important;">
    <i class="fas fa-edit me-2"></i> Edit Asset <strong>{{ $asset->no_asset }}</strong>
</h5>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('assets.update', $asset) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <!-- No Asset (readonly) -->
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">No Asset</label>
                                <input type="text" name="no_asset" class="form-control @error('no_asset') is-invalid @enderror"
           value="{{ old('no_asset', $asset->no_asset) }}" required>
    @error('no_asset')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
                            </div>

                            <!-- Nama Asset (wajib) -->
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Nama Asset <span class="text-danger">*</span></label>
                                <input type="text" name="nama_asset" class="form-control @error('nama_asset') is-invalid @enderror"
                                       value="{{ old('nama_asset', $asset->nama_asset) }}" required>
                                @error('nama_asset') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <!-- Field-field lainnya (sama seperti Create) -->
                            <div class="col-md-4"><label class="form-label">Kategori</label><input name="ketagori" class="form-control" value="{{ old('ketagori', $asset->ketagori) }}"></div>
                            <div class="col-md-4"><label class="form-label">Sub Kategori</label><input name="sub_kategori" class="form-control" value="{{ old('sub_kategori', $asset->sub_kategori) }}"></div>
                            <div class="col-md-4"><label class="form-label">Merek</label><input name="merek" class="form-control" value="{{ old('merek', $asset->merek) }}"></div>
                            <div class="col-md-4"><label class="form-label">Tipe / Model</label><input name="tipe" class="form-control" value="{{ old('tipe', $asset->tipe) }}"></div>
                            <div class="col-md-4"><label class="form-label">Nomor Seri</label><input name="nomor" class="form-control" value="{{ old('nomor', $asset->nomor) }}"></div>
                            <div class="col-md-4"><label class="form-label">Tahun</label><input name="tahun" class="form-control" value="{{ old('tahun', $asset->tahun) }}"></div>
                            <div class="col-md-4"><label class="form-label">Lokasi</label><input name="lokasi" class="form-control" value="{{ old('lokasi', $asset->lokasi) }}"></div>
                            <div class="col-md-4"><label class="form-label">Penanggung Jawab</label><input name="penanggung" class="form-control" value="{{ old('penanggung', $asset->penanggung) }}"></div>
                            <div class="col-md-4"><label class="form-label">Kondisi</label><input name="kondisi" class="form-control" value="{{ old('kondisi', $asset->kondisi) }}"></div>
                            <div class="col-md-4"><label class="form-label">Status</label><input name="status" class="form-control" value="{{ old('status', $asset->status) }}"></div>
                            <div class="col-md-6"><label class="form-label">Harga (Rp)</label><input type="number" name="harga" class="form-control" value="{{ old('harga', $asset->harga) }}"></div>
                            <div class="col-md-6"><label class="form-label">Nilai</label><input type="number" name="nilai" class="form-control" value="{{ old('nilai', $asset->nilai) }}"></div>

                            <!-- ==== FITUR UPDATE LOKASI GPS (sama persis dengan Create) ==== -->
                            <div class="col-12">
                                <hr class="my-3">
                                <h5 class="text-primary mb-3" style="color: #06b6d4 !important;">
                                    <i class="fas fa-map-marked-alt me-2"></i> Update Lokasi GPS
                                </h5>

                                <div class="row g-4">
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold">Latitude</label>
                                        <input type="text" id="latitude" name="latitude" class="form-control"
                                               value="{{ old('latitude', $asset->latitude) }}" readonly>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold">Longitude</label>
                                        <input type="text" id="longtitude" name="longtitude" class="form-control"
                                               value="{{ old('longtitude', $asset->longtitude) }}" readonly>
                                    </div>

                                    <!-- Tombol sama persis ukuran & warna dengan Create -->
                                    <div class="col-lg-6">
                                        <button type="button" class="btn btn-success w-100" onclick="getCurrentLocation()">
                                            <i class="fas fa-location-crosshairs"></i> Ambil Lokasi Saat Ini
                                        </button>
                                    </div>
                                    <div class="col-lg-6">
                                        <button type="button" class="btn btn-info text-white w-100"
                                                onclick="document.getElementById('map').scrollIntoView({behavior:'smooth'})">
                                            <i class="fas fa-mouse-pointer"></i> Pilih di Peta
                                        </button>
                                    </div>
                                </div>

                                <!-- Peta Interaktif (style sama dengan Create) -->
                                <div class="mt-4">
                                    <div id="map" style="height: 450px; border-radius: var(--radius-lg); box-shadow: 0 10px 30px rgba(0,0,0,0.15);"></div>
                                    <small class="text-muted d-block text-center mt-2">
                                        Klik di peta untuk memindahkan titik lokasi • Anda bisa geser marker sesuka hati
                                    </small>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol aksi bawah -->
                        <div class="mt-5 text-end">
                            <a href="{{ route('assets.index') }}" class="btn btn-secondary me-2">
                                <i class="fas fa-reply"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Leaflet + SweetAlert -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
let map, marker;
const defaultLat = {{ $asset->latitude ?? -2.5 }};
const defaultLng = {{ $asset->longtitude ?? 118 }};

function initMap() {
    const zoomLevel = {{ $asset->latitude ? 16 : 5 }};
    map = L.map('map').setView([defaultLat, defaultLng], zoomLevel);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Kalau sudah ada koordinat → langsung tampilkan marker
    if ({{ $asset->latitude ? 'true' : 'false' }}) {
        addMarker(defaultLat, defaultLng);
    }

    // Event klik peta
    map.on('click', function(e) {
        const lat = e.latlng.lat.toFixed(8);
        const lng = e.latlng.lng.toFixed(8);
        document.getElementById('latitude').value = lat;
        document.getElementById('longtitude').value = lng;
        if (marker) map.removeLayer(marker);
        addMarker(lat, lng);
    });
}

function addMarker(lat, lng) {
    marker = L.marker([lat, lng], { draggable: true }).addTo(map)
        .bindPopup('Lokasi Asset<br><b>{{ $asset->no_asset }}</b>').openPopup();

    marker.on('dragend', function() {
        const pos = marker.getLatLng();
        document.getElementById('latitude').value = pos.lat.toFixed(8);
        document.getElementById('longtitude').value = pos.lng.toFixed(8);
    });
}

function getCurrentLocation() {
    if (!navigator.geolocation) {
        Swal.fire('Error', 'Browser tidak mendukung Geolocation', 'error');
        return;
    }
    Swal.fire({
        title: 'Mengambil lokasi GPS...',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });

    navigator.geolocation.getCurrentPosition(pos => {
        const lat = pos.coords.latitude.toFixed(8);
        const lng = pos.coords.longitude.toFixed(8);
        document.getElementById('latitude').value = lat;
        document.getElementById('longtitude').value = lng;
        map.setView([lat, lng], 16);
        if (marker) map.removeLayer(marker);
        addMarker(lat, lng);
        Swal.fire('Berhasil!', 'Lokasi GPS berhasil diambil', 'success');
    }, err => {
        Swal.fire('Gagal', 'Tidak dapat mengambil lokasi: ' + err.message, 'error');
    });
}

// Init saat halaman selesai load
document.addEventListener('DOMContentLoaded', initMap);
</script>
@endsection
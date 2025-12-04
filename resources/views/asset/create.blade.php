@extends('master')
@section('title', 'Tambah Asset Baru')

@section('content')
<div class="container-fluid py-4">
    
            
                <div class="card-header bg-white border-0">
                  <h5 class="mb-0" style="color: #06b6d4 !important;">
    <i class="fas fa-plus-circle "></i> Tambah Asset Baru
</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('assets.store') }}" method="POST">
                        @csrf
                        <div class="row g-4">
                            <!-- Semua field biasa (sama seperti sebelumnya) -->
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Nama Asset <span class="text-danger">*</span></label>
                                <input type="text" name="nama_asset" class="form-control @error('nama_asset') is-invalid @enderror"
                                       value="{{ old('nama_asset') }}" required>
                                @error('nama_asset') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-4"><label>Kategori</label><input name="ketagori" class="form-control" value="{{ old('ketagori') }}"></div>
                            <div class="col-md-4"><label>Sub Kategori</label><input name="sub_kategori" class="form-control" value="{{ old('sub_kategori') }}"></div>
                            <div class="col-md-4"><label>Merek</label><input name="merek" class="form-control" value="{{ old('merek') }}"></div>
                            <div class="col-md-4"><label>Tipe / Model</label><input name="tipe" class="form-control" value="{{ old('tipe') }}"></div>
                            <div class="col-md-4"><label>Nomor Seri</label><input name="nomor" class="form-control" value="{{ old('nomor') }}"></div>
                            <div class="col-md-4"><label>Tahun</label><input name="tahun" class="form-control" value="{{ old('tahun') }}"></div>
                            <div class="col-md-4"><label>Lokasi</label><input name="lokasi" class="form-control" value="{{ old('lokasi') }}"></div>
                            <div class="col-md-4"><label>Penanggung Jawab</label><input name="penanggung" class="form-control" value="{{ old('penanggung') }}"></div>
                            <div class="col-md-4"><label>Kondisi</label><input name="kondisi" class="form-control" value="{{ old('kondisi') }}"></div>
                            <div class="col-md-4"><label>Status</label><input name="status" class="form-control" value="{{ old('status') }}"></div>
                            <div class="col-md-6"><label>Harga (Rp)</label><input type="number" name="harga" class="form-control" value="{{ old('harga') }}"></div>
                            <div class="col-md-6"><label>Nilai</label><input type="number" name="nilai" class="form-control" value="{{ old('nilai') }}"></div>

                            <!-- === FITUR GPS BARU: 2 PILIHAN + PETA INTERAKTIF === -->
                            <div class="col-12">
                                <hr class="my-3">
                                <h5 class="text-primary mb-3"  style="color: #06b6d4 !important;">
                                    <i class="fas fa-map-marked-alt me-2"></i> Tentukan Lokasi Asset
                                </h5>

                                <div class="row g-4">
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold">Latitude</label>
                                        <input type="text" id="latitude" name="latitude" class="form-control" value="{{ old('latitude') }}" readonly>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold">Longitude</label>
                                        <input type="text" id="longtitude" name="longtitude" class="form-control" value="{{ old('longtitude') }}" readonly>
                                    </div>

                                    <!-- Tombol Pilihan -->
                                    <div class="col-lg-6">
                                        <button type="button" class="btn btn-success  w-100" onclick="getCurrentLocation()">
                                            <i class="fas fa-location-crosshairs"></i> Ambil Lokasi Saat Ini
                                        </button>
                                    </div>
                                    <div class="col-lg-6">
                                        <button type="button" class="btn btn-info text-white  w-100" onclick="document.getElementById('map').scrollIntoView({behavior:'smooth'})">
                                            <i class="fas fa-mouse-pointer"></i> Pilih di Peta
                                        </button>
                                    </div>
                                </div>

                                <!-- PETA INTERAKTIF -->
                                <div class="mt-4">
                                    <div id="map" style="height: 450px; border-radius: var(--radius-lg); box-shadow: 0 10px 30px rgba(0,0,0,0.15);"></div>
                                    <small class="text-muted d-block text-center mt-2">
                                        Klik di peta untuk memilih lokasi • Anda bisa geser marker sesuka hati
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 text-end">
                            <a href="{{ route('assets.index') }}" class="btn btn-secondary me-2">
                                <i class="fas fa-reply"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Leaflet.js -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Variabel global
let map, marker;

// Inisialisasi peta (default: Indonesia)
function initMap(lat = -2.5, lng = 118, zoom = 5) {
    map = L.map('map').setView([lat, lng], zoom);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Event klik peta
    map.on('click', function(e) {
        const lat = e.latlng.lat.toFixed(8);
        const lng = e.latlng.lng.toFixed(8);
        updateLocation(lat, lng);
    });
}

// Update input + marker
function updateLocation(lat, lng) {
    document.getElementById('latitude').value = lat;
    document.getElementById('longtitude').value = lng;

    if (marker) map.removeLayer(marker);
    marker = L.marker([lat, lng], { draggable: true }).addTo(map)
        .bindPopup('Lokasi Asset<br><b>Baru</b>').openPopup();

    marker.on('dragend', function() {
        const pos = marker.getLatLng();
        document.getElementById('latitude').value = pos.lat.toFixed(8);
        document.getElementById('longtitude').value = pos.lng.toFixed(8);
    });

    map.setView([lat, lng], 16);
}

// Ambil lokasi saat ini
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
        updateLocation(lat, lng);
        Swal.fire('Berhasil!', 'Lokasi GPS berhasil diambil', 'success');
    }, err => {
        Swal.fire('Gagal', 'Tidak dapat mengambil lokasi: ' + err.message, 'error');
        // Kalau gagal → tetap buka peta Indonesia
        initMap();
    });
}

// Jalankan saat halaman dibuka
document.addEventListener('DOMContentLoaded', function() {
    // Coba ambil lokasi otomatis dulu
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(pos => {
            initMap(pos.coords.latitude, pos.coords.longitude, 16);
            updateLocation(pos.coords.latitude.toFixed(8), pos.coords.longitude.toFixed(8));
        }, () => {
            // Kalau gagal / ditolak → buka peta Indonesia
            initMap();
            Swal.fire({
                icon: 'info',
                title: 'Lokasi tidak tersedia',
                text: 'Silakan klik peta untuk memilih lokasi asset',
                timer: 3000
            });
        });
    } else {
        initMap();
    }
});
</script>
@endsection
@extends('master')
@section('title', 'Profil Saya')
@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mx-4 mt-4">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card-body p-5">
                    <div class="text-center mb-5">
                        <!-- Avatar dengan warna cyan -->
                        <div class="avatar d-inline-flex align-items-center justify-content-center rounded-circle mb-4"
                             style="width: 130px; height: 130px; background: linear-gradient(135deg, #06b6d4, #0891b2); font-size: 3.5rem; box-shadow: 0 10px 30px rgba(6, 182, 212, 0.3);">
                            <i class="fas fa-user text-white"></i>
                        </div>
                        
                        <h3 class="mb-1" style="color: #06b6d4 !important; font-weight: 600;">
                            {{ Auth::user()->name }}
                        </h3>
                        <p class="text-muted mb-0">
                            Username: <strong style="color: #06b6d4;">{{ Auth::user()->username }}</strong>
                        </p>
                    </div>

                    <hr class="my-5" style="border-color: #06b6d4 !important;">

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-id-card" style="color: #06b6d4 !important; font-size: 1.8rem;"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <small class="text-muted text-uppercase fw-semibold">User ID</small>
                                    <p class="mb-0 fw-bold fs-5" style="color: #06b6d4 !important;">
                                        #{{ Auth::user()->id }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-calendar-alt" style="color: #06b6d4 !important; font-size: 1.8rem;"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <small class="text-muted text-uppercase fw-semibold">Bergabung Sejak</small>
                                    <p class="mb-0 fw-bold fs-5" style="color: #06b6d4 !important;">
                                        {{ Auth::user()->created_at->translatedFormat('d F Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-5">
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary px-5 py-3"
                           style="background-color: #06b6d4 !important; border-color: #06b6d4 !important;">
                            <i class="fas fa-edit me-2"></i> Edit Profil
                        </a>
                        
                       
                    </div>
                </div>
            </div>
       
    </div>
</div>
@endsection
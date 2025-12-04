<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssetController extends Controller
{
    public function index(Request $request)
{
    $query = Asset::with('user');

    // 1. Pencarian No Asset
    if ($request->filled('no_asset')) {
        $query->where('no_asset', 'like', '%' . $request->no_asset . '%');
    }

    // 2. Pencarian Nama Asset
    if ($request->filled('nama_asset')) {
        $query->where('nama_asset', 'like', '%' . $request->nama_asset . '%');
    }

    // 3. Filter oleh User (diinput oleh)
    if ($request->filled('user_id') && $request->user_id != '') {
        $query->where('user_id', $request->user_id);
    }

    // 4. Urutkan dari data terlama (created_at ASC)
    $query->oldest('created_at');

    // 5. Pagination Bootstrap 5
    $assets = $query->paginate(250)->withQueryString();

    // 6. Ambil semua user untuk dropdown filter
    $users = User::orderBy('name')->pluck('name', 'id')->prepend('Semua Penginput', '');

    return view('asset.index', compact('assets', 'users'));
}

    public function create()
    {
        return view('asset.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_asset' => 'required|string|max:255',
            'ketagori'   => 'nullable|string|max:100',
            'sub_kategori' => 'nullable|string|max:100',
            'merek'      => 'nullable|string|max:100',
            'tipe'       => 'nullable|string|max:100',
            'nomor'      => 'nullable|string|max:100',
            'tahun'      => 'nullable|string|max:4',
            'lokasi'     => 'nullable|string|max:255',
            'penanggung' => 'nullable|string|max:100',
            'kondisi'    => 'nullable|string|max:50',
            'status'     => 'nullable|string|max:50',
            'harga'      => 'nullable|integer|min:0',
            'nilai'      => 'nullable|integer|min:0',
        ]);

        // Ambil ID terakhir untuk bikin no_asset
        $last = Asset::latest('id')->first();
        $nextId = $last ? $last->id + 1 : 1;
        $noAsset = 'A' . str_pad($nextId, 3, '0', STR_PAD_LEFT); // A001, A002, ..., A999, A1000

        Asset::create([
            'user_id'     => Auth::id(),
            'no_asset'    => $noAsset,
            'nama_asset'  => $request->nama_asset,
            'ketagori'    => $request->ketagori,
            'sub_kategori'=> $request->sub_kategori,
            'merek'       => $request->merek,
            'tipe'        => $request->tipe,
            'nomor'       => $request->nomor,
            'tahun'       => $request->tahun,
            'lokasi'      => $request->lokasi,
            'penanggung'  => $request->penanggung,
            'kondisi'     => $request->kondisi,
            'status'      => $request->status,
            'harga'       => $request->harga,
            'nilai'       => $request->nilai,
            'latitude'    => $request->latitude,
            'longtitude'  => $request->longtitude,
        ]);

        return redirect()
            ->route('assets.index')
            ->with('success', 'Asset berhasil ditambahkan dengan nomor: ' . $noAsset);
    }


public function edit(Asset $asset)
{
    // Otomatis policy: hanya user yang punya asset ini yang boleh edit
    // atau kalau semua admin boleh, skip aja
    return view('asset.edit', compact('asset'));
}

public function update(Request $request, Asset $asset)
{
    $request->validate([
        'no_asset'   => 'required|string|max:255',
        'nama_asset' => 'required|string|max:255',
        'ketagori'   => 'nullable|string|max:100',
        'sub_kategori' => 'nullable|string|max:100',
        'merek'      => 'nullable|string|max:100',
        'tipe'       => 'nullable|string|max:100',
        'nomor'      => 'nullable|string|max:100',
        'tahun'      => 'nullable|string|max:4',
        'lokasi'     => 'nullable|string|max:255',
        'penanggung' => 'nullable|string|max:100',
        'kondisi'    => 'nullable|string|max:50',
        'status'     => 'nullable|string|max:50',
        'harga'      => 'nullable|integer|min:0',
        'nilai'      => 'nullable|integer|min:0',
    ]);

    $asset->update([
        'no_asset'     => $request->no_asset,
        'nama_asset'   => $request->nama_asset,
        'ketagori'     => $request->ketagori,
        'sub_kategori' => $request->sub_kategori,
        'merek'        => $request->merek,
        'tipe'         => $request->tipe,
        'nomor'        => $request->nomor,
        'tahun'        => $request->tahun,
        'lokasi'       => $request->lokasi,
        'penanggung'   => $request->penanggung,
        'kondisi'      => $request->kondisi,
        'status'       => $request->status,
        'harga'        => $request->harga,
        'nilai'        => $request->nilai,
        'latitude'     => $request->latitude,
        'longtitude'   => $request->longtitude,
        // no_asset & user_id TIDAK DIUBAH!
    ]);

    return redirect()
        ->route('assets.index')
        ->with('success', 'Asset berhasil diperbarui!');
}
public function destroy(Asset $asset)
{
    $asset->delete();

    return redirect()
        ->route('assets.index')
        ->with('success', 'Asset ' . $asset->no_asset . ' berhasil dihapus!');
}

public function show(Asset $asset)
{
    return view('asset.show', compact('asset'));
}
}

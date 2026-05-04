<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengurus;
use App\Models\Organisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengurusController extends Controller
{
    public function index()
    {
        $pengurus = Pengurus::with('organisasi')->latest()->get();

        $columns = [
            ['key' => 'nama',        'label' => 'Nama',        'sortable' => true],
            ['key' => 'organisasi',  'label' => 'Organisasi',  'sortable' => true],
            ['key' => 'jabatan',     'label' => 'Jabatan',     'sortable' => false],
            ['key' => 'bidang',      'label' => 'Bidang',      'sortable' => false],
            ['key' => 'level',       'label' => 'Level',       'sortable' => true],
            ['key' => 'is_active',   'label' => 'Status',      'sortable' => true],
        ];

        $rows = $pengurus->map(fn($p) => [
            'id'         => (string) $p->id,
            'nama'       => $p->nama,
            'organisasi' => $p->organisasi?->nama ?? '—',
            'jabatan'    => $p->jabatan,
            'bidang'     => $p->bidang ?? '—',
            'level'      => $p->level,
            'foto'       => $p->foto ? asset('storage/' . $p->foto) : null,
            'is_active'  => $p->is_active,
        ])->toArray();

        return view('pages.admin.pengurus.index', compact('columns', 'rows', 'pengurus'));
    }

    public function create()
    {
        // Kirim daftar organisasi buat dropdown pilihan
        $organisasis = Organisasi::aktif()->orderBy('nama')->get();
        return view('pages.admin.pengurus.create', compact('organisasis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'organisasi_otonom_id' => 'required|exists:organisasi_otonom,id',
            'nama'                 => 'required|string|max:200',
            'jabatan'              => 'required|string|max:100',
            'level'                => 'required|in:inti,majelis,lembaga',
            'bidang'               => 'nullable|string|max:100',
            'foto'                 => 'nullable|image|mimes:png,jpg|max:2048',
            'no_hp'                => 'nullable|string|max:20',
            'email'                => 'nullable|email|max:100',
            'periode_mulai'        => 'required|digits:4',
            'periode_selesai'      => 'required|digits:4',
            'urutan'               => 'nullable|integer|min:0',
            'is_active'            => 'boolean',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('pengurus', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['urutan']    = $validated['urutan'] ?? 0;

        Pengurus::create($validated);

        return redirect()
            ->route('admin.pengurus.index')
            ->with('success', 'Pengurus berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $pengurus    = Pengurus::findOrFail($id);
        $organisasis = Organisasi::aktif()->orderBy('nama')->get();
        return view('pages.admin.pengurus.edit', compact('pengurus', 'organisasis'));
    }

    public function update(Request $request, string $id)
    {
        $pengurus = Pengurus::findOrFail($id);

        $validated = $request->validate([
            'organisasi_otonom_id' => 'required|exists:organisasi_otonom,id',
            'nama'                 => 'required|string|max:200',
            'jabatan'              => 'required|string|max:100',
            'level'                => 'required|in:inti,majelis,lembaga',
            'bidang'               => 'nullable|string|max:100',
            'foto'                 => 'nullable|image|mimes:png,jpg|max:2048',
            'no_hp'                => 'nullable|string|max:20',
            'email'                => 'nullable|email|max:100',
            'periode_mulai'        => 'required|digits:4',
            'periode_selesai'      => 'required|digits:4',
            'urutan'               => 'nullable|integer|min:0',
            'is_active'            => 'boolean',
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama kalau ada
            if ($pengurus->foto && Storage::disk('public')->exists($pengurus->foto)) {
                Storage::disk('public')->delete($pengurus->foto);
            }
            $validated['foto'] = $request->file('foto')->store('pengurus', 'public');
        } else {
            $validated['foto'] = $pengurus->foto;
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['urutan']    = $validated['urutan'] ?? $pengurus->urutan;

        $pengurus->update($validated);

        return redirect()
            ->route('admin.pengurus.index')
            ->with('success', 'Data pengurus berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        try {
            $pengurus = Pengurus::findOrFail($id);

            if ($pengurus->foto && Storage::disk('public')->exists($pengurus->foto)) {
                Storage::disk('public')->delete($pengurus->foto);
            }

            $pengurus->delete();

            return response()->json([
                'success' => true,
                'message' => 'Pengurus berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data',
            ], 500);
        }
    }
}

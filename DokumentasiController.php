<?php

namespace App\Http\Controllers;

use App\Models\Activ_FotokatarModels;
use Illuminate\Http\Request;
use App\Models\Activ_FotopkkModels;
use Illuminate\Support\Facades\Storage;

class DokumentasiController extends Controller
{
    public function indexpkk()
    {
        $dokumentasi = Activ_FotopkkModels::latest()->get();
        return view('pkk.dokumentasipkk', compact('dokumentasi'));
    }

    public function store_pkk(Request $request)
    {
        $request->validate([
            'fotopkk' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'caption' => 'nullable|string|max:255',
        ]);

        // Simpan file ke storage/app/public/fotopkk
        $path = $request->file('fotopkk')->store('fotopkk', 'public');

        // Simpan ke database
        Activ_FotopkkModels::create([
            'fotopkk' => $path,
            'caption' => $request->caption,
        ]);

        return redirect()->back()->with('success', 'Dokumentasi berhasil ditambahkan!');
    }

    public function update_pkk(Request $request, $id)
    {
        $request->validate([
            'fotopkk' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'caption' => 'nullable|string|max:255',
        ]);

        $foto = Activ_FotopkkModels::findOrFail($id);

        $data = [
            'caption' => $request->caption,
        ];

        if ($request->hasFile('fotopkk')) {
            Storage::disk('public')->delete($foto->fotopkk);
            $path = $request->file('fotopkk')->store('fotopkk', 'public');
            $data['fotopkk'] = $path;
        }

        $foto->update($data);

        return redirect()->back()->with('success', 'Dokumentasi berhasil diperbarui.');
    }

    public function destroy_pkk($id)
    {
        $foto = Activ_FotopkkModels::findOrFail($id);
        Storage::disk('public')->delete($foto->fotopkk);
        $foto->delete();

        return redirect()->back()->with('success', 'Dokumentasi berhasil dihapus.');
    }

    public function indexkatar()
    {
        $dokumentasi = Activ_FotokatarModels::latest()->get();
        return view('katar.dokumentasikatar', compact('dokumentasi'));
    }

    public function store_katar(Request $request)
    {
        $request->validate([
            'fotokatar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'caption' => 'nullable|string|max:255',
        ]);

        // Simpan file ke storage/app/public/fotokatar
        $path = $request->file('fotokatar')->store('fotokatar', 'public');

        // Simpan ke database
        Activ_FotokatarModels::create([
            'fotokatar' => $path,
            'caption' => $request->caption,
        ]);

        return redirect()->back()->with('success', 'Dokumentasi berhasil ditambahkan!');
    }

    public function update_katar(Request $request, $id)
    {
        $request->validate([
            'fotokatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'caption' => 'nullable|string|max:255',
        ]);

        $foto = Activ_FotokatarModels::findOrFail($id);

        $data = [
            'caption' => $request->caption,
        ];

        if ($request->hasFile('fotokatar')) {
            Storage::disk('public')->delete($foto->fotokatar);
            $path = $request->file('fotokatar')->store('fotokatar', 'public');
            $data['fotokatar'] = $path;
        }

        $foto->update($data);

        return redirect()->back()->with('success', 'Dokumentasi berhasil diperbarui.');
    }

    public function destroy_katar($id)
    {
        $foto = Activ_FotokatarModels::findOrFail($id);
        Storage::disk('public')->delete($foto->fotokatar);
        $foto->delete();

        return redirect()->back()->with('success', 'Dokumentasi berhasil dihapus.');
    }
}

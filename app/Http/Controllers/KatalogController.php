<?php

namespace App\Http\Controllers;

use App\Models\KatalogModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KatalogController extends Controller
{
    //for show home landing
    public function katalog()
    {
        $katalog = KatalogModels::orderBy('created_at', 'desc')->get();
        $all_categories = $katalog->pluck('kategori')->unique();
        return view('/katalog', compact('katalog', 'all_categories'));
    }

    public function detail_katalog($id) // 1. Terima $id dari Route
    {
        $katalog = KatalogModels::with('fotoProduk')->findOrFail($id);
        // $all_categories = $katalog->pluck('kategori')->unique(); 
        return view('detail_katalog', compact('katalog'));
    }

    public function index()
    {
        // Ambil semua data dari tabel katalog_pkk
        $katalog = KatalogModels::orderBy('created_at', 'desc')->get();
        // Kembalikan ke view (contoh: resources/views/katalog/index.blade.php)
        return view('pkk.katalog', compact('katalog'));
    }

    public function store_pkk(Request $request)
    {
        // 1️⃣ Validasi data input
        $validated = $request->validate([
            'nama_produk'      => 'required|string|max:255',
            'deskripsi'        => 'required|string',
            'stok'             => 'required|integer|min:0',
            'harga'            => 'required|numeric|min:0',
            'kategori'         => 'required|string|max:255',
            'kategori_lainnya' => 'nullable|string|max:255',
            'nama_penjual'     => 'required|string|max:255',
            'kontak_penjual'   => 'required|string|max:30',
            'alamat_penjual'   => 'required|string|max:255',

            'foto'              => 'required|array|max:3', // Harus array, maks 3 file
            'foto.*'            => 'required|image|mimes:jpg,jpeg,png|max:2048', // Validasi tiap file

            'link_whatsapp'    => 'nullable|url',
            'link_instagram'   => 'nullable|url',
            'link_tiktok'      => 'nullable|url',
            'link_tokopedia'   => 'nullable|url',
            'link_shopee'      => 'nullable|url',
            'link_facebook'    => 'nullable|url',
        ]);

        // 2️⃣ Tentukan kategori final (jika "Lainnya" maka ambil input kategori_lainnya)
        $kategoriFinal = $validated['kategori'] === 'Lainnya' && !empty($validated['kategori_lainnya'])
            ? $validated['kategori_lainnya']
            : $validated['kategori'];

        // 3️⃣ Simpan foto ke storage/public/katalog
        // $fotoPath = $request->file('foto')->store('katalog', 'public');

        // 4️⃣ Simpan data ke database
        $produk = KatalogModels::create([
            'nama_produk'    => $validated['nama_produk'],
            'deskripsi'      => $validated['deskripsi'],
            'stok'           => $validated['stok'],
            'harga'          => $validated['harga'],
            'kategori'       => $kategoriFinal,
            // 'foto'           => $fotoPath,
            'nama_penjual'   => $validated['nama_penjual'],
            'kontak_penjual' => $validated['kontak_penjual'],
            'alamat_penjual' => $validated['alamat_penjual'],

            // Link sosial media & e-commerce
            'link_whatsapp'  => $validated['link_whatsapp'] ?? null,
            'link_instagram' => $validated['link_instagram'] ?? null,
            'link_tiktok'    => $validated['link_tiktok'] ?? null,
            'link_tokopedia' => $validated['link_tokopedia'] ?? null,
            'link_shopee'    => $validated['link_shopee'] ?? null,
            'link_facebook'  => $validated['link_facebook'] ?? null,

            // Status default
            'status_stock'   => 'tersedia',
            'status'         => 'aktif',
        ]);

        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                // Simpan foto ke storage/public/katalog
                $fotoPath = $file->store('katalog', 'public');
                $produk->fotoProduk()->create([
                    'path_foto' => $fotoPath
                ]);
            }
        }

        // 5️⃣ Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }

    public function update_pkk(Request $request, $id)
    {
        // 1️⃣ Validasi input (diubah untuk multiple foto)
        $validated = $request->validate([
            'nama_produk'       => 'required|string|max:255',
            'deskripsi'         => 'required|string',
            'stok'              => 'required|integer|min:0',
            'harga'             => 'required|numeric|min:0',
            'kategori'          => 'required|string|max:255',
            'kategori_lainnya'  => 'nullable|string|max:255',
            'nama_penjual'      => 'required|string|max:255',
            'kontak_penjual'    => 'required|string|max:30',
            'alamat_penjual'    => 'required|string|max:255',

            // Validasi untuk multiple foto (nullable, tapi jika ada, maks 3)
            'foto'              => 'nullable|array|max:3',
            'foto.*'            => 'required|image|mimes:jpg,jpeg,png|max:2048', // Validasi tiap file

            'link_whatsapp'     => 'nullable|url',
            'link_instagram'    => 'nullable|url',
            'link_tiktok'       => 'nullable|url',
            'link_tokopedia'    => 'nullable|url',
            'link_shopee'       => 'nullable|url',
            'link_facebook'     => 'nullable|url',
        ]);

        // 2️⃣ Ambil data katalog berdasarkan ID
        $katalog = KatalogModels::findOrFail($id);

        // 3️⃣ Tentukan kategori akhir
        $kategoriFinal = $validated['kategori'] === 'Lainnya' && !empty($validated['kategori_lainnya'])
            ? $validated['kategori_lainnya']
            : $validated['kategori'];

        // 4️⃣ Update data TEKS-nya dulu
        $katalog->update([
            'nama_produk'       => $validated['nama_produk'],
            'deskripsi'         => $validated['deskripsi'],
            'stok'              => $validated['stok'],
            'harga'             => $validated['harga'],
            'kategori'          => $kategoriFinal,
            'nama_penjual'      => $validated['nama_penjual'],
            'kontak_penjual'    => $validated['kontak_penjual'],
            'alamat_penjual'    => $validated['alamat_penjual'],
            'link_whatsapp'     => $validated['link_whatsapp'] ?? null,
            'link_instagram'    => $validated['link_instagram'] ?? null,
            'link_tiktok'       => $validated['link_tiktok'] ?? null,
            'link_tokopedia'    => $validated['link_tokopedia'] ?? null,
            'link_shopee'       => $validated['link_shopee'] ?? null,
            'link_facebook'     => $validated['link_facebook'] ?? null,
            // Kolom 'foto' sudah tidak ada di sini
        ]);

        // 5️⃣ Proses FOTO (Jika ada foto baru yang di-upload)
        if ($request->hasFile('foto')) {

            // 5a. Hapus semua foto lama dari STORAGE
            foreach ($katalog->fotoProduk as $fotoLama) {
                Storage::delete('public/' . $fotoLama->path_foto);
            }

            // 5b. Hapus semua record foto lama dari DATABASE
            $katalog->fotoProduk()->delete();

            // 5c. Upload dan simpan foto-foto BARU
            foreach ($request->file('foto') as $file) {
                $fotoPath = $file->store('katalog', 'public');

                // Buat record baru di tabel 'fotokatalog'
                $katalog->fotoProduk()->create([
                    'path_foto' => $fotoPath
                ]);
            }
        }

        // 6️⃣ Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data katalog berhasil diperbarui!');
    }

    public function destroy_pkk($id)
    {
        $katalog = KatalogModels::findOrFail($id);
        if ($katalog->foto && Storage::disk('public')->exists($katalog->foto)) {
            Storage::disk('public')->delete($katalog->foto);
        }
        $katalog->delete();
        return redirect()->back()->with('success', 'Data katalog berhasil dihapus!');
    }
}

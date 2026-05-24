<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            switch ($user->role) {
                case 'Ketua':
                    return $this->dashboardKetua($request);

                case 'Wakil':
                    return $this->dashboardWakil($request);

                case 'Bendahara':
                    return $this->dashboardBendahara($request);

                case 'Sekretaris':
                    return $this->dashboardSekretaris();

                case 'Pokja_1':
                    return $this->dashboardPokja_1($request);

                case 'Pokja_2':
                    return $this->dashboardPokja_2($request);

                case 'Pokja_3':
                    return $this->dashboardPokja_3($request);

                case 'Pokja_4':
                    return $this->dashboardPokja_4($request);

                case 'Admin':
                    return $this->dashboardAdmin($request);

                default:
                    return redirect('/login');
            }
        }
        return redirect('/login');
    }

    private function dashboardKetua(Request $request)
    {
        return view('ketua.dashboard');
    }

    private function dashboardWakil(Request $request)
    {
        return view('wakil.dashboard');
    }

    private function dashboardBendahara(Request $request)
    {
        return view('bendahara.dashboard');
    }

    private function dashboardSekretaris()
    {
        return view('sekretaris/dashboard');
    }

    private function dashboardPokja_1(Request $request)
    {
        return view('pokja_1.dashboard');
    }

    private function dashboardPokja_2(Request $request)
    {
        return view('pokja_2.dashboard');
    }

    private function dashboardPokja_3(Request $request)
    {
        return view('pokja_3.dashboard');
    }

    private function dashboardPokja_4(Request $request)
    {
        return view('pokja_4.dashboard');
    }

    private function dashboardAdmin(Request $request)
    {
        $query = \App\Models\KatalogModels::with('fotoProduk');

        // 1. Filter Pencarian Nama/Deskripsi/Penjual
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_produk', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('nama_penjual', 'like', "%{$search}%");
            });
        }

        // 2. Filter Kategori
        $current_categories = $request->input('kategori', []);
        // Hapus value kosong dari array filter
        $current_categories = array_filter($current_categories, fn($val) => $val !== '');
        if (!empty($current_categories)) {
            $query->whereIn('kategori', $current_categories);
        }

        // 3. Filter Rentang Harga
        $current_price_range = $request->input('price_range');
        if ($request->filled('price_range')) {
            if ($current_price_range === '0-50000') {
                $query->where('harga', '<=', 50000);
            } elseif ($current_price_range === '50000-100000') {
                $query->whereBetween('harga', [50000, 100000]);
            } elseif ($current_price_range === '100000-200000') {
                $query->whereBetween('harga', [100000, 200000]);
            } elseif ($current_price_range === '200000-above') {
                $query->where('harga', '>=', 200000);
            }
        }

        // 4. Sorting / Pengurutan
        $current_sort = $request->input('sort', 'created_at_desc');
        if ($current_sort === 'price_desc') {
            $query->orderBy('harga', 'desc');
        } elseif ($current_sort === 'price_asc') {
            $query->orderBy('harga', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $produks = $query->get();
        $all_categories = \App\Models\KatalogModels::pluck('kategori')->unique();

        $price_ranges = [
            ['label' => 'Under Rp. 50.000', 'value' => '0-50000'],
            ['label' => 'Rp. 50.000 - Rp. 100.000', 'value' => '50000-100000'],
            ['label' => 'Rp. 100.000 - Rp. 200.000', 'value' => '100000-200000'],
            ['label' => 'Above Rp. 200.000', 'value' => '200000-above'],
        ];

        return view('admin.dashboard', compact(
            'produks',
            'all_categories',
            'price_ranges',
            'current_categories',
            'current_price_range',
            'current_sort'
        ));
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\DaftarAnggotaModels;


class HomeController extends Controller
{
    public function HomeLanding()
    {
        return view('landing');
    }

    public function profil()
    {
        $guards = ['ketua', 'wakil', 'bendahara', 'sekretaris', 'pokja_1', 'pokja_2', 'pokja_3', 'pokja_4'];
        $user = null;
        foreach ($guards as $guard) {
            if (\Illuminate\Support\Facades\Auth::guard($guard)->check()) {
                $user = \Illuminate\Support\Facades\Auth::guard($guard)->user();
                break;
            }
        }

        if (!$user) {
            return redirect()->route('profil');
        }

        $anggota = DaftarAnggotaModels::where('id_users', $user->id)->first();

        $layout = 'admin-temp.layout_sekretaris';
        if ($user->role == 'Pokja_1') {
            $layout = 'admin-temp.layout_pokja_1';
        } elseif ($user->role == 'Pokja_2') {
            $layout = 'admin-temp.layout_pokja_2';
        } elseif ($user->role == 'Pokja_3') {
            $layout = 'admin-temp.layout_pokja_3';
        } elseif ($user->role == 'Pokja_4') {
            $layout = 'admin-temp.layout_pokja_4';
        } elseif ($user->role == 'Ketua') {
            $layout = 'admin-temp.layout_ketua';
        } elseif ($user->role == 'Wakil') {
            $layout = 'admin-temp.layout_wakil';
        } elseif ($user->role == 'Bendahara') {
            $layout = 'admin-temp.layout_bendahara';
        }

        return view('profil', compact('user', 'anggota', 'layout'));
    }
    public function struktural()
    {
        $ketua = DaftarAnggotaModels::where('role_pkk', 'Ketua')->first();
        $wakil = DaftarAnggotaModels::where('role_pkk', 'Wakil')->first();
        $bendahara = DaftarAnggotaModels::where('role_pkk', 'Bendahara')->first();
        $sekretaris = DaftarAnggotaModels::where('role_pkk', 'Sekretaris')->first();
        $pokja1 = DaftarAnggotaModels::where('role_pkk', 'Pokja 1')->get();
        $pokja2 = DaftarAnggotaModels::where('role_pkk', 'Pokja 2')->get();
        $pokja3 = DaftarAnggotaModels::where('role_pkk', 'Pokja 3')->get();
        $pokja4 = DaftarAnggotaModels::where('role_pkk', 'Pokja 4')->get();

        return view('struktural', compact('ketua', 'wakil', 'bendahara', 'sekretaris', 'pokja1', 'pokja2', 'pokja3', 'pokja4'));
    }
}

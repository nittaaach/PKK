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

}

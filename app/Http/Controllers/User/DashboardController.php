<?php

namespace App\Http\Controllers\User;


use App\Models\Infaq;
use App\Models\PenerimaZakat;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\ZakatPayment;


class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // ========================
        // ZAKAT
        // ========================

        $zakatHariIni = ZakatPayment::whereDate('created_at', $today)
            ->sum('bayar');

        $zakatTotal = ZakatPayment::sum('bayar');

        // ========================
        // INFAQ
        // ========================

        $infaqHariIni = Infaq::whereDate('created_at', $today)
            ->sum('total_pemasukan');

        $infaqTotal = Infaq::sum('total_pemasukan');

        // ========================
        // JUMLAH PENERIMA
        // ========================

        $jumlahPenerima = PenerimaZakat::count();

        // ========================
        // JUMLAH PEMBAYAR
        // ========================

        $jumlahPembayar = ZakatPayment::distinct('nama_muzakki')
            ->count('nama_muzakki');

        return view('user.dashboard', compact(
            'zakatHariIni',
            'zakatTotal',
            'infaqHariIni',
            'infaqTotal',
            'jumlahPenerima',
            'jumlahPembayar'
        ));
    }
}

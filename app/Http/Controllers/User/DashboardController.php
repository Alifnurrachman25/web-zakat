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
        $userId = auth()->id();
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

        // 🔥 Infaq Manual Hari Ini
        $infaqManualHariIni = Infaq::where('user_id', $userId)
            ->whereDate('tanggal', $today)
            ->sum('pemasukan_manual');

        // 🔥 Infaq Dari Zakat Hari Ini
        $infaqDariZakatHariIni = ZakatPayment::where('user_id', $userId)
            ->whereDate('created_at', $today)
            ->sum('infaq');


        $infaqHariIni = $infaqManualHariIni;
        $infaqTotal = $grandTotal = Infaq::where('user_id', $userId)->sum('pemasukan_manual') +
            ZakatPayment::where('user_id', $userId)->sum('infaq');

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

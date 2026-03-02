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

        /*
|--------------------------------------------------------------------------
| ZAKAT HARI INI
|--------------------------------------------------------------------------
*/
        $zakatHariIniTunai = ZakatPayment::where('user_id', $userId)
            ->where('metode_pembayaran', 'tunai')
            ->whereDate('created_at', $today)
            ->sum('bayar');

        $zakatHariIniBeras = ZakatPayment::where('user_id', $userId)
            ->where('metode_pembayaran', 'beras')
            ->whereDate('created_at', $today)
            ->sum('bayar');

        /*
|--------------------------------------------------------------------------
| TOTAL ZAKAT
|--------------------------------------------------------------------------
*/
        $zakatTotalTunai = ZakatPayment::where('user_id', $userId)
            ->where('metode_pembayaran', 'tunai')
            ->sum('bayar');

        $zakatTotalBeras = ZakatPayment::where('user_id', $userId)
            ->where('metode_pembayaran', 'beras')
            ->sum('bayar');

        /*
|--------------------------------------------------------------------------
| INFAQ HARI INI
|--------------------------------------------------------------------------
*/

        // Infaq Manual (selalu tunai)
        $infaqManualHariIni = Infaq::where('user_id', $userId)
            ->whereDate('tanggal', $today)
            ->sum('pemasukan_manual');

        // Infaq dari zakat (tunai)
        $infaqZakatHariIniTunai = ZakatPayment::where('user_id', $userId)
            ->where('metode_pembayaran', 'tunai')
            ->whereDate('created_at', $today)
            ->sum('infaq');

        // Infaq dari zakat (beras)
        $infaqZakatHariIniBeras = ZakatPayment::where('user_id', $userId)
            ->where('metode_pembayaran', 'beras')
            ->whereDate('created_at', $today)
            ->sum('infaq');

        $infaqHariIniTunai = $infaqManualHariIni + $infaqZakatHariIniTunai;
        $infaqHariIniBeras = $infaqZakatHariIniBeras;

        /*
|--------------------------------------------------------------------------
| TOTAL INFAQ
|--------------------------------------------------------------------------
*/
        $infaqManualTotal = Infaq::where('user_id', $userId)
            ->sum('pemasukan_manual');

        $infaqZakatTotalTunai = ZakatPayment::where('user_id', $userId)
            ->where('metode_pembayaran', 'tunai')
            ->sum('infaq');

        $infaqZakatTotalBeras = ZakatPayment::where('user_id', $userId)
            ->where('metode_pembayaran', 'beras')
            ->sum('infaq');

        $infaqTotalTunai = $infaqManualTotal + $infaqZakatTotalTunai;
        $infaqTotalBeras = $infaqZakatTotalBeras;

        /*
|--------------------------------------------------------------------------
| ZAKAT MAAL (Masuk BAZNAS)
|--------------------------------------------------------------------------
*/

        $zakatMaalTunai = ZakatPayment::where('user_id', $userId)
            ->whereHas('zakatType', function ($q) {
                $q->where('name', 'like', '%maal%');
            })
            ->where('metode_pembayaran', 'tunai')
            ->sum('bayar');

        $zakatMaalBeras = ZakatPayment::where('user_id', $userId)
            ->whereHas('zakatType', function ($q) {
                $q->where('name', 'like', '%maal%');
            })
            ->where('metode_pembayaran', 'beras')
            ->sum('bayar');

        /*
|--------------------------------------------------------------------------
| ZAKAT FITRAH (Dibagi ke Penerima)
|--------------------------------------------------------------------------
*/

        $zakatFitrahTunai = ZakatPayment::where('user_id', $userId)
            ->whereHas('zakatType', function ($q) {
                $q->where('name', 'like', '%fitrah%');
            })
            ->where('metode_pembayaran', 'tunai')
            ->sum('bayar');

        $zakatFitrahBeras = ZakatPayment::where('user_id', $userId)
            ->whereHas('zakatType', function ($q) {
                $q->where('name', 'like', '%fitrah%');
            })
            ->where('metode_pembayaran', 'beras')
            ->sum('bayar');

        // ========================
        // JUMLAH PENERIMA
        // ========================

        $jumlahPenerima = PenerimaZakat::count();

        // ========================
        // JUMLAH PEMBAYAR
        // ========================

        $jumlahPembayar = ZakatPayment::distinct('nama_muzakki')
            ->count('nama_muzakki');

        $jumlahPenerima = PenerimaZakat::count();

        $fitrahPerOrangTunai = $jumlahPenerima > 0
            ? $zakatFitrahTunai / $jumlahPenerima
            : 0;

        $fitrahPerOrangBeras = $jumlahPenerima > 0
            ? $zakatFitrahBeras / $jumlahPenerima
            : 0;

        return view('user.dashboard', compact(
            'zakatHariIniTunai',
            'zakatHariIniBeras',
            'zakatTotalTunai',
            'zakatTotalBeras',
            'infaqHariIniTunai',
            'infaqHariIniBeras',
            'infaqTotalTunai',
            'infaqTotalBeras',
            'jumlahPenerima',
            'jumlahPembayar',
            'zakatMaalTunai',
            'zakatMaalBeras',
            'zakatFitrahTunai',
            'zakatFitrahBeras',
            'fitrahPerOrangTunai',
            'fitrahPerOrangBeras',
        ));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Produksi;
use Illuminate\Http\Request;
use App\DataTables\ProduksiDataTable;
use App\Http\Requests\ProduksiRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ProduksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProduksiDataTable $dataTable)
    {
        return $dataTable->render('pages.produksi');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ukuran_ml = array_merge(
            range(10, 100, 10),
            range(200, 800, 100),
            [150, 250, 350, 450, 550, 650, 750]
        );
        sort($ukuran_ml);
        $ukuran_ml = array_map(fn($v) => (string) $v, $ukuran_ml);
    
        $ukuran_l = array_map(fn($v) => (string) $v, range(1, 20));
    
        $bagian = [
            'Filling Manual', 'Filling Auto', 'Injection Seal/Press', 'Injection Seal', 
            'Injection Press', 'Induction Seal', 'Tutup Dalam/Nimbang', 'Tutup Dalam', 
            'Nimbang', 'Pasang Tutup', 'Pengecekkan Tutup Luar', 'Pasang Heat Shrink', 
            'Shrink Tunnel', 'Packing Dus', 'Strapping/Penimbangan', 'Pallet'
        ];
    
        return view('pages.produksi-form', [
            'action' => route('produksi.store'),
            'data' => new Produksi(),
            'bagian' => $bagian,
            'operators' => array_map(fn($v) => 'Operator ' . $v, range(1, 20)),
            'ukuran_ml' => $ukuran_ml,
            'ukuran_l' => $ukuran_l,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProduksiRequest $request)
{
    DB::beginTransaction();
    try {
        $data = $request->validated();
        
        // Ensure the input times are in the correct format
        $data['waktu_awal'] = Carbon::createFromFormat('H:i', $data['waktu_awal'])->format('H:i:s');
        $data['waktu_akhir'] = Carbon::createFromFormat('H:i', $data['waktu_akhir'])->format('H:i:s');

        $produksi = new Produksi($data);

        // Calculate total working hours
        $waktuAwal = Carbon::createFromFormat('H:i:s', $data['waktu_awal']);
        $waktuAkhir = Carbon::createFromFormat('H:i:s', $data['waktu_akhir']);
        $totalJam = $waktuAkhir->diffInHours($waktuAwal, false);

        // Subtract downtime from total hours
        $totalJam -= $data['downtime'] / 60;

        $produksi->total_jam = $totalJam;

        // Save images if available
        // if ($request->hasFile('foto_real')) {
        //     $produksi->foto_real = $request->file('foto_real')->store('foto_real');
        // }
        if ($request->hasFile('foto_awal_dt')) {
            $produksi->foto_awal_dt = $request->file('foto_awal_dt')->store('foto_awal_dt');
        }
        if ($request->hasFile('foto_akhir_dt')) {
            $produksi->foto_akhir_dt = $request->file('foto_akhir_dt')->store('foto_akhir_dt');
        }

        $produksi->save();
        DB::commit();

        return response()->json([
            'status' => 'success'
        ]);
    } catch (\Throwable $th) {
        DB::rollBack();
        return response()->json([
            'status' => 'error',
            'message' => $th->getMessage()
        ], 422);
    }
}

    

    /**
     * Display the specified resource.
     */
    public function show(Produksi $produksi)
    {
        return response()->json([
            'data' => $produksi,
            'ukuran_ml' => range(10, 1000, 10), // Contoh ukuran_ml
            'ukuran_l' => range(1, 100, 1), // Contoh ukuran_l
            'operators' => array_map(fn($v) => 'Operator ' . $v, range(1, 20)),
            'bagian' => [
                'Filling Manual', 'Filling Auto', 'Injection Seal/Press', 'Injection Seal', 
                'Injection Press', 'Induction Seal', 'Tutup Dalam/Nimbang', 'Tutup Dalam', 
                'Nimbang', 'Pasang Tutup', 'Pengecekkan Tutup Luar', 'Pasang Heat Shrink', 
                'Shrink Tunnel', 'Packing Dus', 'Strapping/Penimbangan', 'Pallet'
            ]
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
public function edit(Produksi $produksi)
    {
        $ukuran_ml = array_merge(
            range(10, 100, 10),
            range(200, 800, 100),
            [150, 250, 350, 450, 550, 650, 750]
        );
        sort($ukuran_ml);
        $ukuran_ml = array_map(fn($v) => (string) $v, $ukuran_ml);

        return view('pages.produksi-form', [
            'action' => route('produksi.update', $produksi->id),
            'data' => $produksi,
            'bagian' => [
                'Filling Manual', 'Filling Auto', 'Injection Seal/Press', 'Injection Seal', 
                'Injection Press', 'Induction Seal', 'Tutup Dalam/Nimbang', 'Tutup Dalam', 
                'Nimbang', 'Pasang Tutup', 'Pengecekkan Tutup Luar', 'Pasang Heat Shrink', 
                'Shrink Tunnel', 'Packing Dus', 'Strapping/Penimbangan', 'Pallet'
            ],
            'operators' => array_map(fn($v) => 'Operator ' . $v, range(1, 20)),
            'ukuran_ml' => $ukuran_ml,
            'ukuran_l' => range(1, 20),
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produksi $produksi)
    {
        DB::beginTransaction();
        try {
            $produksi->fill($request->validated());

            // Hitung total jam kerja
            $waktuAwal = Carbon::parse($request->waktu_awal);
            $waktuAkhir = Carbon::parse($request->waktu_akhir);
            $totalJam = $waktuAkhir->diffInHours($waktuAwal, false);

            // Kurangi downtime dari total jam
            $totalJam -= $request->downtime / 60;
            
            $produksi->total_jam = $totalJam;

            // Simpan gambar jika ada
            if ($request->hasFile('foto_real')) {
                $produksi->foto_real = $request->file('foto_real')->store('foto_real');
            }
            if ($request->hasFile('foto_awal_dt')) {
                $produksi->foto_awal_dt = $request->file('foto_awal_dt')->store('foto_awal_dt');
            }
            if ($request->hasFile('foto_akhir_dt')) {
                $produksi->foto_akhir_dt = $request->file('foto_akhir_dt')->store('foto_akhir_dt');
            }

            $produksi->save();
            DB::commit();

            return response()->json([
                'status' => 'success'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produksi $produksi)
    {
        try {
            $produksi->delete();
            return response()->json([
                'status' => 'success'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 403);
        }
    }
}

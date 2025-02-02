<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProduksiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Sesuaikan jika ada logika otorisasi yang lebih spesifik
    }

    public function rules(): array
    {
        return [
            'nomor' => ['required', 'string', 'max:255', Rule::unique('produksi')->ignore($this->produksi)],
            'user_id' => ['required', 'exists:users,id'],
            'user_input' => ['required', 'string', 'max:255'],
            'tanggal' => ['required', 'date'],
            'nama_produk' => ['required', 'string', 'max:255'],
            'ukuran_ml' => ['required', 'in:' . implode(',', array_map(fn($v) => (string) $v, array_merge(range(10, 100, 10), range(200, 800, 100), [150, 250, 350, 450, 550, 650, 750])))],
            'ukuran_l' => ['required', 'in:' . implode(',', range(1, 20))],
            'waktu_awal' => ['required', 'date_format:H:i'],
            'waktu_akhir' => ['required', 'date_format:H:i'],
            'downtime' => ['nullable', 'integer', 'min:0'],
            'foto_awal_dt' => ['nullable', 'file', 'mimes:jpg,jpeg,png'],
            'foto_akhir_dt' => ['nullable', 'file', 'mimes:jpg,jpeg,png'],
            'keterangan' => ['nullable', 'string'],
            'penanggung_jawab' => ['required', 'in:' . implode(',', array_map(fn($v) => 'Operator ' . $v, range(1, 20)))],
        ];
    }
}

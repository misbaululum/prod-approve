<x-modal title="Form Produksi" action="{{ $action }}">
    @if ($data->id)
        @method('put')
    @endif
    <div class="row">
        <div class="col-md-6">
            <x-forms.input label="Nomor" name="nomor" value="{{ old('nomor', $data->nomor) }}" />
        </div>
        <div class="col-md-6">
            <x-forms.input label="Nama Produk" name="nama_produk" value="{{ old('nama_produk', $data->nama_produk) }}" />
        </div>
        <div class="col-md-6">
            <x-forms.select name="ukuran_ml" label="Ukuran (ml)">
                @foreach ($ukuran_ml as $size)
                    <option value="{{ $size }}" {{ old('ukuran_ml', $data->ukuran_ml) == $size ? 'selected' : '' }}>
                        {{ $size }} ml
                    </option>
                @endforeach
            </x-forms.select>
        </div>
        <div class="col-md-6">
            <x-forms.select name="ukuran_l" label="Ukuran (l)">
                @foreach ($ukuran_l as $size)
                    <option value="{{ $size }}" {{ old('ukuran_l', $data->ukuran_l) == $size ? 'selected' : '' }}>
                        {{ $size }} l
                    </option>
                @endforeach
            </x-forms.select>
        </div>
        <div class="col-md-6">
            <x-forms.input type="date" label="Tanggal" name="tanggal" value="{{ old('tanggal', $data->tanggal) }}" />
        </div>
        <div class="col-md-6">
            <x-forms.input label="User Input" name="user_input" value="{{ old('user_input', $data->user_input) }}" />
        </div>
        <div class="col-md-6">
            <x-forms.input type="hidden" name="user_id" value="{{ auth()->user()->id }}" />
        </div>
        <div class="col-md-6">
            <x-forms.select name="penanggung_jawab" label="Penanggung Jawab">
                @foreach ($operators as $operator)
                    <option value="{{ $operator }}" {{ old('penanggung_jawab', $data->penanggung_jawab) == $operator ? 'selected' : '' }}>
                        {{ $operator }}
                    </option>
                @endforeach
            </x-forms.select>
        </div>
        <div class="col-md-6">
            <x-forms.input type="time" label="Waktu Awal" name="waktu_awal" value="{{ old('waktu_awal', $data->waktu_awal) }}" />
        </div>
        <div class="col-md-6">
            <x-forms.input type="time" label="Waktu Akhir" name="waktu_akhir" value="{{ old('waktu_akhir', $data->waktu_akhir) }}" />
        </div>
        <div class="col-md-6">
            <x-forms.input type="number" label="Downtime (menit)" name="downtime" value="{{ old('downtime', $data->downtime) }}" />
        </div>
        <div class="col-md-6">
            <label for="foto_standar">Foto Standar</label>
            <img src="{{ asset('images/fav.png') }}" alt="Foto Standar" style="width:100px; height:auto;" />
        </div>
        <div class="col-md-6">
            <x-forms.input type="file" label="Foto Real" name="foto_real" />
            @if($data->foto_real)
                <img src="{{ asset($data->foto_real) }}" alt="Foto Real" style="width:100px;"/>
            @endif
        </div>
        <div class="col-md-6">
            <x-forms.input type="file" label="Foto Awal Downtime" name="foto_awal_dt" />
            @if($data->foto_awal_dt)
                <img src="{{ asset($data->foto_awal_dt) }}" alt="Foto Awal Downtime" style="width:100px;"/>
            @endif
        </div>
        <div class="col-md-6">
            <x-forms.input type="file" label="Foto Akhir Downtime" name="foto_akhir_dt" />
            @if($data->foto_akhir_dt)
                <img src="{{ asset($data->foto_akhir_dt) }}" alt="Foto Akhir Downtime" style="width:100px;"/>
            @endif
        </div>
        <div class="col-md-12">
            <x-forms.textarea label="Keterangan" name="keterangan">{{ old('keterangan', $data->keterangan) }}</x-forms.textarea>
        </div>
        <div class="col-md-12">
            <x-forms.checkbox label="Status Approve" name="status_approve" :checked="old('status_approve', $data->status_approve)" />
        </div>
    </div>
</x-modal>

<x-modal title="Form User" action="{{ $action }}">
    @if ($data->id)
        @method('put')
    @endif
    <div class="row">
        <div class="col-md-6">
            <x-forms.input label="Nama" name="nama" value="{{ $data->name }}" />
        </div>
        <div class="col-md-6">
            <x-forms.input label="Email" name="email" value="{{ $data->email }}" />
        </div>
        <div class="col-md-6">
            <x-forms.input type="password" label="Password" name="password" />
        </div>
        <div class="col-md-6">
            <x-forms.input type="password" label="Confirm Password" name="password_confirmation" />
        </div>
        <div class="col-md-12">
            <x-forms.radio value="{{ $data->kagroup?->jenis_kelamin }}" :options="$jenisKelamin" label="Jenis Kelamin" name="jenis_kelamin" />
        </div>
        <div class="col-md-12">
            <x-forms.select name="divisi" label="Divisi">
            @foreach ($divisi as $item)
            <option value="{{ $item->id }}">{{ $item->nama }}</option> 

            @endforeach
            </x-forms>
        </div>
    </div>
</x-modal>
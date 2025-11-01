@extends('layouts.app-tailwind')

@section('title', 'Cek Status Pendaftaran')

@section('content')
<div class="container py-5 text-center">
    <h1>Cek Status Pendaftaran</h1>
    <p>Silakan masukkan nomor pendaftaran Anda di bawah ini untuk melihat status.</p>

    <form action="{{ url('status') }}" method="GET" class="mt-4">
    <div class="mb-3">
        <input type="text" name="no_pendaftaran" class="form-control" placeholder="Masukkan Nomor Pendaftaran" required>
    </div>
    <button type="submit" class="btn btn-primary">Cek Status</button>
</form>

</div>
@endsection

@extends('layouts.admin')

@section('title', 'Hasil Proses Seleksi Siswa')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Hasil Proses Seleksi Siswa</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.nilai.index') }}" class="btn btn-default btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    @if(empty($results))
                        <div class="alert alert-info">
                            Tidak ada siswa dengan status pending untuk diproses.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NISN</th>
                                        <th>Nama Lengkap</th>
                                        <th>Rerata Nilai</th>
                                        <th>Jumlah Prestasi</th>
                                        <th>Skor Akhir</th>
                                        <th>Status Kelulusan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($results as $index => $result)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $result['siswa']->nisn }}</td>
                                        <td>{{ $result['siswa']->nama_lengkap }}</td>
                                        <td>{{ number_format($result['siswa']->rerata_nilai_rapor, 2) }}</td>
                                        <td>{{ $result['siswa']->prestasi->count() }}</td>
                                        <td>{{ number_format($result['skor'], 2) }}</td>
                                        <td>
                                            @if($result['lulus'])
                                                <span class="badge badge-success">Lulus</span>
                                            @else
                                                <span class="badge badge-danger">Tidak Lulus</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.nilai.show', $result['siswa']->id) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="info-box bg-success">
                                    <span class="info-box-icon"><i class="fas fa-check"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Siswa Lulus</span>
                                        <span class="info-box-number">{{ collect($results)->where('lulus', true)->count() }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box bg-danger">
                                    <span class="info-box-icon"><i class="fas fa-times"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Siswa Tidak Lulus</span>
                                        <span class="info-box-number">{{ collect($results)->where('lulus', false)->count() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <form action="{{ route('admin.nilai.prosesRanking') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-trophy"></i> Proses Ranking
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Add any JavaScript functionality here if needed
    });
</script>
@endsection
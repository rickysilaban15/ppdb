@extends('layouts.admin')

@section('title', 'Detail Siswa')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Siswa</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.siswa.index') }}" class="btn btn-default">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <a href="{{ route('admin.siswa.edit', $siswa->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Student Info Card -->
                        <div class="col-md-4">
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle" 
                                             src="{{ $siswa->file_pas_foto ? asset('storage/' . $siswa->file_pas_foto) : 'https://ui-avatars.com/api/?name=' . urlencode($siswa->nama_lengkap) . '&background=random&size=150' }}" 
                                             alt="User profile picture">
                                        <h3 class="profile-username text-center">{{ $siswa->nama_lengkap }}</h3>
                                        <p class="text-muted text-center">{{ $siswa->no_pendaftaran }}</p>
                                    </div>
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>NISN</b> <a class="float-right">{{ $siswa->nisn }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>NIK</b> <a class="float-right">{{ $siswa->nik }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Jenis Kelamin</b> <a class="float-right">{{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Agama</b> <a class="float-right">{{ $siswa->agama }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Status</b> 
                                            <a class="float-right">
                                                @if($siswa->status_seleksi == 'lulus')
                                                    <span class="badge badge-success">Lulus</span>
                                                @elseif($siswa->status_seleksi == 'tidak_lulus')
                                                    <span class="badge badge-danger">Tidak Lulus</span>
                                                @else
                                                    <span class="badge badge-warning">Pending</span>
                                                @endif
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Personal Data Card -->
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header p-2">
                                    <h3 class="card-title">Data Pribadi</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th width="30%">Tempat Lahir</th>
                                                    <td>{{ $siswa->tempat_lahir }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tanggal Lahir</th>
                                                    <td>{{ $siswa->tanggal_lahir }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Kewarganegaraan</th>
                                                    <td>{{ $siswa->kewarganegaraan }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Email</th>
                                                    <td>{{ $siswa->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th>No. Telepon</th>
                                                    <td>{{ $siswa->no_telepon }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th width="30%">Alamat</th>
                                                    <td>{{ $siswa->alamat_jalan }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Kelurahan</th>
                                                    <td>{{ $siswa->kelurahan }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Kecamatan</th>
                                                    <td>{{ $siswa->kecamatan }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Kabupaten/Kota</th>
                                                    <td>{{ $siswa->kabupaten_kota }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Provinsi</th>
                                                    <td>{{ $siswa->provinsi }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Kode Pos</th>
                                                    <td>{{ $siswa->kode_pos }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <!-- Family Data Card -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header p-2">
                                    <h3 class="card-title">Data Keluarga</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th width="40%">Nama Ayah</th>
                                                    <td>{{ $siswa->nama_ayah }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Pekerjaan Ayah</th>
                                                    <td>{{ $siswa->pekerjaan_ayah }}</td>
                                                </tr>
                                                <tr>
                                                    <th>No. Telepon Ayah</th>
                                                    <td>{{ $siswa->no_telepon_ayah }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th width="40%">Nama Ibu</th>
                                                    <td>{{ $siswa->nama_ibu }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Pekerjaan Ibu</th>
                                                    <td>{{ $siswa->pekerjaan_ibu }}</td>
                                                </tr>
                                                <tr>
                                                    <th>No. Telepon Ibu</th>
                                                    <td>{{ $siswa->no_telepon_ibu }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    
                                    @if($siswa->nama_wali)
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th width="25%">Nama Wali</th>
                                                    <td width="25%">{{ $siswa->nama_wali }}</td>
                                                    <th width="25%">Pekerjaan Wali</th>
                                                    <td width="25%">{{ $siswa->pekerjaan_wali }}</td>
                                                </tr>
                                                <tr>
                                                    <th>No. Telepon Wali</th>
                                                    <td colspan="3">{{ $siswa->no_telepon_wali }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <!-- Education Data Card -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header p-2">
                                    <h3 class="card-title">Data Pendidikan</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="40%">Asal Sekolah</th>
                                            <td>{{ $siswa->asal_sekolah }}</td>
                                        </tr>
                                        <tr>
                                            <th>Alamat Sekolah</th>
                                            <td>{{ $siswa->alamat_sekolah_asal }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tahun Lulus</th>
                                            <td>{{ $siswa->tahun_lulus }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jurusan Pilihan 1</th>
                                            <td>{{ $siswa->jurusanPilihan1->nama_jurusan ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jurusan Pilihan 2</th>
                                            <td>{{ $siswa->jurusanPilihan2->nama_jurusan ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jalur Pendaftaran</th>
                                            <td>{{ ucfirst($siswa->jalur_pendaftaran) }}</td>
                                        </tr>
                                    </table>
                                    
                                    <div class="mt-3">
                                        <h5>Nilai & Skor</h5>
                                        <table class="table table-bordered">
                                            <tr>
                                                <th width="40%">Rerata Nilai Rapor</th>
                                                <td>{{ $siswa->rerata_nilai_rapor }}</td>
                                            </tr>
                                            <tr>
                                                <th>Nilai Akreditasi Sekolah</th>
                                                <td>{{ $siswa->nilai_akreditasi_sekolah }}</td>
                                            </tr>
                                            <tr>
                                                <th>Indeks Sekolah Asal</th>
                                                <td>{{ $siswa->indeks_sekolah_asal }}</td>
                                            </tr>
                                            <tr>
                                                <th>Skor Akhir</th>
                                                <td>{{ $siswa->skor_akhir }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Selection Results Card -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header p-2">
                                    <h3 class="card-title">Hasil Seleksi</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th width="40%">Status Seleksi</th>
                                                    <td>
                                                        @if($siswa->status_seleksi == 'lulus')
                                                            <span class="badge badge-success">Lulus</span>
                                                        @elseif($siswa->status_seleksi == 'tidak_lulus')
                                                            <span class="badge badge-danger">Tidak Lulus</span>
                                                        @else
                                                            <span class="badge badge-warning">Pending</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Jurusan Diterima</th>
                                                    <td>{{ $siswa->jurusanDiterima->nama_jurusan ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Kelas Unggulan</th>
                                                    <td>{{ $siswa->kelas_unggulan ? 'Ya' : 'Tidak' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Ranking</th>
                                                    <td>{{ $siswa->ranking ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Penerima Hadiah</th>
                                                    <td>{{ $siswa->penerima_hadiah ? 'Ya' : 'Tidak' }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <h5>Dokumen Pendukung</h5>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th width="40%">Kartu Keluarga</th>
                                                    <td>
                                                        @if($siswa->file_kk)
                                                            <a href="{{ asset('storage/' . $siswa->file_kk) }}" target="_blank" class="btn btn-sm btn-info">
                                                                <i class="fas fa-eye"></i> Lihat
                                                            </a>
                                                        @else
                                                            <span class="text-muted">Tidak ada</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Akta Kelahiran</th>
                                                    <td>
                                                        @if($siswa->file_akta)
                                                            <a href="{{ asset('storage/' . $siswa->file_akta) }}" target="_blank" class="btn btn-sm btn-info">
                                                                <i class="fas fa-eye"></i> Lihat
                                                            </a>
                                                        @else
                                                            <span class="text-muted">Tidak ada</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Ijazah</th>
                                                    <td>
                                                        @if($siswa->file_ijazah)
                                                            <a href="{{ asset('storage/' . $siswa->file_ijazah) }}" target="_blank" class="btn btn-sm btn-info">
                                                                <i class="fas fa-eye"></i> Lihat
                                                            </a>
                                                        @else
                                                            <span class="text-muted">Tidak ada</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Pas Foto</th>
                                                    <td>
                                                        @if($siswa->file_pas_foto)
                                                            <a href="{{ asset('storage/' . $siswa->file_pas_foto) }}" target="_blank" class="btn btn-sm btn-info">
                                                                <i class="fas fa-eye"></i> Lihat
                                                            </a>
                                                        @else
                                                            <span class="text-muted">Tidak ada</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Grades and Achievements -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header p-2">
                                    <h3 class="card-title">Nilai Siswa</h3>
                                </div>
                                <div class="card-body">
                                    @if($siswa->nilaiSiswa->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Mata Pelajaran</th>
                                                        <th>Nilai</th>
                                                        <th>Semester</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($siswa->nilaiSiswa as $nilai)
                                                    <tr>
                                                        <td>{{ $nilai->mata_pelajaran }}</td>
                                                        <td>{{ $nilai->nilai }}</td>
                                                        <td>{{ $nilai->semester }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <p class="text-muted">Belum ada data nilai</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header p-2">
                                    <h3 class="card-title">Prestasi</h3>
                                </div>
                                <div class="card-body">
                                    @if($siswa->prestasi->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Jenis Prestasi</th>
                                                        <th>Nama Prestasi</th>
                                                        <th>Tingkat</th>
                                                        <th>Tahun</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($siswa->prestasi as $prestasi)
                                                    <tr>
                                                        <td>{{ ucfirst($prestasi->jenis_prestasi) }}</td>
                                                        <td>{{ $prestasi->nama_prestasi }}</td>
                                                        <td>{{ ucfirst($prestasi->tingkat) }}</td>
                                                        <td>{{ $prestasi->tahun }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <p class="text-muted">Belum ada data prestasi</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Add any JavaScript functionality here if needed
    });
</script>
@endpush
@extends('layouts.admin')

@section('title', 'Tambah Siswa')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Siswa Baru</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.siswa.index') }}" class="btn btn-default">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.siswa.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- Data Pribadi -->
                            <div class="col-md-6">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Data Pribadi</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="nama_lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" 
                                                   id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
                                            @error('nama_lengkap')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="nisn">NISN <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('nisn') is-invalid @enderror" 
                                                   id="nisn" name="nisn" value="{{ old('nisn') }}" required>
                                            @error('nisn')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="nik">NIK <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('nik') is-invalid @enderror" 
                                                   id="nik" name="nik" value="{{ old('nik') }}" required>
                                            @error('nik')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="tempat_lahir">Tempat Lahir <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" 
                                                   id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
                                            @error('tempat_lahir')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                                                   id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                                            @error('tanggal_lahir')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
                                            <select class="form-control @error('jenis_kelamin') is-invalid @enderror" 
                                                    id="jenis_kelamin" name="jenis_kelamin" required>
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                            @error('jenis_kelamin')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="agama">Agama <span class="text-danger">*</span></label>
                                            <select class="form-control @error('agama') is-invalid @enderror" 
                                                    id="agama" name="agama" required>
                                                <option value="">Pilih Agama</option>
                                                <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                                <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                                <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                                <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                                <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                                <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                            </select>
                                            @error('agama')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Data Alamat -->
                            <div class="col-md-6">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Data Alamat</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="alamat_jalan">Alamat Jalan <span class="text-danger">*</span></label>
                                            <textarea class="form-control @error('alamat_jalan') is-invalid @enderror" 
                                                      id="alamat_jalan" name="alamat_jalan" rows="2" required>{{ old('alamat_jalan') }}</textarea>
                                            @error('alamat_jalan')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="kelurahan">Kelurahan <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('kelurahan') is-invalid @enderror" 
                                                   id="kelurahan" name="kelurahan" value="{{ old('kelurahan') }}" required>
                                            @error('kelurahan')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="kecamatan">Kecamatan <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" 
                                                   id="kecamatan" name="kecamatan" value="{{ old('kecamatan') }}" required>
                                            @error('kecamatan')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="kabupaten_kota">Kabupaten/Kota <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('kabupaten_kota') is-invalid @enderror" 
                                                   id="kabupaten_kota" name="kabupaten_kota" value="{{ old('kabupaten_kota') }}" required>
                                            @error('kabupaten_kota')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="provinsi">Provinsi <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('provinsi') is-invalid @enderror" 
                                                   id="provinsi" name="provinsi" value="{{ old('provinsi') }}" required>
                                            @error('provinsi')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="kode_pos">Kode Pos <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('kode_pos') is-invalid @enderror" 
                                                   id="kode_pos" name="kode_pos" value="{{ old('kode_pos') }}" required>
                                            @error('kode_pos')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="no_telepon">No Telepon <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('no_telepon') is-invalid @enderror" 
                                                   id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}" required>
                                            @error('no_telepon')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Data Orang Tua -->
                            <div class="col-md-6">
                                <div class="card card-warning">
                                    <div class="card-header">
                                        <h3 class="card-title">Data Orang Tua</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="nama_ayah">Nama Ayah <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('nama_ayah') is-invalid @enderror" 
                                                   id="nama_ayah" name="nama_ayah" value="{{ old('nama_ayah') }}" required>
                                            @error('nama_ayah')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="pekerjaan_ayah">Pekerjaan Ayah <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('pekerjaan_ayah') is-invalid @enderror" 
                                                   id="pekerjaan_ayah" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}" required>
                                            @error('pekerjaan_ayah')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="no_telepon_ayah">No Telepon Ayah <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('no_telepon_ayah') is-invalid @enderror" 
                                                   id="no_telepon_ayah" name="no_telepon_ayah" value="{{ old('no_telepon_ayah') }}" required>
                                            @error('no_telepon_ayah')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_ibu">Nama Ibu <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('nama_ibu') is-invalid @enderror" 
                                                   id="nama_ibu" name="nama_ibu" value="{{ old('nama_ibu') }}" required>
                                            @error('nama_ibu')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="pekerjaan_ibu">Pekerjaan Ibu <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('pekerjaan_ibu') is-invalid @enderror" 
                                                   id="pekerjaan_ibu" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') }}" required>
                                            @error('pekerjaan_ibu')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="no_telepon_ibu">No Telepon Ibu <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('no_telepon_ibu') is-invalid @enderror" 
                                                   id="no_telepon_ibu" name="no_telepon_ibu" value="{{ old('no_telepon_ibu') }}" required>
                                            @error('no_telepon_ibu')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Data Pendidikan -->
                            <div class="col-md-6">
                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Data Pendidikan</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="asal_sekolah">Asal Sekolah <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('asal_sekolah') is-invalid @enderror" 
                                                   id="asal_sekolah" name="asal_sekolah" value="{{ old('asal_sekolah') }}" required>
                                            @error('asal_sekolah')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat_sekolah_asal">Alamat Sekolah Asal <span class="text-danger">*</span></label>
                                            <textarea class="form-control @error('alamat_sekolah_asal') is-invalid @enderror" 
                                                      id="alamat_sekolah_asal" name="alamat_sekolah_asal" rows="2" required>{{ old('alamat_sekolah_asal') }}</textarea>
                                            @error('alamat_sekolah_asal')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="tahun_lulus">Tahun Lulus <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control @error('tahun_lulus') is-invalid @enderror" 
                                                   id="tahun_lulus" name="tahun_lulus" value="{{ old('tahun_lulus') }}" required>
                                            @error('tahun_lulus')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="jurusan_pilihan_1">Jurusan Pilihan 1 <span class="text-danger">*</span></label>
                                            <select class="form-control @error('jurusan_pilihan_1') is-invalid @enderror" 
                                                    id="jurusan_pilihan_1" name="jurusan_pilihan_1" required>
                                                <option value="">Pilih Jurusan</option>
                                                @foreach($jurusans as $jurusan)
                                                    <option value="{{ $jurusan->id }}" {{ old('jurusan_pilihan_1') == $jurusan->id ? 'selected' : '' }}>
                                                        {{ $jurusan->nama_jurusan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('jurusan_pilihan_1')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="jurusan_pilihan_2">Jurusan Pilihan 2 <span class="text-danger">*</span></label>
                                            <select class="form-control @error('jurusan_pilihan_2') is-invalid @enderror" 
                                                    id="jurusan_pilihan_2" name="jurusan_pilihan_2" required>
                                                <option value="">Pilih Jurusan</option>
                                                @foreach($jurusans as $jurusan)
                                                    <option value="{{ $jurusan->id }}" {{ old('jurusan_pilihan_2') == $jurusan->id ? 'selected' : '' }}>
                                                        {{ $jurusan->nama_jurusan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('jurusan_pilihan_2')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="jalur_pendaftaran">Jalur Pendaftaran <span class="text-danger">*</span></label>
                                            <select class="form-control @error('jalur_pendaftaran') is-invalid @enderror" 
                                                    id="jalur_pendaftaran" name="jalur_pendaftaran" required>
                                                <option value="">Pilih Jalur Pendaftaran</option>
                                                <option value="zonasi" {{ old('jalur_pendaftaran') == 'zonasi' ? 'selected' : '' }}>Zonasi</option>
                                                <option value="prestasi" {{ old('jalur_pendaftaran') == 'prestasi' ? 'selected' : '' }}>Prestasi</option>
                                                <option value="afirmasi" {{ old('jalur_pendaftaran') == 'afirmasi' ? 'selected' : '' }}>Afirmasi</option>
                                                <option value="mutasi" {{ old('jalur_pendaftaran') == 'mutasi' ? 'selected' : '' }}>Mutasi</option>
                                            </select>
                                            @error('jalur_pendaftaran')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Data Nilai -->
                            <div class="col-md-6">
                                <div class="card card-danger">
                                    <div class="card-header">
                                        <h3 class="card-title">Data Nilai</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="rerata_nilai_rapor">Rerata Nilai Rapor <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control @error('rerata_nilai_rapor') is-invalid @enderror" 
                                                   id="rerata_nilai_rapor" name="rerata_nilai_rapor" value="{{ old('rerata_nilai_rapor') }}" 
                                                   min="0" max="100" step="0.01" required>
                                            @error('rerata_nilai_rapor')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="nilai_akreditasi_sekolah">Nilai Akreditasi Sekolah <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control @error('nilai_akreditasi_sekolah') is-invalid @enderror" 
                                                   id="nilai_akreditasi_sekolah" name="nilai_akreditasi_sekolah" value="{{ old('nilai_akreditasi_sekolah') }}" 
                                                   min="0" max="100" step="0.01" required>
                                            @error('nilai_akreditasi_sekolah')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="indeks_sekolah_asal">Indeks Sekolah Asal <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control @error('indeks_sekolah_asal') is-invalid @enderror" 
                                                   id="indeks_sekolah_asal" name="indeks_sekolah_asal" value="{{ old('indeks_sekolah_asal') }}" 
                                                   min="0" max="100" step="0.01" required>
                                            @error('indeks_sekolah_asal')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Dokumen Pendukung -->
                            <div class="col-md-6">
                                <div class="card card-secondary">
                                    <div class="card-header">
                                        <h3 class="card-title">Dokumen Pendukung</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="foto_kk">Foto Kartu Keluarga</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input @error('foto_kk') is-invalid @enderror" 
                                                       id="foto_kk" name="foto_kk">
                                                <label class="custom-file-label" for="foto_kk">Pilih file...</label>
                                            </div>
                                            <small class="form-text text-muted">Format: JPG, PNG, PDF. Maks: 2MB</small>
                                            @error('foto_kk')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
<a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">
    <i class="fas fa-times"></i> Batal
</a>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Custom file input
    $('.custom-file-input').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').html(fileName);
    });
</script>
@endpush
@extends('layouts.admin')

@section('title', 'Edit Siswa')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Siswa</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.siswa.index') }}" class="btn btn-default">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.siswa.update', $siswa->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
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
                                                   id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $siswa->nama_lengkap) }}" required>
                                            @error('nama_lengkap')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="nisn">NISN <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('nisn') is-invalid @enderror" 
                                                   id="nisn" name="nisn" value="{{ old('nisn', $siswa->nisn) }}" required>
                                            @error('nisn')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="nik">NIK <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('nik') is-invalid @enderror" 
                                                   id="nik" name="nik" value="{{ old('nik', $siswa->nik) }}" required>
                                            @error('nik')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="tempat_lahir">Tempat Lahir <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" 
                                                   id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}" required>
                                            @error('tempat_lahir')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                                                   id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $siswa->tanggal_lahir) }}" required>
                                            @error('tanggal_lahir')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
                                            <select class="form-control @error('jenis_kelamin') is-invalid @enderror" 
                                                    id="jenis_kelamin" name="jenis_kelamin" required>
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="L" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="P" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
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
                                                <option value="Islam" {{ old('agama', $siswa->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                                <option value="Kristen" {{ old('agama', $siswa->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                                <option value="Katolik" {{ old('agama', $siswa->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                                <option value="Hindu" {{ old('agama', $siswa->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                                <option value="Buddha" {{ old('agama', $siswa->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                                <option value="Konghucu" {{ old('agama', $siswa->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                            </select>
                                            @error('agama')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="kewarganegaraan">Kewarganegaraan</label>
                                            <input type="text" class="form-control @error('kewarganegaraan') is-invalid @enderror" 
                                                   id="kewarganegaraan" name="kewarganegaraan" value="{{ old('kewarganegaraan', $siswa->kewarganegaraan) }}">
                                            @error('kewarganegaraan')
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
                                                      id="alamat_jalan" name="alamat_jalan" rows="2" required>{{ old('alamat_jalan', $siswa->alamat_jalan) }}</textarea>
                                            @error('alamat_jalan')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="rt">RT</label>
                                            <input type="text" class="form-control @error('rt') is-invalid @enderror" 
                                                   id="rt" name="rt" value="{{ old('rt', $siswa->rt) }}">
                                            @error('rt')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="rw">RW</label>
                                            <input type="text" class="form-control @error('rw') is-invalid @enderror" 
                                                   id="rw" name="rw" value="{{ old('rw', $siswa->rw) }}">
                                            @error('rw')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="kelurahan">Kelurahan <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('kelurahan') is-invalid @enderror" 
                                                   id="kelurahan" name="kelurahan" value="{{ old('kelurahan', $siswa->kelurahan) }}" required>
                                            @error('kelurahan')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="kecamatan">Kecamatan <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" 
                                                   id="kecamatan" name="kecamatan" value="{{ old('kecamatan', $siswa->kecamatan) }}" required>
                                            @error('kecamatan')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="kabupaten_kota">Kabupaten/Kota <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('kabupaten_kota') is-invalid @enderror" 
                                                   id="kabupaten_kota" name="kabupaten_kota" value="{{ old('kabupaten_kota', $siswa->kabupaten_kota) }}" required>
                                            @error('kabupaten_kota')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="provinsi">Provinsi <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('provinsi') is-invalid @enderror" 
                                                   id="provinsi" name="provinsi" value="{{ old('provinsi', $siswa->provinsi) }}" required>
                                            @error('provinsi')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="kode_pos">Kode Pos <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('kode_pos') is-invalid @enderror" 
                                                   id="kode_pos" name="kode_pos" value="{{ old('kode_pos', $siswa->kode_pos) }}" required>
                                            @error('kode_pos')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="status_tempat_tinggal">Status Tempat Tinggal</label>
                                            <select class="form-control @error('status_tempat_tinggal') is-invalid @enderror" 
                                                    id="status_tempat_tinggal" name="status_tempat_tinggal">
                                                <option value="">Pilih Status Tempat Tinggal</option>
                                                <option value="Rumah Keluarga" {{ old('status_tempat_tinggal', $siswa->status_tempat_tinggal) == 'Rumah Keluarga' ? 'selected' : '' }}>Rumah Keluarga</option>
                                                <option value="Rumah Sewa" {{ old('status_tempat_tinggal', $siswa->status_tempat_tinggal) == 'Rumah Sewa' ? 'selected' : '' }}>Rumah Sewa</option>
                                                <option value="Asrama" {{ old('status_tempat_tinggal', $siswa->status_tempat_tinggal) == 'Asrama' ? 'selected' : '' }}>Asrama</option>
                                                <option value="Panti Asuhan" {{ old('status_tempat_tinggal', $siswa->status_tempat_tinggal) == 'Panti Asuhan' ? 'selected' : '' }}>Panti Asuhan</option>
                                            </select>
                                            @error('status_tempat_tinggal')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Data Kontak -->
                            <div class="col-md-6">
                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Data Kontak</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="email">Email <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                                   id="email" name="email" value="{{ old('email', $siswa->email) }}" required>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="no_telepon">No Telepon <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('no_telepon') is-invalid @enderror" 
                                                   id="no_telepon" name="no_telepon" value="{{ old('no_telepon', $siswa->no_telepon) }}" required>
                                            @error('no_telepon')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah_saudara">Jumlah Saudara</label>
                                            <input type="number" class="form-control @error('jumlah_saudara') is-invalid @enderror" 
                                                   id="jumlah_saudara" name="jumlah_saudara" value="{{ old('jumlah_saudara', $siswa->jumlah_saudara) }}">
                                            @error('jumlah_saudara')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="anak_ke">Anak Ke</label>
                                            <input type="number" class="form-control @error('anak_ke') is-invalid @enderror" 
                                                   id="anak_ke" name="anak_ke" value="{{ old('anak_ke', $siswa->anak_ke) }}">
                                            @error('anak_ke')
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
                                                   id="nama_ayah" name="nama_ayah" value="{{ old('nama_ayah', $siswa->nama_ayah) }}" required>
                                            @error('nama_ayah')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="pekerjaan_ayah">Pekerjaan Ayah <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('pekerjaan_ayah') is-invalid @enderror" 
                                                   id="pekerjaan_ayah" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah', $siswa->pekerjaan_ayah) }}" required>
                                            @error('pekerjaan_ayah')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="no_telepon_ayah">No Telepon Ayah <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('no_telepon_ayah') is-invalid @enderror" 
                                                   id="no_telepon_ayah" name="no_telepon_ayah" value="{{ old('no_telepon_ayah', $siswa->no_telepon_ayah) }}" required>
                                            @error('no_telepon_ayah')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_ibu">Nama Ibu <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('nama_ibu') is-invalid @enderror" 
                                                   id="nama_ibu" name="nama_ibu" value="{{ old('nama_ibu', $siswa->nama_ibu) }}" required>
                                            @error('nama_ibu')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="pekerjaan_ibu">Pekerjaan Ibu <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('pekerjaan_ibu') is-invalid @enderror" 
                                                   id="pekerjaan_ibu" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu', $siswa->pekerjaan_ibu) }}" required>
                                            @error('pekerjaan_ibu')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="no_telepon_ibu">No Telepon Ibu <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('no_telepon_ibu') is-invalid @enderror" 
                                                   id="no_telepon_ibu" name="no_telepon_ibu" value="{{ old('no_telepon_ibu', $siswa->no_telepon_ibu) }}" required>
                                            @error('no_telepon_ibu')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_wali">Nama Wali</label>
                                            <input type="text" class="form-control @error('nama_wali') is-invalid @enderror" 
                                                   id="nama_wali" name="nama_wali" value="{{ old('nama_wali', $siswa->nama_wali) }}">
                                            @error('nama_wali')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="pekerjaan_wali">Pekerjaan Wali</label>
                                            <input type="text" class="form-control @error('pekerjaan_wali') is-invalid @enderror" 
                                                   id="pekerjaan_wali" name="pekerjaan_wali" value="{{ old('pekerjaan_wali', $siswa->pekerjaan_wali) }}">
                                            @error('pekerjaan_wali')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="no_telepon_wali">No Telepon Wali</label>
                                            <input type="text" class="form-control @error('no_telepon_wali') is-invalid @enderror" 
                                                   id="no_telepon_wali" name="no_telepon_wali" value="{{ old('no_telepon_wali', $siswa->no_telepon_wali) }}">
                                            @error('no_telepon_wali')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Data Pendidikan -->
                            <div class="col-md-6">
                                <div class="card card-danger">
                                    <div class="card-header">
                                        <h3 class="card-title">Data Pendidikan</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="asal_sekolah">Asal Sekolah <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('asal_sekolah') is-invalid @enderror" 
                                                   id="asal_sekolah" name="asal_sekolah" value="{{ old('asal_sekolah', $siswa->asal_sekolah) }}" required>
                                            @error('asal_sekolah')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat_sekolah_asal">Alamat Sekolah Asal <span class="text-danger">*</span></label>
                                            <textarea class="form-control @error('alamat_sekolah_asal') is-invalid @enderror" 
                                                      id="alamat_sekolah_asal" name="alamat_sekolah_asal" rows="2" required>{{ old('alamat_sekolah_asal', $siswa->alamat_sekolah_asal) }}</textarea>
                                            @error('alamat_sekolah_asal')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="tahun_lulus">Tahun Lulus <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control @error('tahun_lulus') is-invalid @enderror" 
                                                   id="tahun_lulus" name="tahun_lulus" value="{{ old('tahun_lulus', $siswa->tahun_lulus) }}" required>
                                            @error('tahun_lulus')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="rerata_nilai_rapor">Rerata Nilai Rapor <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control @error('rerata_nilai_rapor') is-invalid @enderror" 
                                                   id="rerata_nilai_rapor" name="rerata_nilai_rapor" value="{{ old('rerata_nilai_rapor', $siswa->rerata_nilai_rapor) }}" 
                                                   min="0" max="100" step="0.01" required>
                                            @error('rerata_nilai_rapor')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="nilai_akreditasi_sekolah">Nilai Akreditasi Sekolah <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control @error('nilai_akreditasi_sekolah') is-invalid @enderror" 
                                                   id="nilai_akreditasi_sekolah" name="nilai_akreditasi_sekolah" value="{{ old('nilai_akreditasi_sekolah', $siswa->nilai_akreditasi_sekolah) }}" 
                                                   min="0" max="100" step="0.01" required>
                                            @error('nilai_akreditasi_sekolah')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="indeks_sekolah_asal">Indeks Sekolah Asal <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control @error('indeks_sekolah_asal') is-invalid @enderror" 
                                                   id="indeks_sekolah_asal" name="indeks_sekolah_asal" value="{{ old('indeks_sekolah_asal', $siswa->indeks_sekolah_asal) }}" 
                                                   min="0" max="100" step="0.01" required>
                                            @error('indeks_sekolah_asal')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="jalur_pendaftaran">Jalur Pendaftaran <span class="text-danger">*</span></label>
                                            <select class="form-control @error('jalur_pendaftaran') is-invalid @enderror" 
                                                    id="jalur_pendaftaran" name="jalur_pendaftaran" required>
                                                <option value="">Pilih Jalur Pendaftaran</option>
                                                <option value="zonasi" {{ old('jalur_pendaftaran', $siswa->jalur_pendaftaran) == 'zonasi' ? 'selected' : '' }}>Zonasi</option>
                                                <option value="prestasi" {{ old('jalur_pendaftaran', $siswa->jalur_pendaftaran) == 'prestasi' ? 'selected' : '' }}>Prestasi</option>
                                                <option value="afirmasi" {{ old('jalur_pendaftaran', $siswa->jalur_pendaftaran) == 'afirmasi' ? 'selected' : '' }}>Afirmasi</option>
                                                <option value="mutasi" {{ old('jalur_pendaftaran', $siswa->jalur_pendaftaran) == 'mutasi' ? 'selected' : '' }}>Mutasi</option>
                                            </select>
                                            @error('jalur_pendaftaran')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="pilihan_jurusan_1">Jurusan Pilihan 1 <span class="text-danger">*</span></label>
                                            <select class="form-control @error('pilihan_jurusan_1') is-invalid @enderror" 
                                                    id="pilihan_jurusan_1" name="pilihan_jurusan_1" required>
                                                <option value="">Pilih Jurusan</option>
                                                @foreach($jurusans as $jurusan)
                                                    <option value="{{ $jurusan->id }}" {{ old('pilihan_jurusan_1', $siswa->pilihan_jurusan_1) == $jurusan->id ? 'selected' : '' }}>
                                                        {{ $jurusan->nama_jurusan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('pilihan_jurusan_1')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="pilihan_jurusan_2">Jurusan Pilihan 2 <span class="text-danger">*</span></label>
                                            <select class="form-control @error('pilihan_jurusan_2') is-invalid @enderror" 
                                                    id="pilihan_jurusan_2" name="pilihan_jurusan_2" required>
                                                <option value="">Pilih Jurusan</option>
                                                @foreach($jurusans as $jurusan)
                                                    <option value="{{ $jurusan->id }}" {{ old('pilihan_jurusan_2', $siswa->pilihan_jurusan_2) == $jurusan->id ? 'selected' : '' }}>
                                                        {{ $jurusan->nama_jurusan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('pilihan_jurusan_2')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Data Seleksi -->
                            <div class="col-md-6">
                                <div class="card card-secondary">
                                    <div class="card-header">
                                        <h3 class="card-title">Data Seleksi</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="skor_akhir">Skor Akhir</label>
                                            <input type="number" class="form-control @error('skor_akhir') is-invalid @enderror" 
                                                   id="skor_akhir" name="skor_akhir" value="{{ old('skor_akhir', $siswa->skor_akhir) }}" 
                                                   min="0" max="100" step="0.01" readonly>
                                            @error('skor_akhir')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                            <small class="form-text text-muted">Skor akhir dihitung otomatis berdasarkan nilai yang dimasukkan</small>
                                        </div>
                                        <div class="form-group">
    <label for="status_seleksi">Status Seleksi <span class="text-danger">*</span></label>
    <select class="form-control @error('status_seleksi') is-invalid @enderror" 
            id="status_seleksi" name="status_seleksi" required>
        <option value="">Pilih Status</option>
        <option value="pending" {{ old('status_seleksi', $siswa->status_seleksi) == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="diterima" {{ old('status_seleksi', $siswa->status_seleksi) == 'diterima' ? 'selected' : '' }}>Diterima</option>
        <option value="ditolak" {{ old('status_seleksi', $siswa->status_seleksi) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
    </select>
    @error('status_seleksi')
        <span class="invalid-feedback" role="alert">{{ $message }}</span>
    @enderror
</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="jurusan_diterima">Jurusan Diterima</label>
                                            <select class="form-control @error('jurusan_diterima') is-invalid @enderror" 
                                                    id="jurusan_diterima" name="jurusan_diterima">
                                                <option value="">Pilih Jurusan</option>
                                                @foreach($jurusans as $jurusan)
                                                    <option value="{{ $jurusan->id }}" {{ old('jurusan_diterima', $siswa->jurusan_diterima) == $jurusan->id ? 'selected' : '' }}>
                                                        {{ $jurusan->nama_jurusan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('jurusan_diterima')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input @error('kelas_unggulan') is-invalid @enderror" 
                                                       type="checkbox" id="kelas_unggulan" name="kelas_unggulan" 
                                                       value="1" {{ old('kelas_unggulan', $siswa->kelas_unggulan) ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="kelas_unggulan">Kelas Unggulan</label>
                                                @error('kelas_unggulan')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="ranking">Ranking</label>
                                            <input type="number" class="form-control @error('ranking') is-invalid @enderror" 
                                                   id="ranking" name="ranking" value="{{ old('ranking', $siswa->ranking) }}">
                                            @error('ranking')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input @error('penerima_hadiah') is-invalid @enderror" 
                                                       type="checkbox" id="penerima_hadiah" name="penerima_hadiah" 
                                                       value="1" {{ old('penerima_hadiah', $siswa->penerima_hadiah) ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="penerima_hadiah">Penerima Hadiah</label>
                                                @error('penerima_hadiah')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Dokumen Pendukung -->
                            <div class="col-md-12">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Dokumen Pendukung</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="file_kk">File Kartu Keluarga</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input @error('file_kk') is-invalid @enderror" 
                                                               id="file_kk" name="file_kk">
                                                        <label class="custom-file-label" for="file_kk">
                                                            @if($siswa->file_kk)
                                                                {{ basename($siswa->file_kk) }}
                                                            @else
                                                                Pilih file...
                                                            @endif
                                                        </label>
                                                    </div>
                                                    <small class="form-text text-muted">Format: JPG, PNG, PDF. Maks: 2MB</small>
                                                    @if($siswa->file_kk)
                                                        <div class="mt-2">
                                                            <a href="{{ asset('storage/' . $siswa->file_kk) }}" target="_blank" class="btn btn-sm btn-info">
                                                                <i class="fas fa-eye"></i> Lihat
                                                            </a>
                                                        </div>
                                                    @endif
                                                    @error('file_kk')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="file_akta">File Akta Kelahiran</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input @error('file_akta') is-invalid @enderror" 
                                                               id="file_akta" name="file_akta">
                                                        <label class="custom-file-label" for="file_akta">
                                                            @if($siswa->file_akta)
                                                                {{ basename($siswa->file_akta) }}
                                                            @else
                                                                Pilih file...
                                                            @endif
                                                        </label>
                                                    </div>
                                                    <small class="form-text text-muted">Format: JPG, PNG, PDF. Maks: 2MB</small>
                                                    @if($siswa->file_akta)
                                                        <div class="mt-2">
                                                            <a href="{{ asset('storage/' . $siswa->file_akta) }}" target="_blank" class="btn btn-sm btn-info">
                                                                <i class="fas fa-eye"></i> Lihat
                                                            </a>
                                                        </div>
                                                    @endif
                                                    @error('file_akta')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="file_ijazah">File Ijazah</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input @error('file_ijazah') is-invalid @enderror" 
                                                               id="file_ijazah" name="file_ijazah">
                                                        <label class="custom-file-label" for="file_ijazah">
                                                            @if($siswa->file_ijazah)
                                                                {{ basename($siswa->file_ijazah) }}
                                                            @else
                                                                Pilih file...
                                                            @endif
                                                        </label>
                                                    </div>
                                                    <small class="form-text text-muted">Format: JPG, PNG, PDF. Maks: 2MB</small>
                                                    @if($siswa->file_ijazah)
                                                        <div class="mt-2">
                                                            <a href="{{ asset('storage/' . $siswa->file_ijazah) }}" target="_blank" class="btn btn-sm btn-info">
                                                                <i class="fas fa-eye"></i> Lihat
                                                            </a>
                                                        </div>
                                                    @endif
                                                    @error('file_ijazah')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="file_pas_foto">Pas Foto</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input @error('file_pas_foto') is-invalid @enderror" 
                                                               id="file_pas_foto" name="file_pas_foto">
                                                        <label class="custom-file-label" for="file_pas_foto">
                                                            @if($siswa->file_pas_foto)
                                                                {{ basename($siswa->file_pas_foto) }}
                                                            @else
                                                                Pilih file...
                                                            @endif
                                                        </label>
                                                    </div>
                                                    <small class="form-text text-muted">Format: JPG, PNG. Maks: 2MB</small>
                                                    @if($siswa->file_pas_foto)
                                                        <div class="mt-2">
                                                            <a href="{{ asset('storage/' . $siswa->file_pas_foto) }}" target="_blank" class="btn btn-sm btn-info">
                                                                <i class="fas fa-eye"></i> Lihat
                                                            </a>
                                                        </div>
                                                    @endif
                                                    @error('file_pas_foto')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="file_foto_ijazah">File Foto Ijazah</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input @error('file_foto_ijazah') is-invalid @enderror" 
                                                               id="file_foto_ijazah" name="file_foto_ijazah">
                                                        <label class="custom-file-label" for="file_foto_ijazah">
                                                            @if($siswa->file_foto_ijazah)
                                                                {{ basename($siswa->file_foto_ijazah) }}
                                                            @else
                                                                Pilih file...
                                                            @endif
                                                        </label>
                                                    </div>
                                                    <small class="form-text text-muted">Format: JPG, PNG, PDF. Maks: 2MB</small>
                                                    @if($siswa->file_foto_ijazah)
                                                        <div class="mt-2">
                                                            <a href="{{ asset('storage/' . $siswa->file_foto_ijazah) }}" target="_blank" class="btn btn-sm btn-info">
                                                                <i class="fas fa-eye"></i> Lihat
                                                            </a>
                                                        </div>
                                                    @endif
                                                    @error('file_foto_ijazah')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="file_transkrip_nilai">File Transkrip Nilai</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input @error('file_transkrip_nilai') is-invalid @enderror" 
                                                               id="file_transkrip_nilai" name="file_transkrip_nilai">
                                                        <label class="custom-file-label" for="file_transkrip_nilai">
                                                            @if($siswa->file_transkrip_nilai)
                                                                {{ basename($siswa->file_transkrip_nilai) }}
                                                            @else
                                                                Pilih file...
                                                            @endif
                                                        </label>
                                                    </div>
                                                    <small class="form-text text-muted">Format: JPG, PNG, PDF. Maks: 2MB</small>
                                                    @if($siswa->file_transkrip_nilai)
                                                        <div class="mt-2">
                                                            <a href="{{ asset('storage/' . $siswa->file_transkrip_nilai) }}" target="_blank" class="btn btn-sm btn-info">
                                                                <i class="fas fa-eye"></i> Lihat
                                                            </a>
                                                        </div>
                                                    @endif
                                                    @error('file_transkrip_nilai')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="file_dokumen_tambahan_1">Dokumen Tambahan 1</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input @error('file_dokumen_tambahan_1') is-invalid @enderror" 
                                                               id="file_dokumen_tambahan_1" name="file_dokumen_tambahan_1">
                                                        <label class="custom-file-label" for="file_dokumen_tambahan_1">
                                                            @if($siswa->file_dokumen_tambahan_1)
                                                                {{ basename($siswa->file_dokumen_tambahan_1) }}
                                                            @else
                                                                Pilih file...
                                                            @endif
                                                        </label>
                                                    </div>
                                                    <small class="form-text text-muted">Format: JPG, PNG, PDF. Maks: 2MB</small>
                                                    @if($siswa->file_dokumen_tambahan_1)
                                                        <div class="mt-2">
                                                            <a href="{{ asset('storage/' . $siswa->file_dokumen_tambahan_1) }}" target="_blank" class="btn btn-sm btn-info">
                                                                <i class="fas fa-eye"></i> Lihat
                                                            </a>
                                                        </div>
                                                    @endif
                                                    @error('file_dokumen_tambahan_1')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                                <a href="{{ route('admin.siswa.index') }}" class="btn btn-default">
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
    
    // Calculate skor akhir when nilai fields change
    $('#rerata_nilai_rapor, #nilai_akreditasi_sekolah, #indeks_sekolah_asal').on('change', function() {
        var rerata = parseFloat($('#rerata_nilai_rapor').val()) || 0;
        var akreditasi = parseFloat($('#nilai_akreditasi_sekolah').val()) || 0;
        var indeks = parseFloat($('#indeks_sekolah_asal').val()) || 0;
        
        var skor_akhir = (rerata * 0.5) + (akreditasi * 0.2) + (indeks * 0.3);
        $('#skor_akhir').val(skor_akhir.toFixed(2));
    });
</script>
@endpush
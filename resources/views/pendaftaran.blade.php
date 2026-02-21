@extends('layouts.app')
@section('content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12 mt-2">
                <div class="card">
                    <div class="card-body pt-4 p-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body p-4">
                                        @if ($mahasiswa->status_kkn === 'Belum Daftar')
                                            <form action="{{ route('mahasiswa.biodata.update') }}" method="POST" id="biodataForm">
                                                @csrf
                                                <div class="row px-3 mt-2">
                                                    <div class="col-12 mb-4">
                                                        <h5 class="font-weight-bolder">Pendaftaran KKN</h5>
                                                        <p class="text-sm text-secondary">Lengkapi biodata di bawah ini dengan benar sebelum menyimpan.</p>
                                                    </div>
                                                    
                                                    <!-- No HP -->
                                                    <div class="col-md-6 mb-4">
                                                        <div class="input-group input-group-static">
                                                            <label for="no_hp" class="ms-0">No HP</label>
                                                            <input type="text" class="form-control" id="no_hp" name="no_hp"
                                                                value="{{ old('no_hp', $mahasiswa->no_hp) }}"
                                                                placeholder="Masukkan nomor HP">
                                                        </div>
                                                    </div>

                                                    <!-- No HP Darurat -->
                                                    <div class="col-md-6 mb-4">
                                                        <div class="input-group input-group-static">
                                                            <label for="no_hp_darurat" class="ms-0">No HP Darurat</label>
                                                            <input type="text" class="form-control" id="no_hp_darurat"
                                                                name="no_hp_darurat" placeholder="Masukkan nomor HP darurat"
                                                                value="{{ old('no_hp_darurat', $mahasiswa->no_hp_darurat) }}">
                                                        </div>
                                                    </div>

                                                    <!-- Jenis Kelamin -->
                                                    <div class="col-md-6 mb-4">
                                                        <div class="input-group input-group-static">
                                                            <label for="jenis_kelamin" class="ms-0">Jenis Kelamin</label>
                                                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                                                <option value="">- Pilih Jenis Kelamin -</option>
                                                                <option value="L" {{ $mahasiswa->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                                                <option value="P" {{ $mahasiswa->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- Ukuran Jaket/Rompi -->
                                                    <div class="col-md-6 mb-4">
                                                        <div class="input-group input-group-static">
                                                            <label for="ukuran_jacket_rompi" class="ms-0">Ukuran Jaket/Rompi</label>
                                                            <select class="form-control" id="ukuran_jacket_rompi" name="ukuran_jacket_rompi">
                                                                <option value="">- Pilih Rompi -</option>
                                                                @foreach(['S', 'M', 'L', 'XL', 'XXL', '3XL'] as $uk)
                                                                    <option value="{{ $uk }}" {{ $mahasiswa->ukuran_jacket_rompi == $uk ? 'selected' : '' }}>
                                                                        {{ $uk }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- Punya Kendaraan -->
                                                    <div class="col-md-6 mb-4">
                                                        <div class="input-group input-group-static">
                                                            <label for="punya_kendaraan" class="ms-0">Mempunyai Kendaraan</label>
                                                            <select class="form-control" id="punya_kendaraan" name="punya_kendaraan">
                                                                <option value="">- Kepemilikan Kendaraan -</option>
                                                                <option value="Punya" {{ $mahasiswa->punya_kendaraan == 'Punya' ? 'selected' : '' }}>Ya</option>
                                                                <option value="Tidak" {{ $mahasiswa->punya_kendaraan == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- Tipe Kendaraan  -->
                                                    <div class="col-md-6 mb-4">
                                                        <div class="input-group input-group-static">
                                                            <label for="tipe_kendaraan" class="ms-0">Tipe Kendaraan</label>
                                                            <select class="form-control" id="tipe_kendaraan" name="tipe_kendaraan">
                                                                <option value="">- Tipe Kendaraan -</option>
                                                                <option value="Tidak Ada" {{ $mahasiswa->tipe_kendaraan == 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada Kendaraan</option>
                                                                <option value="Mobil" {{ $mahasiswa->tipe_kendaraan == 'Mobil' ? 'selected' : '' }}>Mobil</option>
                                                                <option value="Sepeda Motor" {{ $mahasiswa->tipe_kendaraan == 'Sepeda Motor' ? 'selected' : '' }}>Sepeda Motor</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- Punya Lisensi  -->
                                                    <div class="col-md-6 mb-4">
                                                        <div class="input-group input-group-static">
                                                            <label for="punya_lisensi" class="ms-0">Mempunyai Lisensi</label>
                                                            <select class="form-control" id="punya_lisensi" name="punya_lisensi">
                                                                <option value="">- Pilih Lisensi -</option>
                                                                @foreach(['Tidak Ada', 'SIM A', 'SIM B', 'SIM C', 'Lainnya'] as $lisensi)
                                                                    <option value="{{ $lisensi }}" {{ $mahasiswa->punya_lisensi == $lisensi ? 'selected' : '' }}>
                                                                        {{ $lisensi }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- Keahlian -->
                                                    <div class="col-md-6 mb-4">
                                                        <div class="input-group input-group-static">
                                                            <label for="keahlian" class="ms-0">Keahlian Tambahan</label>
                                                            <input type="text" class="form-control" id="keahlian" name="keahlian"
                                                                value="{{ old('keahlian', $mahasiswa->keahlian) }}" placeholder="Contoh: Desain Grafis, Menulis, dll">
                                                        </div>
                                                    </div>

                                                    <!-- Tombol Submit -->
                                                    <div class="col-12 text-end mt-2 mb-1">
                                                        <button type="submit" class="btn bg-gradient-dark px-4 py-2">
                                                            <i class="material-symbols-rounded text-white me-2">save</i>Simpan Biodata
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        @else   
                                            <form action="" method="POST" id="biodataForm">
                                                @csrf
                                                <div class="row px-3 mt-2">
                                                    <div class="col-12 mb-4">
                                                        <h5 class="font-weight-bolder">Pendaftaran KKN</h5>
                                                        <p class="text-sm text-secondary">Biodata Anda telah disimpan dan tidak dapat diubah lagi.</p>
                                                    </div>
                                                    
                                                    <!-- No HP -->
                                                    <div class="col-md-6 mb-4">
                                                        <div class="input-group input-group-static">
                                                            <label for="no_hp" class="ms-0">No HP</label>
                                                            <input type="text" class="form-control" id="no_hp" name="no_hp"
                                                                value="{{ old('no_hp', $mahasiswa->no_hp) }}"
                                                                placeholder="Masukkan nomor HP" disabled>
                                                        </div>
                                                    </div>

                                                    <!-- No HP Darurat -->
                                                    <div class="col-md-6 mb-4">
                                                        <div class="input-group input-group-static">
                                                            <label for="no_hp_darurat" class="ms-0">No HP Darurat</label>
                                                            <input type="text" class="form-control" id="no_hp_darurat"
                                                                name="no_hp_darurat" placeholder="Masukkan nomor HP darurat"
                                                                value="{{ old('no_hp_darurat', $mahasiswa->no_hp_darurat) }}" disabled>
                                                        </div>
                                                    </div>

                                                    <!-- Jenis Kelamin -->
                                                    <div class="col-md-6 mb-4">
                                                        <div class="input-group input-group-static">
                                                            <label for="jenis_kelamin" class="ms-0">Jenis Kelamin</label>
                                                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" disabled>
                                                                <option value="">- Pilih Jenis Kelamin -</option>
                                                                <option value="L" {{ $mahasiswa->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                                                <option value="P" {{ $mahasiswa->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- Ukuran Jaket/Rompi -->
                                                    <div class="col-md-6 mb-4">
                                                        <div class="input-group input-group-static">
                                                            <label for="ukuran_jacket_rompi" class="ms-0">Ukuran Jaket/Rompi</label>
                                                            <select class="form-control" id="ukuran_jacket_rompi" name="ukuran_jacket_rompi" disabled>
                                                                <option value="">- Pilih Rompi -</option>
                                                                @foreach(['S', 'M', 'L', 'XL', 'XXL', '3XL'] as $uk)
                                                                    <option value="{{ $uk }}" {{ $mahasiswa->ukuran_jacket_rompi == $uk ? 'selected' : '' }}>
                                                                        {{ $uk }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- Punya Kendaraan -->
                                                    <div class="col-md-6 mb-4">
                                                        <div class="input-group input-group-static">
                                                            <label for="punya_kendaraan" class="ms-0">Mempunyai Kendaraan</label>
                                                            <select class="form-control" id="punya_kendaraan" name="punya_kendaraan" disabled>
                                                                <option value="">- Kepemilikan Kendaraan -</option>
                                                                <option value="Punya" {{ $mahasiswa->punya_kendaraan == 'Punya' ? 'selected' : '' }}>Ya</option>
                                                                <option value="Tidak" {{ $mahasiswa->punya_kendaraan == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- Tipe Kendaraan  -->
                                                    <div class="col-md-6 mb-4">
                                                        <div class="input-group input-group-static">
                                                            <label for="tipe_kendaraan" class="ms-0">Tipe Kendaraan</label>
                                                            <select class="form-control" id="tipe_kendaraan" name="tipe_kendaraan" disabled>
                                                                <option value="">- Tipe Kendaraan -</option>
                                                                <option value="Tidak Ada" {{ $mahasiswa->tipe_kendaraan == 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada Kendaraan</option>
                                                                <option value="Mobil" {{ $mahasiswa->tipe_kendaraan == 'Mobil' ? 'selected' : '' }}>Mobil</option>
                                                                <option value="Sepeda Motor" {{ $mahasiswa->tipe_kendaraan == 'Sepeda Motor' ? 'selected' : '' }}>Sepeda Motor</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- Punya Lisensi  -->
                                                    <div class="col-md-6 mb-4">
                                                        <div class="input-group input-group-static">
                                                            <label for="punya_lisensi" class="ms-0">Mempunyai Lisensi</label>
                                                            <select class="form-control" id="punya_lisensi" name="punya_lisensi" disabled>
                                                                <option value="">- Pilih Lisensi -</option>
                                                                @foreach(['Tidak Ada', 'SIM A', 'SIM B', 'SIM C', 'Lainnya'] as $lisensi)
                                                                    <option value="{{ $lisensi }}" {{ $mahasiswa->punya_lisensi == $lisensi ? 'selected' : '' }}>
                                                                        {{ $lisensi }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- Keahlian -->
                                                    <div class="col-md-6 mb-4">
                                                        <div class="input-group input-group-static">
                                                            <label for="keahlian" class="ms-0">Keahlian Tambahan</label>
                                                            <input type="text" class="form-control" id="keahlian" name="keahlian"
                                                                value="{{ old('keahlian', $mahasiswa->keahlian) }}" placeholder="Contoh: Desain Grafis, Menulis, dll" disabled>
                                                        </div>
                                                    </div>

                                                    <!-- Tombol Submit -->
                                                    <div class="col-12 text-end mt-2 mb-1">
                                                        <button type="submit" class="btn bg-gradient-dark px-4 py-2" disabled>
                                                            <i class="material-symbols-rounded text-white me-2">save</i>Simpan Biodata
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Footer --}}
        @include('layouts.footer')
        {{-- End footer --}}
    </div>

    {{-- SweetAlert2 CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Script Konfirmasi Submit --}}
    <script>
        document.getElementById('biodataForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            Swal.fire({
                title: 'Konfirmasi Data',
                text: 'Anda yakin data yang Anda masukkan sudah benar?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    </script>

    {{-- error/success/warning handle sweet alert --}}
    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                customClass: {
                popup: 'glass-popup rounded-3xl shadow-blur p-6',
                title: 'font-semibold',
                icon: 'icon-custom bg-transparent'
                },
                timer: 2000
            });
        @elseif (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Data Anda Tidak Sesuai!',
                text: "{{ session('error') }}",
                showConfirmButton: true,
                customClass: {
                    popup: 'glass-popup rounded-3xl shadow-blur p-6',
                    title: 'font-semibold',
                    icon: 'icon-custom bg-transparent'
                }
            });
        @elseif (session('warning'))
            Swal.fire({
                icon: 'warning',
                text: "{{ session('warning') }}",
                showConfirmButton: false,
                customClass: {
                popup: 'glass-popup rounded-3xl shadow-blur p-6',
                title: 'font-semibold',
                icon: 'icon-custom bg-transparent'
                },
                timer: 2000
            });
        @endif

        @if($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                customClass: {
                popup: 'glass-popup rounded-3xl shadow-blur p-6',
                title: 'font-bold',
                confirmButton: 'button-confirm px-6 py-2 rounded-xl text-white',
                }
            });
        @endif
    </script>
@endsection
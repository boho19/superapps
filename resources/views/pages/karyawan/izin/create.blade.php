<x-karyawan-layout>
    <!-- main page content -->
    <div class="col-auto align-self-center">
        <a href="{{ route('izin') }}" class="btn btn-link back-btn text-color-theme">
            <i class="bi bi-arrow-left size-20"></i>
        </a>
    </div>

    <div class="col-12">
        <div class="card card-light shadow-sm">
            <div class="col text-center align-self-center mt-4">
                <h3>Buat Izin</h3>
            </div>
            <div class="card-body">
                <form class="row" method="POST" action="/izin/store" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_karyawan" value="{{ Auth::user()->id }}">
                    <!-- keterangan -->
                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <div class="form-group form-floating">
                            <select class="form-control" id="keterangan" name="keterangan" required>
                                <option disabled {{ old('keterangan') ? '' : 'selected' }}>Pilih Keterangan</option>
                                <option value="sakit" {{ old('keterangan') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                                <option value="cuti" {{ old('keterangan') == 'cuti' ? 'selected' : '' }}>Cuti</option>
                            </select>
                            <label class="form-control-label" for="keterangan">Keterangan</label>
                        </div>
                    </div>
                    <!-- waktu mulai -->
                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <div class="form-group form-floating">
                            <input type="date" class="form-control" id="mulai" name="mulai" value="{{ old('mulai') }}" required>
                            <label class="form-control-label" for="mulai">Waktu Mulai</label>
                        </div>
                    </div>
                    <!-- Waktu selesai -->
                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <div class="form-group form-floating">
                            <input type="date" class="form-control" id="selesai" name="selesai" value="{{ old('selesai') }}" required>
                            <label class="form-control-label" for="selesai">Waktu Selesai</label>
                        </div>
                    </div>
                    <!-- alasan input -->
                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <div class="form-group form-floating">
                            <input type="text" class="form-control" id="alasan" name="alasan" placeholder="Alasan" value="{{ old('alasan') }}" required>
                            <label class="form-control-label" for="alasan">Alasan</label>
                        </div>
                    </div>
                    <!-- photo input -->
                    <div id="bukti-sakit" class="col-12 col-md-6 col-lg-4 mb-3" style="display: none;">
                        <div class="form-group form-floating">
                            <input type="file" class="form-control" id="bukti" name="bukti">
                            <label class="form-control-label" for="bukti">Upload Foto</label>
                        </div>
                    </div>
            
                    <div class="col-12 text-center">
                        <x-primary-button>Submit</x-primary-button>
                    </div>
                </form>
                <script>
                    document.getElementById('keterangan').addEventListener('change', function() {
                        let photoInputContainer = document.getElementById('bukti-sakit');
                        let photoInput = document.getElementById('bukti');
                        if (this.value === 'sakit') {
                            photoInputContainer.style.display = 'block';
                            photoInput.setAttribute('required', 'required');
                        } else {
                            photoInputContainer.style.display = 'none';
                            photoInput.removeAttribute('required');
                        }
                    });
            
                    // Trigger the change event on page load to handle the old value case
                    document.getElementById('keterangan').dispatchEvent(new Event('change'));
                </script>
            </div>
            
        </div>
    </div>
    <!-- main page content ends -->
</x-karyawan-layout>

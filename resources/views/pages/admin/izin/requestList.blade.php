<x-admin-layout>
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">List Request Perizinan</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">List Request Perizinan</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <span><i class="fas fa-table me-1"></i>Tabel Request Perizinan</span>
                        <div class="d-flex justify-content-end gap-2">
                            <span class=" pt-1"><input type="checkbox" id="check-all"><label for="check-all" class="px-2">Check all</label></span>
                            <button class="btn btn-sm btn-success" onclick="updateValidasiCheck('disetujui')">Terima</button>
                            <button class="btn btn-sm btn-danger" onclick="updateValidasiCheck('ditolak')">Tolak</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatablesSimple" class="table table-striped " style="width:100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Keterangan</th>
                                    <th>Alasan</th>
                                    <th>Mulai</th>
                                    <th>Selesai</th>
                                    <th>Bukti</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($izins as $index => $izin)
                                    <tr>
                                        <td><input type="checkbox" class="checkbox-item" id="check-{{ $izin->hashid }}"></td>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $izin->karyawan->nama }}</td>
                                        <td>
                                            @if ($izin->keterangan == 'sakit')
                                                <span class="badge bg-warning">{{ $izin->keterangan }}</span>
                                            @else
                                                <span class="badge bg-primary">{{ $izin->keterangan }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $izin->alasan }}</td>
                                        <td>{{ $izin->mulai }}</td>
                                        <td>{{ $izin->selesai }}</td>
                                        <td>
                                            @if ($izin->bukti == null)
                                                <span class="badge bg-secondary">--</span>
                                            @else
                                                <img src="{{ asset('assets/img/perizinan').'/'.$izin->bukti }}" alt="foto" width="30px">
                                            @endif
                                        </td>
                                        <td>
                                            @if ($izin->status == 'disetujui')
                                            <span class="badge bg-success">{{ ucwords($izin->status) }}</span>
                                            @elseif($izin->status == 'tertunda')
                                            <span class="badge bg-warning">{{ ucwords($izin->status) }}</span>
                                            @else
                                            <span class="badge bg-danger">{{ ucwords($izin->status) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-success" onclick="updateValidasi('{{ $izin->hashid }}', 'disetujui')">Terima</button>
                                            <button class="btn btn-sm btn-danger" onclick="updateValidasi('{{ $izin->hashid }}', 'ditolak')">Tolak</button>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#detailModal"
                                                data-nama="{{ $izin->karyawan->nama }}"
                                                data-keterangan="{{ $izin->keterangan }}"
                                                data-alasan="{{ $izin->alasan }}"
                                                data-mulai="{{ $izin->mulai }}"
                                                data-selesai="{{ $izin->selesai }}"
                                                {{-- data-bukti="{{ asset('assets/img/perizinan').'/'.$izin->bukti }}"> --}}
                                                data-bukti="{{ $izin->bukti }}">
                                                Detail
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Modal -->
                        <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailModalLabel">Detail Perizinan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <h5 id="modalNama"></h5>
                                    <p style="margin:0; padding:0" id="modalKategori"></p>
                                    <p id="modalKeterangan"></p>
                                    <p id="modalDurasi"></p>
                                    <div id="modalBukti"></div>
                                    {{-- <img id="modalBukti" src="" alt="foto" width="400px"> --}}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const detailModal = document.getElementById('detailModal');
            detailModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const nama = button.getAttribute('data-nama');
                const keterangan = button.getAttribute('data-keterangan');
                const alasan = button.getAttribute('data-alasan');
                const mulai = button.getAttribute('data-mulai');
                const selesai = button.getAttribute('data-selesai');
                const bukti = button.getAttribute('data-bukti');

                const modalNama = document.getElementById('modalNama');
                const modalKategori = document.getElementById('modalKategori');
                const modalAlasan = document.getElementById('modalAlasan');
                const modalDurasi = document.getElementById('modalDurasi');
                const modalBukti = document.getElementById('modalBukti');

                // Tentukan kelas badge berdasarkan nilai keterangan
                let badgeClass = '';
                if (keterangan === 'cuti') {
                    badgeClass = 'bg-primary';
                } else if (keterangan === 'sakit') {
                    badgeClass = 'bg-warning';
                }

                modalNama.textContent = `Nama: ${nama}`;
                modalKategori.innerHTML = `<span class="badge ${badgeClass}">${keterangan}</span>`;
                modalKeterangan.innerHTML = `Keterangan: <br> ${alasan}`;
                modalDurasi.innerHTML = `<span class="badge bg-success">${mulai}</span> - <span class="badge bg-success">${selesai}</span>`;
                // modalBukti.src = bukti;
               // Atur src gambar berdasarkan nilai bukti
                if (bukti) {
                    modalBukti.innerHTML = `<img src="{{ asset('assets/img/perizinan') }}/${bukti}" width="400px">`;
                    modalBuktiText.textContent = '';
                } else {
                    modalBukti.innerHTML = '';
                    modalBuktiText.textContent = '-';
                }
                });
            });
    </script>
    <script>
        // Set CSRF token for every AJAX request
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function showToast(type, title, message) {
            iziToast[type]({
                title: title,
                message: message,
                position: 'bottomRight'
            });
        }

        function updateValidasi(id, need){
            let isUpdate;
            if(need=='disetujui'){
                isUpdate = confirm(`Yakin ingin TERIMA izin karyawan ini?`);
            }else{
                isUpdate = confirm(`Yakin ingin TOLAK izin karyawan ini?`);
            }
            if(!isUpdate) return
            const ids = [];
            ids.push(id);
            $.ajax({
                url: `/admin/izin/validate`,
                method: "PATCH",
                contentType: "application/json",
                data: JSON.stringify({ids, need}),
                success: (response) => {
                    showToast('success', 'Success', `${response.status.message}`);
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                },
                error: (response) => {
                    const message = response.responseJSON.status.message;
                    showToast('error', 'Error', `${message}`);
                }
            });
        }

        // Event handler untuk checkbox "check all"
        $('#check-all').on('change', function() {
            $('.checkbox-item').prop('checked', $(this).prop('checked'));
            updateCheckedIds();
        });

        // Event handler untuk setiap checkbox item
        $('.checkbox-item').on('change', function() {
            if ($('.checkbox-item:checked').length === $('.checkbox-item').length) {
                $('#check-all').prop('checked', true);
            } else {
                $('#check-all').prop('checked', false);
            }
            updateCheckedIds();
        });

        // Fungsi untuk mengupdate array id checkbox yang dicentang
        function updateCheckedIds() {
            const checkedIds = [];
            $('.checkbox-item:checked').each(function() {
                const checkid = $(this).attr('id').split("-")
                checkedIds.push(checkid[1]);
            });
            return checkedIds // Tampilkan array ID di console
        }

        function updateValidasiCheck(need){
            const ids = updateCheckedIds();
            if(ids.length == 0) return alert("Maaf, tidak ada izin yang dipilih");
            const listIds = ids.join(", ")
            let isUpdate;
            if(need=='disetujui'){
                isUpdate = confirm(`Yakin ingin TERIMA izin karyawan dengan id permohonan: ${listIds}?`);
            }else{
                isUpdate = confirm(`Yakin ingin TOLAK izin karyawan dengan id permohonan: ${listIds}??`);
            }
            if(!isUpdate) return
            $.ajax({
                url: `/admin/izin/validate`,
                method: "PATCH",
                contentType: "application/json",
                data: JSON.stringify({ids, need}),
                success: (response) => {
                    showToast('success', 'Success', `${response.status.message}`);
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                },
                error: (response) => {
                    const message = response.responseJSON.status.message;
                    showToast('error', 'Error', `${message}`);
                }
            });
        }

    </script>
</x-admin-layout>

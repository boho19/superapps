<x-admin-layout>
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">List Karyawan Pending</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">List Karyawan Pending</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <span><i class="fas fa-table me-1"></i>Tabel Karyawan Pending</span>
                        <div class="d-flex justify-content-end gap-1">
                            <span class=" pt-1"><input type="checkbox" id="check-all"><label for="check-all" class="px-2">Check all</label></span>
                            <button class="btn btn-sm btn-success" onclick="updateValidasiCheck('disetujui')">Terima</button>
                            <button class="btn btn-sm btn-danger" onclick="updateValidasiCheck('ditolak')">Tolak</button>
                        </div>
                    </div>
                </div>
                <div class="card-body text-center">
                    <div class="table-responsive">
                        <table id="datatablesSimple" class="table table-striped " style="width:100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>No</th>
                                    <th>Email</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Nomor Hp</th>
                                    <th>Foto</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($karyawans as $index => $karyawan)
                                    <tr>
                                        <td><input type="checkbox" class="checkbox-item" id="check-{{ $karyawan->user->hashid }}"></td>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $karyawan->user->email }}</td>
                                        <td>{{ $karyawan->nik }}</td>
                                        <td>{{ $karyawan->nama }}</td>
                                        <td>
                                            @if ($karyawan->jenis_kelamin == 'LK')
                                            <span class="badge bg-primary">{{ $karyawan->jenis_kelamin }}</span>
                                            @else
                                            <span class="badge bg-danger">{{ $karyawan->jenis_kelamin }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $karyawan->no_hp }}</td>
                                        <td><img src="{{ asset('assets/img/profile').'/'.$karyawan->foto }}" alt="foto" width="30px"></td>
                                        <td>
                                            <button class="btn btn-sm btn-success" onclick="updateValidasi('{{ $karyawan->user->hashid }}', 'disetujui')">Terima</button>
                                            <button class="btn btn-sm btn-danger" onclick="updateValidasi('{{ $karyawan->user->hashid }}', 'ditolak')">Tolak</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
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
                isUpdate = confirm(`Yakin ingin TERIMA data karyawan ini?`);
            }else{
                isUpdate = confirm(`Yakin ingin TOLAK data karyawan ini?`);
            }
            if(!isUpdate) return
            const ids = [];
            ids.push(id);
            $.ajax({
                url: `/admin/karyawan/validate`,
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
            if(ids.length == 0) return alert("Maaf, tidak ada karyawan yang dipilih");
            const listIds = ids.join(", ")
            let isUpdate;
            if(need=='disetujui'){
                isUpdate = confirm(`Yakin ingin TERIMA data karyawan dengan id ${listIds}?`);
            }else{
                isUpdate = confirm(`Yakin ingin TOLAK data karyawan dengan id ${listIds}??`);
            }
            if(!isUpdate) return
            $.ajax({
                url: `/admin/karyawan/validate`,
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

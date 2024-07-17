<x-admin-layout>
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Edit Karyawan</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Edit Karyawan</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Edit Karyawan
                </div>
                <div class="card-body text-center">
                    @include('pages.admin.karyawan.partials.update-karyawan-form')
                </div>
            </div>
        </div>
    </main>
</x-admin-layout>

@extends('layouts.app')
@push('styles')
<style>

    #dt-search-0  {
    background-color: #ffffff !important;
    color: #111827 !important; /* Tailwind gray-900 */
    }
    #dt-length-0 {
    background-color: #ffffff !important;
    color: #111827 !important; /* Tailwind gray-900 */
    border-color: #e5e7eb !important; /* Tailwind gray-200 */
    }

/* === Pagination Buttons Default (First, Previous, Next, Last) === */
a[data-dt-idx="first"],
a[data-dt-idx="previous"],
a[data-dt-idx="next"],
a[data-dt-idx="last"] {
    background-color: #ffffff !important; /* putih */
    color: #374151 !important;            /* gray-700 */
    border: 1px solid #d1d5db !important; /* gray-300 */
}

/* Hover */
a[data-dt-idx="first"]:hover,
a[data-dt-idx="previous"]:hover,
a[data-dt-idx="next"]:hover,
a[data-dt-idx="last"]:hover {
    background-color: #f3f4f6 !important; /* gray-100 */
    color: #111827 !important;            /* gray-900 */
}

/* Disabled state */
a[data-dt-idx="first"][aria-disabled="true"],
a[data-dt-idx="previous"][aria-disabled="true"],
a[data-dt-idx="next"][aria-disabled="true"],
a[data-dt-idx="last"][aria-disabled="true"] {
    background-color: #ffffff !important;
    color: #9ca3af !important; /* abu-abu */
    opacity: 0.6 !important;
    cursor: not-allowed !important;
}


</style>
@endpush
@section('content')
    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
    <div class="bg-white shadow rounded-lg p-6">
        Selamat datang di LMS KPU, {{ Auth::user()->name }} 👋
    </div>
    <br>
    <div class="container bg-white shadow rounded-lg p-6">
    <center><h2 class="text-xl font-bold mb-4">Grafik Berdasarkan Hasil Post Test KPPS</h2></center>
    <canvas id="accuracyChart"></canvas>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Data KPPS yang Sudah Mendaftar</h2>
        
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden p-4">
        <div class="overflow-x-auto">
            <table id="usersTable" class="min-w-full text-sm text-left text-gray-600">
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                    <tr>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>No. WA</th>
                        <th>TPS</th>
                        <th>Desa</th>
                        <th>Kecamatan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('accuracyChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: @json($labels),
        datasets: [{
            label: 'Jumlah Hasil Post Test',
            data: @json($data),
            borderColor: 'rgba(75, 192, 192, 1)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            fill: true,
            tension: 0.3
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: { beginAtZero: true, max: 100 }
        }
    }
});
</script>
<!-- jQuery + DataTables -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.tailwindcss.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.tailwindcss.css">

<script>
$(document).ready(function () {
    $('#usersTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("kpps-users.data") }}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'nik', name: 'nik' },
            { data: 'email', name: 'email' },
            { data: 'role', name: 'role' },
            { data: 'no_wa', name: 'no_wa' },
            { data: 'tps', name: 'tps' },
            { data: 'desa', name: 'desa' },
            { data: 'kecamatan', name: 'kecamatan' },
            { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
        ],
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            paginate: { previous: "‹", next: "›" }
        },
        dom:
      "<'flex justify-between items-center mb-4'<'dataTables_length'l><'dataTables_filter'f>>" +
      "t" +
      "<'flex justify-between items-center mt-4'<'dataTables_info'i><'dataTables_paginate'p>>",
    });
});
</script>
@endpush

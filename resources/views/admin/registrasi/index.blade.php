@extends('layouts.admin')

@section('title', 'Admin - Manajemen Pendaftaran HMIF')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-[#2a2d47]">Manajemen Pendaftaran HMIF</h1>
            <p class="mt-2 text-gray-600">Kelola pendaftaran anggota baru HMIF</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Total Applications -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-[#136ca9]">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Pendaftar</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_applications'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Pending Applications -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                        <i class="fas fa-clock text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Menunggu</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['pending_applications'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Approved Applications -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <i class="fas fa-check-circle text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Diterima</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['approved_applications'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Rejected Applications -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-red-100 text-red-600">
                        <i class="fas fa-times-circle text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Ditolak</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['rejected_applications'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Applications Table -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Daftar Pendaftar</h2>
            </div>

            <!-- Filters -->
            <div class="p-4 bg-gray-50 border-b border-gray-200">
                <form action="{{ route('admin.registrasi.index') }}" method="GET" class="flex flex-wrap gap-4">
                    <div class="flex-1 min-w-[200px]">
                        <input type="text" name="search" placeholder="Cari nama, NPM, atau email..." 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#136ca9] focus:border-transparent"
                               value="{{ request('search') }}">
                    </div>
                    <div class="w-[200px]">
                        <select name="status" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#136ca9] focus:border-transparent">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Diterima</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                    <button type="submit" 
                            class="px-4 py-2 bg-[#136ca9] text-white rounded-lg hover:bg-[#2a2d47] transition-colors duration-300">
                        <i class="fas fa-search mr-2"></i>
                        Filter
                    </button>
                </form>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                NPM
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tahun Angkatan
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal Daftar
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($applications as $application)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $application->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $application->npm }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $application->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $application->tahun_angkatan }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $application->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $application->status == 'approved' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $application->status == 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ ucfirst($application->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $application->submitted_at->format('d M Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-2">
                                        <!-- View Details Button -->
                                        <button type="button" 
                                                onclick="showDetails({{ $application->id }})"
                                                class="text-[#136ca9] hover:text-[#2a2d47]">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        <!-- Status Update Dropdown -->
                                        <div class="relative" x-data="{ open: false }">
                                            <button type="button" 
                                                    @click="open = !open"
                                                    class="text-gray-600 hover:text-gray-900">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div x-show="open" 
                                                 @click.away="open = false"
                                                 class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10">
                                                <form action="{{ route('admin.registrasi.update-status', $application) }}" method="POST" class="py-1">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" name="status" value="approved"
                                                            class="block w-full text-left px-4 py-2 text-sm text-green-700 hover:bg-green-50">
                                                        <i class="fas fa-check mr-2"></i>Terima
                                                    </button>
                                                    <button type="submit" name="status" value="rejected"
                                                            class="block w-full text-left px-4 py-2 text-sm text-red-700 hover:bg-red-50">
                                                        <i class="fas fa-times mr-2"></i>Tolak
                                                    </button>
                                                    <button type="submit" name="status" value="pending"
                                                            class="block w-full text-left px-4 py-2 text-sm text-yellow-700 hover:bg-yellow-50">
                                                        <i class="fas fa-clock mr-2"></i>Pending
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                    Tidak ada data pendaftaran
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                {{ $applications->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Application Details Modal -->
<div id="detailsModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-xl shadow-lg max-w-2xl w-full">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-gray-800">Detail Pendaftaran</h3>
                    <button type="button" onclick="closeDetails()" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="p-6" id="modalContent">
                <!-- Content will be loaded dynamically -->
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function showDetails(id) {
        const modal = document.getElementById('detailsModal');
        const content = document.getElementById('modalContent');
        
        // Show loading state
        content.innerHTML = '<div class="text-center py-4"><i class="fas fa-spinner fa-spin text-2xl text-[#136ca9]"></i></div>';
        modal.classList.remove('hidden');

        // Fetch application details
        fetch(`/admin/registrasi/${id}`)
            .then(response => response.json())
            .then(data => {
                content.innerHTML = `
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nama Lengkap</p>
                                <p class="mt-1">${data.name}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">NPM</p>
                                <p class="mt-1">${data.npm}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Email</p>
                                <p class="mt-1">${data.email}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nomor Telepon</p>
                                <p class="mt-1">${data.phone}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Tahun Angkatan</p>
                                <p class="mt-1">${data.tahun_angkatan}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Status</p>
                                <p class="mt-1">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        ${data.status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ''}
                                        ${data.status === 'approved' ? 'bg-green-100 text-green-800' : ''}
                                        ${data.status === 'rejected' ? 'bg-red-100 text-red-800' : ''}">
                                        ${data.status.charAt(0).toUpperCase() + data.status.slice(1)}
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Alasan Bergabung</p>
                            <p class="mt-1 text-gray-900">${data.alasan_masuk}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Tanggal Daftar</p>
                            <p class="mt-1">${new Date(data.submitted_at).toLocaleString('id-ID')}</p>
                        </div>
                    </div>
                `;
            })
            .catch(error => {
                content.innerHTML = `
                    <div class="text-center py-4 text-red-600">
                        <i class="fas fa-exclamation-circle text-2xl mb-2"></i>
                        <p>Gagal memuat detail pendaftaran</p>
                    </div>
                `;
            });
    }

    function closeDetails() {
        document.getElementById('detailsModal').classList.add('hidden');
    }
</script>
@endpush
@endsection 
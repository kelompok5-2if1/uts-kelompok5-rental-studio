<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Sistem Informasi Rental Studio Musik') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
          rel="stylesheet" />
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')
        <!-- Header -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset
        <!-- Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    {{-- SweetAlert Success --}}
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
            timer: 2000,
            showConfirmButton: false
        });
    </script>
    @endif
    {{-- SweetAlert Error --}}
    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error') }}'
        });
    </script>
    @endif
    {{-- SweetAlert Warning --}}
    @if(session('warning'))
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Peringatan',
            text: '{{ session('warning') }}'
        });
    </script>
    @endif
    {{-- Validation Error --}}
    @if($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Validasi Gagal',
            html: `
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            `
        });
    </script>
    @endif
    {{-- SweetAlert Delete Confirmation --}}
    <script>
        function confirmDelete(event) {
            event.preventDefault();

            const form = event.target.closest('form');

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Data yang sudah dihapus tidak dapat dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {

                    form.submit();

                }
            });

            return false;
        }
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {

        document.querySelectorAll('form').forEach(form => {

            const method = form.querySelector('input[name="_method"]');

            if (method && method.value === 'DELETE') {

                const btn = form.querySelector('button[type="submit"]');

                if (btn) {
                    btn.setAttribute('onclick', 'confirmDelete(event)');
                }

            }

        });

        document.querySelectorAll('form').forEach(function (form) {
            const method = (form.getAttribute('method') || 'get').toLowerCase();

            if (method === 'get') {
                return;
            }

            const submitButton = form.querySelector('button[type="submit"], input[type="submit"]');

            if (!submitButton) {
                return;
            }

            form.addEventListener('submit', function () {
                if (submitButton.tagName === 'BUTTON') {
                    const originalText = submitButton.dataset.originalText || submitButton.innerHTML;
                    submitButton.dataset.originalText = originalText;
                    submitButton.disabled = true;
                    submitButton.innerHTML = '<span class="inline-flex items-center gap-2"><svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg><span>Menyimpan...</span></span>';
                } else {
                    submitButton.dataset.originalValue = submitButton.value;
                    submitButton.value = 'Menyimpan...';
                    submitButton.disabled = true;
                }
            });
        });

    });
    </script>
</body>
</html>
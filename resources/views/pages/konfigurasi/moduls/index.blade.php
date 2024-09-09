@extends('layouts.app')

@section('content')
    <div style="width: 300px" class="mb-3">
        <h4 class="fw-bold py-3"><span class="fw-bold">{{ $title }}</h4>
        <button class="btn btn-success" tabindex="1" onclick="openModal('create')" data-bs-toggle="modal"
            data-bs-target="#modul-modal">Tambah
            Data</button>
    </div>

    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="datatables-basic table" id="manajemen-moduls">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>URL</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modul-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-edit-modal">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2"><span id="modal-title">Tambah Modul</span></h3>
                    </div>

                    {{-- Form --}}
                    <form method="POST" action="{{ route('konfigurasi.manajemen-modul.store') }}" id="form-moduls">
                        @csrf
                        <div class="mb-3">
                            <label for="grup" class="form-label">Grup</label>
                            <select id="grup"
                                class="select2 form-select form-select-lg @error('grup') is-invalid @enderror"
                                data-allow-clear="true" name="grup" required>
                                @foreach ($moduls as $modul)
                                    <option value="{{ $modul->kode_modul }}-{{ strtoupper($modul->nama_modul) }}">
                                        {{ $modul->kode_modul }}-{{ strtoupper($modul->nama_modul) }}</option>
                                @endforeach
                            </select>
                            @error('grup')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Nama Modul</label>
                            <input type="text" class="form-control @error('nama_modul') is-invalid @enderror"
                                id="basic-default-fullname" name="nama_modul" required />
                            @error('nama_modul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">URL</label>
                            <input type="text" class="form-control @error('nama_url') is-invalid @enderror"
                                id="basic-default-fullname" name="nama_url" />
                            @error('nama_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                    {{-- End of Form --}}

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @if (session('success'))
        <script>
            Swal.fire(
                'Success!',
                '{{ session('success') }}',
                'success'
            )
        </script>
    @elseif($errors->any())
        <script>
            Swal.fire(
                'Error!',
                'Terdapat kesalahan. Harap periksa kembali form.',
                'error'
            )
        </script>
    @elseif(session('error'))
        <script>
            Swal.fire(
                'Error!',
                '{{ session('error') }}',
                'error'
            )
        </script>
    @endif
    <script>
        // Global Search
        var searchString = '';
        var isModalOpen = false; // Flag untuk mendeteksi apakah modal terbuka
        var debounceTimeout; // Variabel untuk menyimpan timeout debounce
        var currentIndex = -1; // Indeks baris yang dipilih saat ini
        $(document).ready(function() {
            // Init DataTable
            var table = $('#manajemen-moduls').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('konfigurasi.manajemen-modul.index') }}',
                columns: [{
                        data: 'id',
                        name: 'id',
                    },
                    {
                        data: 'key',
                        name: 'key'
                    },
                    {
                        data: 'nama_modul',
                        name: 'nama_modul'
                    },
                    {
                        data: 'nama_url',
                        name: 'nama_url'
                    },
                    {
                        data: 'textlevel',
                        name: 'textlevel'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // // Fungsi untuk debounce pencarian
            // function debounceSearch() {
            //     clearTimeout(debounceTimeout);
            //     debounceTimeout = setTimeout(function() {
            //         if (!isModalOpen) {
            //             table.search(searchString).draw();
            //         }
            //     }, 200);
            // }

            // // Fungsi untuk membuka modal tambah data
            // function openAddModal() {
            //     isModalOpen = true;
            //     openModal('create');
            // }

            // // Fungsi untuk membuka modal update berdasarkan data row yang dipilih
            // function openUpdateModal(data) {
            //     isModalOpen = true;
            //     openModal('edit', data.id);
            // }

            // // Event untuk menutup modal dan mengaktifkan kembali fitur pencarian
            // $('#user-modal').on('hidden.bs.modal', function() {
            //     isModalOpen = false;
            // });

            // // Fungsi untuk menavigasi tabel menggunakan panah atas dan bawah
            // function navigateTable(direction) {
            //     var rowCount = table.rows().count(); // Total jumlah baris dalam DataTable

            //     if (direction === 'up') {
            //         if (currentIndex > 0) {
            //             currentIndex--; // Pindah ke baris sebelumnya
            //         } else if (currentIndex === 0) {
            //             // Jika berada di baris pertama dan menekan panah atas, hilangkan seleksi
            //             currentIndex = -1;
            //             table.$('tr.selected').removeClass('selected');
            //             return;
            //         }
            //     } else if (direction === 'down' && currentIndex < rowCount - 1) {
            //         currentIndex++; // Pindah ke baris berikutnya
            //     }

            //     // Hapus semua baris yang dipilih sebelumnya
            //     table.$('tr.selected').removeClass('selected');

            //     // Jika ada baris yang valid (currentIndex >= 0), pilih baris baru berdasarkan currentIndex
            //     if (currentIndex >= 0) {
            //         var row = $(table.row(currentIndex).node());
            //         row.addClass('selected');

            //         // Gulung halaman untuk memastikan baris terlihat
            //         $('html, body').animate({
            //             scrollTop: row.offset().top - 200
            //         }, 200);
            //     }
            // }

            // // Fungsi untuk memeriksa apakah karakter yang ditekan valid untuk pencarian
            // function isValidSearchKey(event) {
            //     // Cek jika tombol yang ditekan adalah huruf, angka, atau spasi
            //     var charCode = event.which || event.keyCode;
            //     return (
            //         (charCode >= 48 && charCode <= 57) || // Angka 0-9
            //         (charCode >= 65 && charCode <= 90) || // Huruf A-Z
            //         (charCode >= 97 && charCode <= 122) || // Huruf a-z
            //         charCode === 32 // Spasi
            //     );
            // }

            // // Deteksi ketika ada input dari keyboard di manapun di halaman
            // $(document).on('keyup', function(event) {
            //     if (isModalOpen) {
            //         return;
            //     }

            //     if (event.key === 'Enter') {
            //         if (table.rows('.selected').any()) {
            //             var data = table.row('.selected').data();
            //             openUpdateModal(data);
            //         } else {
            //             openAddModal();
            //         }
            //     } else if (event.key === 'ArrowUp') {
            //         navigateTable('up'); // Navigasi ke atas
            //     } else if (event.key === 'ArrowDown') {
            //         navigateTable('down'); // Navigasi ke bawah
            //     } else if (event.key === 'Delete' || event.key === 'Del') {
            //         // Jika tombol delete ditekan
            //         if (table.rows('.selected').any()) {
            //             var data = table.row('.selected').data();
            //             deleteUser(data.id); // Panggil fungsi deleteUser dengan id dari baris yang dipilih
            //         }
            //     } else if (isValidSearchKey(event)) {
            //         // Jika karakter valid (huruf, angka, atau spasi), tambahkan ke searchString
            //         searchString += event.key;
            //         debounceSearch(); // Panggil debounce search setiap kali ada input yang valid
            //     } else if (event.key === 'Backspace' && searchString.length > 0) {
            //         searchString = searchString.slice(0, -1); // Hapus karakter terakhir
            //         debounceSearch(); // Jalankan pencarian saat ada backspace
            //     }

            //     // Jika searchString kosong dan pengguna menekan Backspace, jangan lakukan apa-apa
            //     if (searchString.length === 0 && event.key === 'Backspace') {
            //         return;
            //     }
            // });

            // // Pilih row ketika navigasi menggunakan keyboard atau klik pada tabel
            // $('#manajemen-users tbody').on('click', 'tr', function() {
            //     if ($(this).hasClass('selected')) {
            //         $(this).removeClass('selected');
            //     } else {
            //         table.$('tr.selected').removeClass('selected');
            //         $(this).addClass('selected');
            //     }
            //     currentIndex = table.row(this).index(); // Update indeks baris yang dipilih
            // });
        });

        // openModal
        function openModal(action, id = null) {
            isModalOpen = true;
            $('#modul-modal').modal('show');
            $('#form-moduls').trigger('reset');
            if (action === 'create') {
                $('#modal-title').text('Tambah Modul');
                $('#form-moduls select[name="grup"]').attr('disabled', false);

            } else if (action === 'edit' && id != null) {
                $('#modal-title').text('Edit Modul');
                $.ajax({
                    url: `{{ url('api/konfigurasi/manajemen-moduls/${id}') }}`,
                    method: 'GET',
                    dataType: 'json',
                    success: function response(data) {
                        console.log(data.data);

                        $('#form-moduls select[name="grup"]').val(data.data.kode_modul + '-' + data.data
                            .nama_modul.toUpperCase());
                        $('#form-moduls select[name="grup"]').attr('disabled', true);
                        $('#form-moduls input[name="nama_modul"]').val(data.data.nama_modul);
                        $('#form-moduls input[name="nama_url"]').val(data.data.nama_url);

                        $('#form-moduls').attr('action', `{{ url('konfigurasi/manajemen-moduls/${id}') }}`);
                        $('#form-moduls').append('<input type="hidden" name="_method" value="PUT">');

                        // when submit form, remove disabled attribute
                        $('#form-moduls').submit(function() {
                            $('#form-moduls select[name="grup"]').attr('disabled', false);
                        });
                    }
                })
            }
        }

        function deleteModule(id) {
            isModalOpen = true;
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `{{ url('konfigurasi/manajemen-moduls/${id}') }}`,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function response() {
                            Swal.fire(
                                'Deleted!',
                                'Data berhasil dihapus.',
                                'success'
                            )
                            $('#manajemen-moduls').DataTable().ajax.reload();
                            isModalOpen = false;
                        }
                    })
                }
            })
        }
    </script>

@endpush

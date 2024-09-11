@extends('layouts.app')

@section('content')
    <div style="width: 300px" class="mb-3">
        <h4 class="fw-bold py-3"><span class="fw-bold">{{ $title }}</h4>
    </div>

    <div class="card">
        <h5 class="card-header">Table Basic</h5>
        <div class="table-responsive text-nowrap">
            <form action="{{ route('konfigurasi.manajemen-menu.update') }}" id="form-menus" method="POST">
                @csrf
                @method('PUT')
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Level 1</th>
                            <th>Level 2</th>
                            <th>Level 3</th>
                            <th>Level 4</th>
                            <th>Level 5</th>
                            <th>Level 6</th>
                            <th>Level 7</th>
                            <th>Level 8</th>
                            <th>Level 9</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($menus as $menu)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td style="padding-left: {{ substr_count($menu->kode_modul, '.') * 10 }}px;">
                                    {{ $menu->kode_modul }}
                                </td>
                                <td style="padding-left: {{ substr_count($menu->kode_modul, '.') * 10 }}px;">
                                    {{ $menu->nama_modul }}</td>
                                <td>
                                    <input type="checkbox" class="form-check-input" name="level[{{ $menu->id }}][]"
                                        value="1" {{ $menu->level1 === 1 ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <input type="checkbox" class="form-check-input" name="level[{{ $menu->id }}][]"
                                        value="2" {{ $menu->level2 === 1 ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <input type="checkbox" class="form-check-input" name="level[{{ $menu->id }}][]"
                                        value="3" {{ $menu->level3 === 1 ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <input type="checkbox" class="form-check-input" name="level[{{ $menu->id }}][]"
                                        value="4" {{ $menu->level4 === 1 ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <input type="checkbox" class="form-check-input" name="level[{{ $menu->id }}][]"
                                        value="5" {{ $menu->level5 === 1 ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <input type="checkbox" class="form-check-input" name="level[{{ $menu->id }}][]"
                                        value="6" {{ $menu->level6 === 1 ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <input type="checkbox" class="form-check-input" name="level[{{ $menu->id }}][]"
                                        value="7" {{ $menu->level7 === 1 ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <input type="checkbox" class="form-check-input" name="level[{{ $menu->id }}][]"
                                        value="8" {{ $menu->level8 === 1 ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <input type="checkbox" class="form-check-input" name="level[{{ $menu->id }}][]"
                                        value="9" {{ $menu->level9 === 1 ? 'checked' : '' }}>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary d-flex justify-content-end">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    @if (session('success'))
        <script>
            Swal.fire(
                'Berhasil!',
                '{{ session('success') }}',
                'success'
            );
        </script>
    @elseif (session('error'))
        <script>
            Swal.fire(
                'Gagal!',
                '{{ session('error') }}',
                'error'
            );
        </script>
    @endif
@endpush

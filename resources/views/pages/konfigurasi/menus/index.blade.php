@extends('layouts.app')

@section('content')
    <div style="width: 300px" class="mb-3">
        <h4 class="fw-bold py-3"><span class="fw-bold">{{ $title }}</h4>
    </div>

    <div class="card">
        <h5 class="card-header">Table Basic</h5>
        <div class="table-responsive text-nowrap">
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
                    @foreach ($collection as $item)
                    @endforeach
                    <tr>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

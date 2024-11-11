@extends('layouts.app')

@section('content')
    

<div style="width: 300px" class="mb-1">
        <h4 class="fw-bold py-3"><span class="fw-bold">{{ $title }}</h4>
    </div>

 <!-- Button trigger modal -->
<button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#supplierModal">
    Launch demo modal
</button>
  
  <!-- Modal -->
  <div class="modal fade" id="supplierModal" tabindex="-1" role="dialog" aria-labelledby="supplierModalLabelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="supplierModal">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn bg-gradient-primary">Save changes</button>
        </div>
      </div>
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

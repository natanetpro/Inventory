@extends('layouts.app')

@section('content')
    <div style="width: 300px" class="mb-3">
        <h4 class="fw-bold py-3"><span class="fw-bold">{{ $title }}</h4>
    </div>

    
    <!-- Button trigger modal -->
<button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary" data-mdb-modal-init data-mdb-target="#staticBackdrop2">
    Launch modal register form
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog d-flex justify-content-center">
        <div class="modal-content w-75">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Sign up</h5>
                <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form>
                    <!-- Name input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" id="name2" class="form-control" />
                        <label class="form-label" for="name2">Name</label>
                    </div>

                    <!-- Email input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="email" id="email2" class="form-control" />
                        <label class="form-label" for="email2">Email address</label>
                    </div>

                    <!-- password input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="password" id="password2" class="form-control" />
                        <label class="form-label" for="password2">Password</label>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block">Sign up</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->




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

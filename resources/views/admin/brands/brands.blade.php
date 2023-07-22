{{-- @dd($sections) --}}
@extends('admin.layouts.main')
<body>
    @section('main.container')
        <main id="main" class="main">
            <div class="pagetitle">
                <h1>{{ $title }}- Tables</h1>
            </div><!-- End Page Title -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $title }}</h5>
                    <a class="btn btn-info" style="float:right;margin-bottom:10px;" href="{{url('admin/add-edit-brand')}}">Add Section</a>
                    <!-- Default Table -->
                    @if (session()->has('success_massage'))
                        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show"
                            role="alert">
                            {{ session()->get('success_massage') }}
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                aria-label="Close">
                            </button>
                        </div>
                    @endif
                    <table class="datatable">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                                <tr>
                                    <th scope="row">{{ $brand['id'] }}</th>
                                    <th scope="row">{{ $brand['name'] }}</th>
                                    <th scope="row">
                                        @if ($brand['status'] == '1')
                                            <a href="javascript:void(0)" class="UpdateBrandStatus"
                                                id="admin-{{ $brand['id'] }}" brand_id="{{ $brand['id'] }}"><i
                                                    class="bi bi-bookmark-check-fill" status="Active"></i></a>
                                        @else
                                            <a href="javascript:void(0)" class="UpdateAdminStatus"
                                                id="admin-{{ $brand['id'] }}" admin_id="{{ $brand['id'] }}"><i
                                                    class="bi bi-bookmark-check" status="Inactive"></i></a>
                                        @endif
                                    </th>
                                    <th scope="row">
                                        <a href="{{ url('admin/add-edit-brand/' . $brand['id']) }}"> <i
                                                class="bi bi-pencil-square"></i>
                                        </a>
                                        <a title="brand" class="confirmDelete"
                                            onclick="return confirm('Are you sure Delete this:'+title+'?')"
                                            href="{{ url('admin/delete-brand/' . $brand['id']) }}"><i
                                                class="bi bi-trash3-fill"></i>
                                        </a>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- End Default Table Example -->
                </div>
            </div>
        </main>
    @endsection   
  @section('custom.js')
  <script>
    $(document).ready(function() {
        $('.datatable').DataTable();        
        $('.confirmDelete').click(function() {
            Swal.fire({
                title: 'Are you sure Deleted This:'+title+'?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.confirmDelete) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })

        });
    });
    $(document).on('click', '.UpdateBrandStatus', function() {  
      // custom Datatable 
        var status = $(this).children("i").attr("status");
        var brand_id = $(this).attr("brand_id");
        // alert(brand_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "/admin/brand-update-status",
            data: {
                status: status,
                brand_id: brand_id
            },
            success: function(resp) {
                if (resp['status'] == 0) {
                    $('#admin-' + brand_id).html(
                        "<i class='bi bi-bookmark-check' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    $('#admin-' + brand_id).html(
                        "<i class='bi bi-bookmark-check-fill' status='Active'></i>");
                }
            },
            error: function() {
                alert('Error');
            }
        });
    });
</script>
  @endsection

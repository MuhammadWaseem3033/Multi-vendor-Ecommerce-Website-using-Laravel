@extends('admin.layouts.main')

    @section('main.container')
        <main id="main" class="main">
            <div class="pagetitle">
                <h1>{{ $title }}- Tables</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Tables</li>
                        <li class="breadcrumb-item active">General</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $title }}</h5>

                    <!-- Default Table -->
                    <table class="datatable">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Type</th>
                                <th scope="col">Mobile</th>
                                <th scope="col">Email</th>
                                <th scope="col">Image</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin)
                                <tr>
                                    <th scope="row">{{ $admin['id'] }}</th>
                                    <th scope="row">{{ $admin['name'] }}</th>
                                    <th scope="row">{{ $admin['type'] }}</th>
                                    <th scope="row">{{ $admin['mobile'] }}</th>
                                    <th scope="row">{{ $admin['email'] }}</th>
                                    <th scope="row"><img id="image"
                                            src="{{ url('admin/assets/image/', $admin['image']) }}" width="30px"
                                            alt="Profile"> </th>
                                    <th scope="row">
                                        @if ($admin['status'] == '1')
                                            <a href="javascript:void(0)" class="UpdateAdminStatus"
                                                id="admin-{{ $admin['id'] }}" admin_id="{{ $admin['id'] }}"><i
                                                    class="bi bi-bookmark-check-fill" status="Active"></i></a>
                                        @else
                                            <a href="javascript:void(0)" class="UpdateAdminStatus"
                                                id="admin-{{ $admin['id'] }}" admin_id="{{ $admin['id'] }}"><i
                                                    class="bi bi-bookmark-check" status="Inactive"></i></a>
                                        @endif
                                    </th>
                                    <th scope="row">
                                        @if ($admin['type'] == 'vendor')
                                            <a href="{{ url('admin/view-vendor-details/' . $admin['id']) }}"><i
                                                    style="font: 50px;" class="bi bi-file-earmark-pdf-fill"></i></a>
                                        @endif
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
    $(document).ready(function () {
        $('.datatable').DataTable();
        
    $(document).on('click', '.UpdateAdminStatus', function() {
        var status = $(this).children("i").attr("status");
        var admin_id = $(this).attr("admin_id");
        // alert(admin_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "/admin/admin-update-status",
            data: {
                status: status,
                admin_id: admin_id
            },
            success: function(resp) {
                if (resp['status'] == 0) {
                    $('#admin-' + admin_id).html(
                        "<i class='bi bi-bookmark-check' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    $('#admin-' + admin_id).html(
                        "<i class='bi bi-bookmark-check-fill' status='Active'></i>");
                }
            },
            error: function() {
                alert('Error');
            }
        });
    });
});

</script>
@endsection
 
 
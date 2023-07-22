{{-- @dd($sections) --}}
<?php use App\Models\ProductsFilter; ?>
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
                    <a class="btn btn-info" 
                    href="{{ url('admin/filter') }}">Filter</a>
              
                    <a class="btn btn-info" style="float:right;margin-bottom:10px;"
                        href="{{ url('admin/add-edit-filter-value') }}">Add Filter Value</a>
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
                                <th scope="col">ID</th>
                                <th scope="col">FilterID</th>
                                <th scope="col">FilterName</th>
                                <th scope="col">Filter_value</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($filtervalues as $filter)
                                <tr>
                                    <th scope="row">{{ $filter['id'] }}</th>
                                    <th scope="row">{{ $filter['filter_id'] }}</th>
                                    <th scope="row">
                                        <?php                                        
                                             echo $getfilterName = ProductsFilter::getfilterName($filter['filter_id']);
                                            //  dd($getfilterName);                                                 
                                        ?>
                                    </th>
                                    <th scope="row">{{ $filter['filter_value'] }}</th>
                                    <th scope="row">
                                        @if ($filter['status'] == '1')
                                            <a href="javascript:void(0)" class="UpdatefilterStatus"
                                                id="filter-{{ $filter['id'] }}" filter_id="{{ $filter['id'] }}"><i
                                                    class="bi bi-bookmark-check-fill" status="Active"></i></a>
                                        @else
                                            <a href="javascript:void(0)" class="UpdatefilterStatus"
                                                id="filter-{{ $filter['id'] }}" filter_id="{{ $filter['id'] }}"><i
                                                    class="bi bi-bookmark-check" status="Inactive"></i></a>
                                        @endif
                                    </th>
                                    <th scope="row">
                                        <a href="{{ url('admin/add-edit-filter-value/' . $filter['id']) }}"> <i
                                                class="bi bi-pencil-square"></i>
                                        </a>
                                        <a title="filter" class="confirmDelete"
                                            onclick="return confirm('Are you sure Delete this:'+title+'?')"
                                            href="{{ url('admin/delete-filter-value/' . $filter['id']) }}"><i
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
                        title: 'Are you sure Deleted This:' + title + '?',
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
            $(document).on('click', '.UpdatefilterStatus', function() {
                // custom Datatable 
                var status = $(this).children("i").attr("status");
                var filter_id = $(this).attr("filter_id");
                // alert (filter_id);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "post",
                    url: "/admin/filter-update-status",
                    data: {
                        status: status,
                        filter_id: filter_id
                    },
                    success: function(resp) {
                        if (resp['status'] == 0) {
                            $('#filter-' + filter_id).html(
                                "<i class='bi bi-bookmark-check' status='Inactive'></i>");
                        } else if (resp['status'] == 1) {
                            $('#filter-' + filter_id).html(
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

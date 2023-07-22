{{-- @dd($categories) --}}
@extends('admin.layouts.main')
@section('main.container')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{ $title }}- Tables</h1>
        </div><!-- End Page Title -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $title }}</h5>
                <a class="btn btn-primary " style="float:right;margin-bottom:10px;" href="{{ url('admin/add-edit-category') }}">Add category</a>
                <br>
                <!-- Default Table -->
                @if (session()->has('success_massage'))
                    <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show"
                        role="alert">
                        {{ session()->get('success_massage') }}
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                @endif
                @if (session()->has('massage'))
                    <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show"
                        role="alert">
                        {{ session()->get('massage') }}
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show"
                        role="alert">
                        {{ session()->get('error') }}
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                @endif
                <table class="datatable table table-hover" >
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">ParentID</th>
                            <th scope="col">SectionID</th>
                            <th scope="col">URL</th>
                            <th scope="col">Category Image</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            @if (isset($category['parentCategory']['category_name'])
                            &&!empty($category['parentCategory']['category_name']))
                            @php
                                $parent_category = $category['parentCategory']['category_name'];
                            @endphp 
                            @else
                                @php
                                    $parent_category ="Root"; 
                                @endphp 
                            @endif
                            <tr>  
                                <th scope="row">{{ $category['id'] }}</th>
                                <th scope="row">{{ $category['category_name'] }}</th>
                                <th scope="row">{{ $parent_category }}</th>
                                <th scope="row">{{ $category['sections']['name']}}</th>
                                <th scope="row">{{ $category['url'] }}</th>
                                <th scope="row">{{ $category['category_image'] }}</th>
                                <th scope="row">
                                    @if ($category['status'] == '1')
                                        <a href="javascript:void(0)" class="UpdateAdminStatus"
                                            id="category-{{ $category['id'] }}" category_id="{{ $category['id'] }}"><i
                                                class="bi bi-bookmark-check-fill" status="Active"></i></a>
                                    @else
                                        <a href="javascript:void(0)" class="UpdateAdminStatus"
                                            id="category-{{ $category['id'] }}" category_id="{{ $category['id'] }}"><i
                                                class="bi bi-bookmark-check" status="Inactive"></i></a>
                                    @endif
                                </th>
                                <th scope="row">
                                    <a href="{{ url('admin/add-edit-category/' . $category['id']) }}"> <i
                                            class="bi bi-pencil-square"></i>
                                    </a>
                                    <a title="category" class="confirmDelete" 
                                    {{-- module="category" moduleid="{{$category['id']}}" --}}
                                        onclick="return confirm('Are you sure Delete this:'+title+'?')" 
                                        href="{{ url('admin/delete-category/' . $category['id'])}}"
                                        {{-- href="javascript:void(0)" --}}
                                        >
                                        <i class="bi bi-trash3-fill"></i>
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
                var module = $(this).attr('module');
                // alert(module);
                var moduleid = $(this).attr('moduleid');
                // alert(moduleid);
                Swal.fire({
                    title: 'Are you sure Deleted This:',
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
                        window.location = "/admin/dalete-"+module+"/"+moduleid;
                    }
                })

            });

        });
        $(document).on('click', '.UpdateAdminStatus', function() {
            // custom Datatable 
            var status = $(this).children("i").attr("status");
            var category_id = $(this).attr("category_id");
            // alert(category_id);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: "/admin/category-update-status",
                data: {
                    status: status,
                    category_id: category_id
                },
                success: function(resp) {
                    if (resp['status'] == 0) {
                        $('#category-' + category_id).html(
                            "<i class='bi bi-bookmark-check' status='Inactive'></i>");
                    } else if (resp['status'] == 1) {
                        $('#category-' + category_id).html(
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

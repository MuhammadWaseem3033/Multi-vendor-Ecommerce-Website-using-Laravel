{{-- @dd($section) --}}
{{-- @dd($category); --}}
@extends('admin.layouts.main')
@section('main.container')
    <style>
        input {
            border: 2px solid blue;
        }
    </style>
    <main id="main" class="main">
        {{-- @dd($countries) --}}
        <div class="pagetitle">
            <h1>{{ $title }}</h1>
        </div><!-- End Page Title -->
        <div class="row">
            <div class="card col-9"style="border: 3px dashed blue;">
                <div class="card-body">
                    <h5 class="card-title">Category</h5>

                    {{-- @dd($vendorDetails) --}}
                    <form class="row g-3" method="post"
                        @if (empty($category['id'])) action="{{ url('admin/add-edit-category') }}"
                            @else
                            action="{{ url('admin/add-edit-category/' . $category['id']) }}" @endif
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-12">
                            <label for="category_name" class="form-label">Category Name</label>
                            <input type="text" name="category_name" class="form-control" id="category_name" required
                                @if (empty($category['category_name'])) value="{{ $category['category_name'] }}"
                                      @else
                                      value="{{ $category['category_name'] }}" @endif>
                        </div>
                        <div class="col-md-8 col-lg-12">
                            @if (!empty($category['category_image']))
                                <div>
                                    <a href="{{ url('front/images/' . $category['category_image']) }}"> <img
                                            src="{{ url('front/images/' . $category['category_image']) }}" width="80px" />
                                    </a>
                                </div>
                                <a target="_blank" href="{{ url('front/images/' . $category['category_image']) }}">view
                                    image / </a>
                                <a title="category" class="confirmDeleteimage" module="category-image"
                                    moduleid="{{ $category['id'] }}" {{-- onclick="return confirm('Are you sure Delete this:'+title+'?')"  --}} href="javascript:void(0)">Delete
                                    image
                                </a>
                            @endif
                            <div class="col-12">
                                <label for="category_image" class="form-label">Image</label>
                                <input type="file" name="category_image" class="form-control" id="category_image"
                                    required value="">
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="section_id" class="form-label">Section Name</label>
                            <select name="section_id" id="section_id" class="form-control" required>
                                <option value="">Select</option>
                                @foreach ($getSection as $section)
                                    <option value="{{ $section['id'] }}"
                                        @if (!empty($category['section_id']) && $category['section_id'] == $section['id']) selected="" @endif>{{ $section['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div id="appendCategoriesLevel" required>
                            @include('admin.categories.append_category_level')
                        </div>
                        <div class="col-12">
                            <label for="url" class="form-label">URL</label>
                            <input type="text" name="url" @error('url') @enderror class="form-control"
                                id="url" required>
                        </div>

                        <div class="col-12">
                            <label for="meta_title" class="form-label">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control" id="meta_title"
                                @if (empty($category['meta_title'])) value="{{ $category['meta_title'] }}"
                                          @else
                                          value="{{ $category['meta_title'] }}" @endif>
                        </div>
                        <div class="col-12">
                            <label for="category_discount" class="form-label">Category Discount</label>
                            <input type="text" name="category_discount" class="form-control" id="category_discount"
                                @if (empty($category['category_discount'])) value="{{ $category['category_discount'] }}"
                                          @else
                                          value="{{ $category['category_discount'] }}" @endif>
                        </div>
                        <div class="col-12">
                            <label for="description" class="form-label">Discription</label>
                            <textarea rows="4" type="text" name="description" class="form-control" id="description"
                                @if (empty($category['description'])) value="{{ $category['description'] }}"
                                          @else
                                          value="{{ $category['description'] }}" @endif>
                            </textarea>
                        </div>
                        <div class="col-12">
                            <label for="meta_description" class="form-label">Meta Description</label>
                            <textarea rows="4" type="text" name="meta_description" class="form-control" id="meta_description"
                                @if (empty($category['meta_description'])) value="{{ $category['meta_description'] }}"
                                          @else
                                          value="{{ $category['meta_description'] }}" @endif>
                            </textarea>
                        </div>
                        <div class="col-12">
                            <label for="meta_keywords" class="form-label">Meta Keywords</label>
                            <input type="text" name="meta_keywords" class="form-control" id="meta_keywords"
                                @if (empty($category['meta_keywords'])) value="{{ $category['meta_keywords'] }}"
                                          @else
                                          value="{{ $category['meta_keywords'] }}" @endif>
                        </div>
                        <div class="col-12">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" name="status" class="form-control" id="status"
                                @if (empty($category['status'])) value="{{ $category['status'] }}"
                                          @else
                                          value="{{ $category['status'] }}" @endif>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form><!-- Vertical Form -->
                </div>


            </div>
        </div>

    </main><!-- End #main -->
    {{-- @include('sweetalert::alert') --}}
@endsection
@section('custom.js')
    <script>
        $(document).ready(function() {
            $('.confirmDeleteimage').click(function() {
                var module = $(this).attr('module');
                alert(module);
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
                        window.location = "/admin/dalete-" + module + "/" + moduleid;
                    }
                })

            });
            $('#section_id').change(function() {
                var section_id = $(this).val();
                // alert(section_id);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'get',
                    url: '/admin/append-category-level',
                    data: {
                        section_id: section_id
                    },
                    success: function(resp) {
                        // alert(resp);
                        $('#appendCategoriesLevel').html(resp);
                    },
                    error: function() {
                        alert("Error");
                    }
                });

            });
        });
    </script>
@endsection

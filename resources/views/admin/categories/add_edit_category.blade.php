@extends('layouts.admin_layout.admin_layout')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Catalogues</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accueil</a></li>
              <li class="breadcrumb-item active">Categories</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    @if(Session::has('flash_message_success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top:10px">
            {{ Session::get('flash_message_success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger" style="margin-top: 10px">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <form name="categoryForm" id="categoryForm" @if(empty($categoryData['id']))
           action="{{ url('admin/add-edit-category') }}" @else action="{{ url('admin/add-edit-category/'.$categoryData['id']) }}" @endif  method="post" enctype="multipart/form-data">
            @csrf
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">{{ $title }}</h3>

                <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="category_name">Nom de la categorie</label>
                        <input type="text" class="form-control" name="category_name" id="category_name"
                            @if(!empty($categoryData['category_name'])) value="{{ $categoryData['category_name'] }}"
                            @else value="{{ old('category_name') }}"
                            @endif
                        >
                    </div>
                        <div id="appendCategoriesLevel">
                            @include('admin.categories.append_categories_level')
                        </div>
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Selectionner la section</label>
                        <select name="section_id" id="section_id" class="form-control select2" style="width: 100%;">
                        <option selected="selected">Choisir la section</option>
                            @foreach($getSections as $section)
                                <option value="{{ $section->id }}"
                                    @if(!empty($categoryData['section_id']) && $categoryData['section_id'] == $section->id)
                                    selected @endif>{{ $section->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- /.form-group -->
                    <div class="form-group">
                        <label for="category_image">Image de la categorie</label>
                            <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="category_image"  name="category_image">
                                <label class="custom-file-label" for="category_image">Choisir une image</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text" id="">Uploader</span>
                            </div>
                        </div>
                        @if(!empty($categoryData['category_image']))
                            <div>
                                <img style="width: 80px; margin-top:5px;" src="{{ asset('images/category_images/'.$categoryData['category_image']) }}">
                                &nbsp;<a href="{{ url('admin/delete-category-image/'.$categoryData['id']) }}">Delete Image</a>
                            </div>
                        @endif
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                </div>
                <!-- /.row -->
                <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="category_discount">Discount</label>
                        <input type="text" class="form-control" name="category_discount" id="category_discount"
                            @if(!empty($categoryData['category_discount'])) value="{{ $categoryData['category_discount'] }}"
                                @else value="{{ old('category_discount') }}"
                            @endif
                        >
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3">
                            @if(!empty($categoryData['description'])) {{ $categoryData['description'] }}
                                @else {{ old('description') }}
                            @endif
                        </textarea>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="url">Url</label>
                        <input type="text" class="form-control" name="url" id="url"
                            @if(!empty($categoryData['url'])) value="{{ $categoryData['url'] }}"
                                @else value="{{ old('url') }}"
                            @endif>
                    </div>
                    <div class="form-group">
                        <label for="meta_title">Meta Title</label>
                        <textarea class="form-control" id="meta_title" name="meta_title" rows="3">
                            @if(!empty($categoryData['meta_title'])) {{ $categoryData['meta_title'] }}
                                @else {{ old('meta_title') }}
                            @endif
                        </textarea>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                </div>

                <div class="row">
                    <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="meta_description">Meta description</label>
                        <textarea class="form-control" name="meta_description" id="meta_description" rows="3"
                        placeholder="Enter ...">

                        @if(!empty($categoryData['meta_description'])) {{ $categoryData['meta_description'] }}
                            @else {{ old('meta_description') }}
                        @endif
                        </textarea>
                    </div>
                    <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="meta_keywords">Meta Keywords</label>
                        <textarea class="form-control" id="meta_keywords" name="meta_keywords" rows="3">
                            @if(!empty($categoryData['meta_keywords'])) {{ $categoryData['meta_keywords'] }}
                                @else {{ old('meta_keywords') }}
                            @endif
                        </textarea>
                    </div>
                    <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Valider</button>
            </div>
            </div>
            </form>
            <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>

@endsection

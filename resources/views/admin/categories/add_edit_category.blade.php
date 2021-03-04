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
          <form name="categoryForm" id="categoryForm" action="{{ url('admin/add-edit-category') }}" method="post" enctype="multipart/form-data">
            @csrf
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Ajouter Categorie</h3>

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
                        <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Entrer le nom de la categorie">
                    </div>

                    <div class="form-group">
                        <label>Choisir la categorie parent</label>
                        <select name="parent_id" id="parent_id" class="form-control select2" style="width: 100%;">
                        <option value="0">Categorie principale</option>

                        </select>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Selectionner la section</label>
                        <select name="section_id" id="section_id" class="form-control select2" style="width: 100%;">
                        <option selected="selected">Choisir la section</option>
                            @foreach($getSections as $section)
                                <option value="{{ $section->id }}">{{ $section->name }}</option>
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
                        <input type="text" class="form-control" name="category_discount" id="category_discount" placeholder="Entrer le nom de la categorie">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3" placeholder="Entrer la description ..."></textarea>                </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="url">Url</label>
                        <input type="text" class="form-control" name="url" id="url" placeholder="Entrer l'URL">
                    </div>
                    <div class="form-group">
                        <label for="meta_title">Meta Title</label>
                        <textarea class="form-control" id="meta_title" name="meta_title" rows="3" placeholder="Enter ..."></textarea>                </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                </div>

                <div class="row">
                    <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="meta_description">Meta description</label>
                        <textarea class="form-control" name="meta_description" id="meta_description" rows="3" placeholder="Enter ..."></textarea>                  </div>
                    <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="meta_keywords">Meta Keywords</label>
                        <textarea class="form-control" id="meta_keywords" name="meta_keywords" rows="3" placeholder="Enter ..."></textarea>                  </div>
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

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
              <li class="breadcrumb-item active">Produits</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    @if(Session::has('success_message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top:10px">
            {{ Session::get('success_message') }}
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
          <form name="ProductForm" id=ProductForm" @if(empty($productData['id']))
           action="{{ url('admin/add-edit-product') }}" @else action="{{ url('admin/add-edit-product/'.$productData['id']) }}" @endif  method="post" enctype="multipart/form-data">
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
                        <label>Selectionner la categorie</label>
                        <select name="category_id" id="category_id" class="form-control select2" style="width: 100%;">
                        <option selected="value">Choisir la categorie</option>
                            @foreach ($categories as $section)
                               <optgroup label="{{ $section['name'] }}"></optgroup>
                                @foreach ($section['categories'] as $category)
                                    <option value="{{ $category['id'] }}">&nbsp;&nbsp;-- {{ $category['category_name'] }}</option>
                                    @foreach ($category['subcategories'] as $subcategory)
                                        <option value="{{ $subcategory['id'] }}"> &nbsp;&nbsp;&nbsp;&raquo;&nbsp;{{ $subcategory['category_name'] }}</option>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="product_name">Nom du produit</label>
                        <input type="text" class="form-control" name="product_name" id="product_name"
                            @if(!empty($productData['product_name'])) value="{{ $productData['product_name'] }}"
                            @else value="{{ old('product_name') }}"
                            @endif
                        >
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="product_code">Code du produit</label>
                        <input type="text" class="form-control" code="product_code" id="product_code"
                            @if(!empty($productData['product_code'])) value="{{ $productData['product_code'] }}"
                            @else value="{{ old('product_code') }}"
                            @endif
                        >
                    </div>
                    <div class="form-group">
                        <label for="product_color">Couleur du produit</label>
                        <input type="text" class="form-control" color="product_color" id="product_color"
                            @if(!empty($productData['product_color'])) value="{{ $productData['product_color'] }}"
                            @else value="{{ old('product_color') }}"
                            @endif
                        >
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="product_price">Prix</label>
                        <input type="text" class="form-control" price="product_price" id="product_price"
                            @if(!empty($productData['product_price'])) value="{{ $productData['product_price'] }}"
                            @else value="{{ old('product_price') }}"
                            @endif
                        >
                    </div>
                    <div class="form-group">
                        <label for="product_discount">Discount (%)</label>
                        <input type="text" class="form-control" discount="product_discount" id="product_discount"
                            @if(!empty($productData['product_discount'])) value="{{ $productData['product_discount'] }}"
                            @else value="{{ old('product_discount') }}"
                            @endif
                        >
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="product_weight">Poids</label>
                        <input type="text" class="form-control" weight="product_weight" id="product_weight"
                            @if(!empty($productData['product_weight'])) value="{{ $productData['product_weight'] }}"
                            @else value="{{ old('product_weight') }}"
                            @endif
                        >
                    </div>

                    <!-- /.form-group -->
                    <div class="form-group">
                        <label for="main_image">Image du produit</label>
                            <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="main_image"  name="main_image">
                                <label class="custom-file-label" for="main_image">Choisir une image</label>
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
                        <label for="product_video">Video</label>
                            <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="product_video"  name="product_video">
                                <label class="custom-file-label" for="product_video">Choisir une image</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text" id="">Uploader</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Fit</label>
                        <select name="category_id" id="category_id" class="form-control select2" style="width: 100%;">
                        <option selected="selected">Choisir</option>
                            @foreach ($fitArray as $fit)
                                <option value="{{ $fit }}">{{ $fit }}</option>
                            @endforeach
                        </select>
                    </div>


                    <!-- /.form-group -->
                </div>
                <!-- /.col -->

                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="wash_care">Washe Care</label>
                        <input type="text" class="form-control" name="wash_care" id="wash_care"
                            @if(!empty($productData['wash_care'])) value="{{ $productData['wash_care'] }}"
                                @else value="{{ old('wash_care') }}"
                            @endif>
                    </div>


                    <div class="form-group">
                        <label>Fabric</label>
                        <select name="fabric" id="fabric" class="form-control select2" style="width: 100%;">
                        <option selected="selected">Choisir</option>
                            @foreach ($fabricArray as $fabric)
                                <option value="{{ $fabric }}">{{ $fabric }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                </div>

                <div class="row">
                    <div class="col-12 col-sm-6">


                        <div class="form-group">
                            <label>Occasion</label>
                            <select name="category_id" id="category_id" class="form-control select2" style="width: 100%;">
                            <option selected="selected">Choisir</option>
                                @foreach ($occasionArray as $occasion)
                                    <option value="{{ $occasion }}">{{ $occasion }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Pattern</label>
                            <select name="fabric" id="fabric" class="form-control select2" style="width: 100%;">
                            <option selected="selected">Choisir</option>
                                @foreach ($patternArray as $pattern)
                                    <option value="{{ $pattern }}">{{ $pattern }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label>Sleeve</label>
                            <select name="category_id" id="category_id" class="form-control select2" style="width: 100%;">
                            <option selected="selected">Choisir</option>
                                @foreach ($sleeveArray as $sleeve)
                                    <option value="{{ $sleeve }}">{{ $sleeve }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" class="form-control" name="meta_title" id="meta_title"
                            @if(!empty($productData['meta_title'])) value="{{ $productData['meta_title'] }}"
                                @else value="{{ old('meta_title') }}"
                            @endif>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="3">
                                @if(!empty($productData['description'])) {{ $productData['description'] }}
                                    @else {{ old('description') }}
                                @endif
                            </textarea>
                        </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label for="isFeatured">Featured</label>
                        <input type="checkbox" name="is_featured" id="is_featured" value="1">
                    </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="meta_keywords">Meta Keywords</label>
                        <input type="text" class="form-control" name="meta_keywords" id="meta_keywords"
                            @if(!empty($productData['meta_keywords'])) value="{{ $productData['meta_keywords'] }}"
                                @else value="{{ old('meta_keywords') }}"
                            @endif>
                    </div>



                    <div class="form-group">
                        <label for="meta_description">Meta description</label>
                        <input type="text" class="form-control" name="meta_description" id="meta_description"
                            @if(!empty($productData['meta_description'])) value="{{ $productData['meta_description'] }}"
                                @else value="{{ old('meta_description') }}"
                            @endif>
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

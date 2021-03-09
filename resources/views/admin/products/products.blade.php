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

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- /.card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Produits</h3>
                <a href="{{ url('admin/add-edit-category') }}" class="btn btn-block btn btn-success" style="max-width: 150px; float: right; display:inline-block">Ajouter Produit</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="products" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Product Code</th>
                    <th>Product Color</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($products as $product)
                  <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->product_code }}</td>
                    <td>{{ $product->product_color }}</td>
                    <td>
                        @if($product->status == 1)
                            <a
                            class="updateProductStatus"
                            id="product-{{ $product->id }}"
                            product_id="{{ $product->id }}"
                            href="javascript:void(0)"
                            >
                            Active
                            </a>
                        @else
                            <a
                            class="updateproductStatus"
                            id="product-{{ $product->id }}"
                            product_id="{{ $product->id }}"
                            href="javascript:void(0)"
                            >Inactive
                            </a>
                        @endif
                    </td>
                    <td>
                        <a href="{{ url('admin/add-edit-product/'.$product->id) }}">Edit</a>
                        &nbsp;&nbsp;
                        <a href="javascript:void(0)" class="confirmDelete" record="product" recordid="{{ $product->id }}"
                           >Delete</a>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection

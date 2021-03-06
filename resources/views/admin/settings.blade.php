@extends('layouts.admin_layout.admin_layout')
    @section('content')
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Paramètres</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                    <li class="breadcrumb-item active">Paramètres</li>
                    </ol>
                </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <section class="content">
                <div class="container-fluid">
                  <div class="row">
                    <!-- left column -->
                    <div class="col-md-6">
                      <!-- general form elements -->
                      <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title">Modifier mot de passe Admin</h3>
                        </div>
                        @if(Session::has('error_message'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top:10px">
                                {{ Session::get('error_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if(Session::has('success_message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top:10px">
                                {{ Session::get('success_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="{{ url('/admin/update-current-pwd') }}" name="updatePasswordForm" id="updatePasswordForm">
                            @csrf
                            <div class="card-body">
                            <?php /*
                            <div class="form-group">
                              <label for="exampleInputEmail1">Nom</label>
                              <input name="admin_name" id="admin_name" type="text" class="form-control" value="{{ $adminDetails->name }}" placeholder="Entrez votre nom Admin/SubAdmin">
                            </div>
                            */ ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Type d'utilisateur</label>
                                <input class="form-control" value="{{ $adminDetails->type }}" readonly="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input class="form-control" value="{{ $adminDetails->email }}" readonly="">
                            </div>

                            <div class="form-group">
                              <label for="exampleInputPassword1">Mot de passe actuel</label>
                              <input type="password" class="form-control" name="current_pwd" id="current_pwd" placeholder="Mot de passe actuel" required="">
                              <span id="chkcurrentPwd"></span>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Nouveau Mot de passe</label>
                                <input type="password" class="form-control" name="new_pwd" id="new_pwd" placeholder="Nouveau Mot de passe" required="">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Confirmer Mot de passe</label>
                                <input type="password" class="form-control" name="confirm_pwd" id="confirm_pwd" placeholder="Confirmer Mot de passe" required="">
                              </div>
                          </div>
                          <!-- /.card-body -->

                          <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                          </div>
                        </form>
                      </div>
                      <!-- /.card -->
                    </div>
                  </div>
                  <!-- /.row -->
                </div><!-- /.container-fluid -->
              </section>
        </div>
  @endsection

<?php
$userId = $userInfo->userId;
$name = $userInfo->name;
$email = $userInfo->email;
$mobile = $userInfo->mobile;
$roleId = $userInfo->roleId;
$role = $userInfo->role;
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Meu Perfil</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url("dashboard"); ?>">Inicio</a></li>
              <li class="breadcrumb-item active">Perfil</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                <i class="fas fa-user-alt fa-5x"></i>
                </div>

                <h3 class="profile-username text-center"><?= $name ?></h3>

                <p class="text-muted text-center"><?= $role ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>E-mail</b> <a class="float-right" style="font-size: small;"><?= $email ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Celular</b> <a class="float-right"><?= $mobile ?></a>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Sobre min</h3>
              </div>
              <!-- /.card-header -->
              <!-- <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Educação</strong>

                <p class="text-muted">
                 Onde estudou
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Moradia</strong>

                <p class="text-muted">Seu endereço</p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Conhecimentos</strong>

                <p class="text-muted">
                  <span class="tag tag-danger">UI Design</span>
                  <span class="tag tag-success">Coding</span>
                  <span class="tag tag-info">Javascript</span>
                  <span class="tag tag-warning">PHP</span>
                  <span class="tag tag-primary">Node.js</span>
                </p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Notas</strong>

                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
              </div> -->
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <!-- <div class="col-md-9">            
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link <?= ($active == "details")? "active" : "" ?>" href="#details" data-toggle="tab">Detalhes</a></li>
                  <li class="nav-item"><a class="nav-link <?= ($active == "changepass")? "active" : "" ?>" href="#changepass" data-toggle="tab">Mudar a Senha</a></li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="details">
                        <div class="post">
                            <?php $this->load->helper('form'); ?>
                            <form action="<?php echo base_url() ?>profileUpdate" method="post" 
                                id="editProfile" role="form">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-12">                                
                                            <div class="form-group">
                                                <label for="fname">Nome Completo</label>
                                                <input type="text" class="form-control" id="fname" name="fname" placeholder="<?php echo $name; ?>" value="<?php echo set_value('fname', $name); ?>" maxlength="128" />
                                                <input type="hidden" value="<?php echo $userId; ?>" name="userId" id="userId" />    
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="mobile">Celular</label>
                                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="<?php echo $mobile; ?>" value="<?php echo set_value('mobile', $mobile); ?>" maxlength="10">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" class="form-control" id="email" name="email" placeholder="<?php echo $email; ?>" value="<?php echo set_value('email', $email); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <input type="submit" class="btn btn-primary" value="Salvar" />
                                    <input type="reset" class="btn btn-default" value="Limpar" />
                                </div>
                            </form>   
                        </div>
                    </div>

                    <div class="tab-pane" id="changepass">
                        <div class="post">
                        <form role="form" action="<?php echo base_url() ?>changePassword" method="post">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="inputPassword1">Antiga Senha</label>
                                            <input type="password" class="form-control" id="inputOldPassword" placeholder="Old password" name="oldPassword" maxlength="20" required>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="inputPassword1">Nova Senha</label>
                                            <input type="password" class="form-control" id="inputPassword1" placeholder="New password" name="newPassword" maxlength="20" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="inputPassword2">Confirma Nova Senha</label>
                                            <input type="password" class="form-control" id="inputPassword2" placeholder="Confirm new password" name="cNewPassword" maxlength="20" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                            <div class="box-footer">
                                <input type="submit" class="btn btn-primary" value="Salvar" />
                                <input type="reset" class="btn btn-default" value="Limpar" />
                            </div>
                        </form>   
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div> -->
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<script src="<?php echo base_url(); ?>assets/js/editUser.js" type="text/javascript"></script>
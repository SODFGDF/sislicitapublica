  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1>Adicionar Usuário</h1>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="<?php echo base_url("dashboard"); ?>">Início</a></li>
                          <li class="breadcrumb-item"><a href="<?php echo base_url("userListing"); ?>">Listar</a></li>
                          <li class="breadcrumb-item active">Cadastrar</li>
                      </ol>
                  </div>
              </div>
          </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
          <div class="container-fluid">
              <div class="row">
                <div class="col-md-6">
                    <?php
                        $this->load->helper('form');
                        $error = $this->session->flashdata('error');
                        if($error)
                        {
                    ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                    <?php } ?>
                    <?php  
                        $success = $this->session->flashdata('success');
                        if($success)
                        {
                    ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                    <?php } ?>

                    <div class="row">
                        <div class="col-md-12">
                            <?php echo validation_errors('
                                <div class="alert alert-danger alert-dismissable fade show" role="alert">', 
                                ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                        </div>
                    </div>                              
                </div>
                <!-- left column -->
                <div class="col-md-12">
                      <!-- jquery validation -->
                      <div class="card card-primary">
                          <div class="card-header">
                              <h3 class="card-title">Entrar com os dados do usuário</h3>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
                          <?php $this->load->helper("form"); ?>
                          <form role="form" id="addUser" action="<?php echo base_url() ?>addNewUser" 
                            method="post" role="form">
                              <div class="card-body">
                                  <div class="form-group">
                                      <label for="fname">Nome Completo</label>
                                      <input type="text" class="form-control required" value="<?php echo set_value('fname'); ?>"
                                        id="fname" name="fname" maxlength="128">
                                  </div>
                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="fname">Login</label>
                                              <input type="text" class="form-control required"
                                                value="<?php echo set_value('login'); ?>" id="login" name="login"
                                                maxlength="128">
                                          </div>

                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="email">E-mail</label>
                                              <input type="text" class="form-control required email" id="email"
                                                value="<?php echo set_value('email'); ?>" name="email"
                                                maxlength="128">
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="password">Senha</label>
                                              <input type="password" class="form-control required" id="password"
                                                name="password" maxlength="20">
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="cpassword">Confirma Senha</label>
                                              <input type="password" class="form-control required equalTo"
                                                  id="cpassword" name="cpassword" maxlength="20">
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="mobile">Celular</label>
                                              <input type="text" class="form-control digits" id="mobile"
                                                  value="<?php echo set_value('mobile'); ?>" name="mobile"
                                                  maxlength="10">
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="role">Perfil</label>
                                              <select class="form-control required" id="role" name="role">
                                                  <option value="0">Selecione</option>
                                                  <?php
                                                    if(!empty($roles))
                                                    {
                                                        foreach ($roles as $rl)
                                                        {
                                                            ?>
                                                          <option value="<?php echo $rl->roleId ?>"
                                                              <?php if($rl->roleId == set_value('role')) {echo "selected=selected";} ?>>
                                                              <?php echo $rl->role ?></option>
                                                          <?php
                                                        }
                                                    }
                                                    ?>
                                              </select>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="matricula">Matrícula</label>
                                              <input type="text" class="form-control required" id="matricula"
                                                name="matricula" maxlength="8" data-inputmask="'mask': '99999999'" data-mask disabled>
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="setor">Setor</label>
                                              <input type="text" class="form-control required"
                                                  id="setor" name="setor" maxlength="20" disabled>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                      <div class="form-group">
                                        <label for="role">Empregado da Empresa</label>
                                        <div class="form-check-inline">
                                          <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optradio" value="1">Sim
                                          </label>
                                        </div>
                                        <div class="form-check-inline">
                                          <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optradio" value="0">Não
                                          </label>
                                        </div>
                                      </div>  
                                    </div>
                                  </div>
                                  <!-- /.card-body -->
                                  <div class="card-footer">
                                    <button type="submit" class="btn btn-outline-success">
                                    <i class="fas fa-save"></i> Salvar</button>
                                    <button class="btn btn-default" type="reset">
                                    <i class="fas fa-broom"></i> Limpar</button>
                                    <a href="<?php echo base_url(); ?>userListing" 
                                        class="btn btn-outline-primary">
                                        <i class="fas fa-backward"></i> Voltar</a>
                                  </div>
                          </form>
                      </div>
                      <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                  
                <!--/.col (right) -->
              </div>
              <!-- /.row -->
          </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script src="<?php echo base_url("assets/js/addUser.js"); ?>" type="text/javascript"></script>
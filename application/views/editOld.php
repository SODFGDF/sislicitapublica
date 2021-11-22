<?php
$userId = $userInfo->userId;
$name = $userInfo->name;
$login = $userInfo->login;
$email = $userInfo->email;
$mobile = $userInfo->mobile;
$roleId = $userInfo->roleId;
$empregado = $userInfo->empregado;
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar Usuário</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url("dashboard"); ?>">Início</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url("userListing"); ?>">Listar</a></li>
                        <li class="breadcrumb-item active">Editar</li>
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
                            <h3 class="card-title">Editar os dados do usuário</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <?php $this->load->helper("form"); ?>
                        <form role="form" action="<?php echo base_url() ?>editUser" method="post" 
                            id="editUser" role="form">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="fname">Nome Completo</label>
                                    <input type="text" class="form-control" id="fname" placeholder="Nome Completo" name="fname" value="<?php echo $name; ?>" maxlength="128">
                                    <input type="hidden" value="<?php echo $userId; ?>" name="userId" id="userId" />    
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Login</label>
                                            <input type="text" class="form-control" id="login" placeholder="Login" 
                                                name="login" value="<?php echo $login; ?>" maxlength="20">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">E-mail</label>
                                            <input type="email" class="form-control" id="email" 
                                                placeholder="Enter email" name="email" value="<?php echo $email; ?>" maxlength="128">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Senha</label>
                                            <input type="password" class="form-control" id="password" 
                                                placeholder="Senha" name="password" maxlength="20">    
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cpassword">Confirma Senha</label>
                                            <input type="password" class="form-control" id="cpassword" 
                                                placeholder="Confirmar Senha" name="cpassword" maxlength="20">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mobile">Celular</label>
                                            <input type="text" class="form-control" id="mobile" 
                                                placeholder="Mobile Number" name="mobile" value="<?php echo $mobile; ?>" maxlength="10">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="role">Perfil</label>
                                            <select class="form-control" id="role" name="role">
                                            <option value="0">Selecione</option>
                                            <?php
                                            if(!empty($roles))
                                            {
                                                foreach ($roles as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->roleId; ?>" <?php if($rl->roleId == $roleId) {echo "selected=selected";} ?>><?php echo $rl->role ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="role">Empregado da Empresa</label>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optradio" value="1" <?php if ($empregado == 1): ?>
                                                    checked
                                                <?php endif ?>>Sim
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optradio" value="0" <?php if ($empregado == 0): ?>
                                                    checked
                                                <?php endif ?>>Não
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

<script src="<?php echo base_url(); ?>assets/js/editUser.js" type="text/javascript"></script>


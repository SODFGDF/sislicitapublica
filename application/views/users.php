<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
                <i class="fa fa-users"></i> Listagem de Usuários
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url("dashboard"); ?>">Inicio</a></li>
              <li class="breadcrumb-item active">Lista Usuários</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
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
        <div class="col-6 text-right">
          <div class="form-group">
              <a class="btn btn-outline-primary" href="<?php echo base_url(); ?>addNew">
              <i class="fas fa-user-plus"></i> Adicionar
              </a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Listagem dos usuários cadastrados no sistema</h3>
              <div class="row">
                <div class="col-6">
                  <form action="<?php echo base_url() ?>userListing" method="POST" id="searchList">
                      <div class="input-group">
                          <input type="text" name="searchText" 
                            value="<?php echo $searchText; ?>" 
                            class="form-control input-sm pull-right" 
                            style="width: 150px;" placeholder="Procura em Banco"/>
                          <div class="input-group-btn">
                          <button class="btn btn-default searchList"><i class="fa fa-search"></i></button>
                          </div>
                      </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nome</th>
                  <th>Login</th>
                  <th>E-mail</th>
                  <th>Perfil</th>
                  <th>Empregado</th>
                  <th>Criado em</th>
                  <th class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    if(!empty($userRecords))
                    {
                        foreach($userRecords as $record)
                        {
                    ?>
                    <tr>
                        <td><?php echo $record->name ?></td>
                        <td><?php echo $record->login ?></td>
                        <td><?php echo $record->email ?></td>
                        <td><?php echo $record->role ?></td>
                        <td><?php echo $retVal = ($record->empregado == 1) ? 'NOVACAP' : 'EXTERNO' ; ?></td>
                        <td><?php echo date("d-m-Y", strtotime($record->createdDtm)) ?></td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="<?= base_url().'login-history/'.$record->userId; ?>" title="Histórico Login"><i class="fa fa-history"></i></a>  

                            <?php if ($record->empregado == 0): ?>
                              <a class="btn btn-sm btn-info" 
                              href="<?php echo base_url().'editOld/'.$record->userId; ?>" 
                              title="Editar"><i class="far fa-edit"></i></a>    
                            <?php endif ?>
                            
                            <!-- <a class="btn btn-sm btn-danger deleteUser" href="#" data-userid="<?php echo $record->userId; ?>" title="Excluir"><i class="fa fa-trash"></i></a> -->
							              
                            <a href="#"
                              data-title="<i class='fa fa-trash' style='color:red;'></i>Fatura <?php echo $record->name ?>"
                              class="btn btn-secondary btn-sm btn-danger user_deleted" 
                              uid="<?php echo $record->userId; ?>"
                              title="Excluir este usuario" style="width: 30px;"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Nome</th>
                  <th>Login</th>
                  <th>E-mail</th>
                  <th>Celular</th>
                  <th>Perfil</th>
                  <th>Creado em</th>
                  <th class="text-center">Ações</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <script type="text/javascript">
        $(document).on('click','.user_deleted',function(){

          var id = $(this).attr('uid');

          $('#user_id').val(id);

          $('#modal-danger').modal({backdrop: 'static', keyboard: true, show: true});
        });
      </script>
      <div class="modal fade" id="modal-danger">
          <div class="modal-dialog">
            <form action="<?php echo base_url(); ?>deleteUser3" method="post"> 
              <div class="modal-content bg-danger">
                  <div class="modal-header">
                      <h4 class="modal-title">Confirmar Exclusão de Item</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <p>Clique em salvar para excluir &hellip;</p>
                      <input type="text" name="userId" id="user_id" value="">
                  </div>
                  <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-outline-light" data-dismiss="modal">Fechar</button>
                      <button type="submit" class="btn btn-outline-success">Salvar</button>
                  </div>
              </div>
              <!-- /.modal-content -->
            </form>  
          </div>
          <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
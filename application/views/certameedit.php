<?php
$Data = '';
$Hora = '';
foreach ($CertameInfo as $item) {
  $IdCertame = $item->Id;
  $Numero = $item->Numero;
  $Ano = $item->Ano;
  $Objeto = $item->Objeto;
  $Diretoria = $item->Diretoria;
  $Modalidade = $item->Modalidade;
  $Processo = $item->Processo;
  $Valor = $item->Valor; if($Valor != ""){$Valor = number_format($Valor, 2, ',', '.');}else{$Valor="0,00";}
  $DataHora = $item->DataHora;
  if($DataHora!=""){
    $Data = date("Y-m-d", strtotime($DataHora));
    $Hora = date("H:i", strtotime($DataHora));
  }
  
  $Visivel = $item->Visivel;
  $PrazoExecucao = $item->PrazoExecucao;
  
  $Expiracao = $item->Expiracao;
  if($Expiracao!=""){
    $Expiracao = date("Y-m-d", strtotime($Expiracao));
  }  
}
?>
<!-- Biblioteca de icone -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
                <i class="fa fa-users"></i> <?= $pageTitle ?>
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url("dashboard"); ?>">Inicio</a></li>
              <li class="breadcrumb-item active">Lista Licitações</li>
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
                        <h3 class="card-title">Alteração de licitação</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="editLicita" action="<?php echo base_url()?>Licita/saveLicita" method="post" role="form">
                      <input type="hidden" class="form-control col-md-2" id="licitacaoid" name="licitacaoid" value="<?php echo $IdCertame?>"/>
                      <div class="card-body">
                        <div class="row">
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="fname">Número</label>
                                    <input type="text" class="form-control"
                                    value="<?php echo $Numero?>" id="Numero" name="Numero"
                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                    maxlength="3" autofocus required>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="fname">Ano</label>
                                    <input type="text" class="form-control"
                                      value="<?php echo $Ano?>" id="Ano" name="Ano"
                                      maxlength="4" onkeypress="return event.charCode >= 48 && event.charCode <= 57" require required>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="role">Modalidade</label>
                                    <select class="form-control" id="Modalidade" name="Modalidade" required>
                                        <option value="">Selecione</option>
                                        <?php
                                          if(!empty($Modalidades))
                                          {
                                              foreach ($Modalidades as $rl)
                                              {
                                                ?>
                                                <option value="<?php echo $rl->Id; ?>" <?php if($rl->Id == $Modalidade) {echo "selected=selected";} ?>>
                                                  <?php echo $rl->Descricao ?></option>
                                                </option>
                                                <?php
                                              }
                                          }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="role">Diretoria</label>
                                    <select class="form-control" id="Diretoria" name="Diretoria" required>
                                        <option value="">Selecione</option>
                                        <?php
                                          if(!empty($Diretorias))
                                          {
                                              foreach ($Diretorias as $dir)
                                              {
                                                  ?>                                                  
                                                <option value="<?php echo $dir->Id; ?>" <?php if($dir->Id == $Diretoria) {echo "selected=selected";} ?>>
                                                  <?php echo $dir->Descricao ?></option>
                                                </option>
                                                <?php
                                              }
                                          }
                                        ?>
                                    </select>
                                </div>
                            </div>
                          </div>
                          <div class="form-group">
                              <label for="fname">Objeto</label>
                              <textarea class="form-control" name="Objeto" id="Objeto" rows="5" required><?php echo $Objeto?></textarea>
                          </div>
                          <div class="row">
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label for="matricula">Processo</label>
                                      <input type="text" class="form-control" name="Processo" id="Processo" maxlength="19"
                                      value="<?php echo $Processo?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                                  </div>
                              </div>
                              <div class="col-md-2">
                                  <div class="form-group">
                                      <label for="password">Data</label>
                                      <input type="date" class="form-control" id="Data" name="Data" maxlength="20" value="<?php echo $Data?>" required>
                                  </div>
                              </div>
                              <div class="col-md-1">
                                  <div class="form-group">
                                      <label for="password">Hora</label>
                                      <input type="time" class="form-control" id="Hora" name="Hora" maxlength="20" value="<?php echo $Hora?>" required>xxx
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label for="password">Data caução</label>
                                      <input type="date" class="form-control" id="CaucaoData" name="CaucaoData" maxlength="20" value="<?php echo $CaucaoData?>" required>
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label for="password">Prazo execução</label>
                                      <input type="text" class="form-control" id="PrazoExecucao" name="PrazoExecucao" maxlength="20"
                                      value="<?php echo $PrazoExecucao?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="fname">Exigências</label>
                              <textarea class="form-control" name="Exigencias" id="Exigencias" rows="5" required><?php echo $Exigencias?></textarea>
                          </div>
                          <div class="row">
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label for="matricula">Valor caução</label>
                                      <input type="text" class="form-control" id="CaucaoValor" name="CaucaoValor" maxlength="20" value="<?php echo $ValorCaucao?>" 
                                      onkeypress="return MascaraMoeda(this,'.',',',event); event.charCode >= 48 && event.charCode <= 57" required>
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label for="password">Data expiração</label>
                                      <input type="date" class="form-control" id="Expiracao" name="Expiracao" maxlength="20"
                                      value="<?php echo $Expiracao?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                                  </div>
                              </div>
                          </div>
                          <div class="card-footer">
                              <button type="submit" class="btn btn-outline-success">
                              <i class="fas fa-save"></i> Salvar</button>
                              <button class="btn btn-default" type="reset">
                              <i class="fas fa-broom"></i> Limpar</button>
                                  <a href="<?php echo base_url()?>licitadetail/<?php echo $IdCertame?>" class="btn btn-outline-primary">
                              <i class="fas fa-backward"></i> Cancelar</a>
                          </div>                            
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div><hr>
        <div>
      </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script src="<?php echo base_url(); ?>assets/js/editUser.js" type="text/javascript"></script>

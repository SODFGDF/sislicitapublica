  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1>Adicionar Licitação</h1>
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
                              <h3 class="card-title">Informar os dados da licitação</h3>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
                          <?php $this->load->helper("form"); ?>
                          <form role="form" id="addLicita" action="<?php echo base_url()?>createNewLicita" method="post" role="form">
                              <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="fname">Número</label>
                                            <input type="text" class="form-control required"
                                            value="<?php echo set_value('Numero')?>" id="Numero" name="Numero"
                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                            maxlength="3" autofocus required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="fname">Ano</label>
                                            <input type="text" class="form-control"
                                              value="<?php echo set_value('Ano')?>" id="Ano" name="Ano"
                                              maxlength="4" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
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
                                                        <option value="<?php echo $rl->Id ?>"
                                                            <?php //if($rl->roleId == set_value('Modalidade')) {echo "selected=selected";} ?>>
                                                            <?php echo $rl->Descricao ?></option>
                                                        <?php
                                                      }
                                                  }
                                                  ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="role">Diretoria</label>
                                            <select class="form-control" id="Diretoria" name="Diretoria" required>
                                                <option value="">Selecione</option>
                                                <?php
                                                  if(!empty($Diretorias))
                                                  {
                                                      foreach ($Diretorias as $rl)
                                                      {
                                                          ?>
                                                        <option value="<?php echo $rl->Id ?>"
                                                            <?php //if($rl->roleId == set_value('Diretoria')) {echo "selected=selected";} ?>>
                                                            <?php echo $rl->Sigla.' - '.$rl->Descricao ?></option>
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
                                      <textarea class="form-control" name="Objeto" id="Objeto" rows="5" required><?php echo set_value('Objeto')?></textarea>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <label for="matricula">Processo</label>
                                              <input type="text" class="form-control required" name="Processo" id="Processo" maxlength="19"
                                              value="<?php echo set_value('Processo')?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                                          </div>
                                      </div>
                                      <div class="col-md-2">
                                          <div class="form-group">
                                              <label for="password">Data</label>
                                              <input type="date" class="form-control required" id="Data" name="Data" maxlength="20" value="<?php echo set_value('Data')?>" required>
                                          </div>
                                      </div>
                                      <div class="col-md-1">
                                          <div class="form-group">
                                              <label for="password">Hora</label>
                                              <input type="time" class="form-control required" id="Hora" name="Hora" maxlength="20" value="<?php echo set_value('Hora')?>" required>
                                          </div>
                                      </div>
                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <label for="password">Data caução</label>
                                              <input type="date" class="form-control required" id="CaucaoData" name="CaucaoData" maxlength="20" value="<?php echo set_value('CaucaoData')?>" required>
                                          </div>
                                      </div>
                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <label for="password">Prazo execução</label>
                                              <input type="text" class="form-control required" id="PrazoExecucao" name="PrazoExecucao" maxlength="20"
                                              value="<?php echo set_value('PrazoExecucao')?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="fname">Exigências</label>
                                      <textarea class="form-control" name="Exigencias" id="Exigencias" rows="5" required><?php echo set_value('Exigencias')?></textarea>
                                  </div>

                                  <div class="row">
                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <label for="matricula">Valor caução</label>
                                              <input type="text" class="form-control" id="CaucaoValor" name="CaucaoValor" maxlength="20"
                                              value="<?php echo set_value('CaucaoValor')?>" 
                                              onkeypress="return MascaraMoeda(this,'.',',',event); event.charCode >= 48 && event.charCode <= 57" required>
                                          </div>
                                      </div>
                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <label for="password">Data expiração</label>
                                              <input type="date" class="form-control" id="Expiracao" name="Expiracao" maxlength="20"
                                              value="<?php echo set_value('Expiracao')?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                                          </div>
                                      </div>
                                  </div>

                                  <!-- /.card-body -->
                                  <div class="card-footer">
                                    <button type="submit" class="btn btn-outline-success">
                                    <i class="fas fa-save"></i> Salvar</button>
                                    <button class="btn btn-default" type="reset">
                                    <i class="fas fa-broom"></i> Limpar</button>
                                    <a href="<?php echo base_url()?>dashboard"
                                        class="btn btn-outline-primary">
                                        <i class="fas fa-backward"></i> Voltar</a>
                                  </div>
                          </form>
                      </div>
                      <!-- /.card -->
                </div>
                <!--/.col (right) -->
              </div>
              <!-- /.row -->
          </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script src="<?php echo base_url("assets/js/addUser.js"); ?>" type="text/javascript"></script>

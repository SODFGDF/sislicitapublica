<?php
$Data = '';
$Data = '';
foreach ($CertameInfo as $item) {
  $IdCertame = $item->Id;
  $Numero = $item->Numero;
  $Ano = $item->Ano;
  $Objeto = $item->Objeto;
  $Diretoria = $item->Diretoria;
  $Modalidade = $item->ModalidadeId;
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
<div class="col-sm-12">
<!-- Biblioteca de icone -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <section class="content">
    <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- jquery validation -->
      <div class="card">
        <div class="card-header" style="background-color: #1E90FF;">
            <h3 class="card-title">
              <i style='font-size:24px' class='far text-white'>&#xf15c;</i>&nbsp;&nbsp;<font color="white">Detalhamento de licitação</font>
            </h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <?php $this->load->helper("form"); ?>
        <form role="form" id="detailLicita" action="<?php echo base_url()?>createNewLicita" method="post" role="form">
          <div class="card-body">
            <div class="row">
                <div class="col-md-1">
                    <div class="form-group">
                      <label for="fname">Número</label>
                      <input type="text" class="form-control required"
                      value="<?php echo $Numero?>" id="Numero" name="Numero"
                      onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                      maxlength="3" autofocus disabled>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                      <label for="fname">Ano</label>
                      <input type="text" class="form-control required" value="<?php echo $Ano?>" id="Ano" name="Ano"
                      maxlength="4" onkeypress="return event.charCode >= 48 && event.charCode <= 57" require disabled>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="role">Modalidade</label>
                        <select class="form-control required" id="Modalidade" name="Modalidade" disabled>
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
                        <input type="text" class="form-control required" value="<?php echo $Diretoria?>" id="diretoria" name="diretoria" disabled>
                    </div>
                </div>
              </div>
              <div class="form-group">
                  <label for="fname">Objeto</label>
                  <textarea class="form-control text-justify" name="Objeto" id="Objeto" rows="5" disabled><?php echo $Objeto?></textarea>
              </div>
              <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="matricula">Processo</label>
                      <input type="text" class="form-control required" name="Processo" id="Processo" maxlength="19"
                      value="<?php echo $Processo?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                      <label for="password">Data</label>
                      <input type="date" class="form-control required" id="Data" name="Data" maxlength="20" value="<?php echo $Data?>" disabled>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                      <label for="password">Hora</label>
                      <input type="time" class="form-control required" id="Hora" name="Hora" maxlength="20" value="<?php echo $Hora?>" disabled>
                    </div>
                </div>                
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="password">Prazo execução</label>
                      <input type="text" class="form-control required" id="PrazoExecucao" name="PrazoExecucao" maxlength="20"
                      value="<?php echo $PrazoExecucao?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                    </div>
                </div>
              </div>              
              <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="matricula">Valor</label>
                      <input type="text" class="form-control required" id="Valor" name="Valor" maxlength="20"
                      value="<?php echo $Valor?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="password">Data expiração</label>
                    <input type="date" class="form-control required" id="Expiracao" name="Expiracao" maxlength="20"
                    value="<?php echo $Expiracao?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                  </div>
              </div>
            </div>
          </form>
              <hr>
              <div>
                <button type="button" class="btn btn-primary btnpequenomin">
                  <a href="<?php echo base_url()."dashboard"?>" style="color:white;font-size:15px;font-family: Helvetica, Arial;">
                    <i style="font-size:24px" class="fa">&#xf015;</i>  
                    &nbsp;Página inicial
                  </a>	
                </button>                        
                <button type="button" class="btn btn-primary btnpequenomin">
                  <a href="<?php echo base_url()."licitalisting/".$Modalidade?>" style="color:white;font-size:15px;font-family: Helvetica, Arial;">
                  <i style='font-size:24px' class='fas'>&#xf049;&nbsp;</i> Voltar
                  </a>	
                </button>                    
              </div>
          </div>
          <!-- /.card -->
      </div>
    </div><!-- /.card-body -->

    <div class="row col-md-12" style="margin-left:0px;"> <!-- ANEXAR DOCUMENTO INICIO -->
      <div class="card">
        <div class="card-body"> 
          <button class="btn btn-primary" type="button" data-toggle="collapse" 
            data-target="#collapseArqivoAnexa" aria-expanded="false" aria-controls="collapseExample">
            Documentos anexos &nbsp;&nbsp;&nbsp;<i style='font-size:24px' class='far'>&#xf07c;</i>
          </button>
          <div class="collapse" id="collapseArqivoAnexa">
            <?php if($Visivel==0){?>
            <hr>
            <?php } ?>
            <!-- /.card-header -->
            <?php
            if(!empty($AnexoFTP))
            {?>                
            <div class="card-body col-md-12">
              <table id="example1" class="table table-bordered table-striped" style="width: 100%;">
                <thead>
                <tr>
                  <th style="width:10%">Data</th>
                  <th class="text-left" style="width:75%">Descrição</th>
                  <th class="text-center" style="width:15%">Anexo</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    foreach($AnexoFTP as $anx)
                    {
                      $IdAnexo = $anx->Id;
                      $LicitacaoId = $anx->LicitacaoId;
                      $Inclusao = $anx->InclusaoData; 
                      $Inclusao = date("d/m/Y", strtotime($Inclusao));
                      $Nome = $anx->NomeArquivoUsuario;
                      $nome_ajustado = $anx->Nome;
                      $Descricao = $anx->Descricao;
                      $endereco = $anx->Endereco;
                      //$Tipo = $anx->AnexoTipo;
                    ?>
                    <tr>
                        <td class="text-center align-middle"><?php echo $Inclusao?></td>
                        <td><?php echo $Descricao ?></td>
                        <td class="text-center align-middle">
                            
                          <a href="<?php echo base_url().'licita/download/'.$IdAnexo.'/'.$nome_ajustado; ?>"  
                            title="Será aberta uma nova nova aba!">
                            <i style="font-size:24px" class="fa">&#xf08e;</i>
                          </a>
                            
                        </td>                                                             
                    </tr>
                    <?php                        
                    }
                    ?>
                </tbody>
              </table>
            </div>
            <?php } else{?><br>
              <div class="alert alert-warning" role="alert" style="margin-bottom: -0px;">
                Nenhum documento cadastrado!
              </div>
            <?php }?>                   
          </div>
        </div>                  
      </div>
    </div>
  </section>
</div>
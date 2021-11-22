
 <!-- Content Wrapper. Contains page content -->
 <!-- <div class="content-wrapper"> -->

<div class="container-fluid">
  <div class="row">
    <?php
    $bgcolor = '';
    $QuantidadeNaoVisivel = '';
    foreach ($LicitacaoIndex as $key => $value){
      $IdTipo = $value->Id;
      $Descricao = $value->Descricao;
      $QuantidadeVisivel = $value->QuantidadeVisivel;
      if($QuantidadeVisivel>0){?>
      <div class="col-md-3" style="max-width: 22rem;">
        <a href="<?php echo base_url()?>licitalisting/<?php echo $IdTipo?>">
          <div class="card border-light mb-6" style="max-width: 22rem;">
            <div class="card-header bg-secondary"><b><?php echo $Descricao?></b></div>
            <div class="card-body text-primary" style="font-size:75px; height:90px; background-color:#CEE3F6; text-align: center;">
              <table class="table table-borderless" style="opacity:0.8; height: 40px;"> 
                <tbody style="line-height:0px;">
                  <tr>
                    <td class="align-middle">
                      <b><?php echo $QuantidadeVisivel?></b></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </a>
      </div><?php
      }
    } ?>
  </div>
  <div class="row d-flex justify-content-center">
    <div class="col-md-4 d-flex justify-content-center">
      <a href="<?php echo base_url().'licita/downloadbase'; ?>">
        <div class="card border-light mb-6" style="max-width: 22rem;">
          <div class="card-header bg-secondary"><b>Manual de cadastro</b></div>
          <div class="card-body text-primary" style="font-size:75px; height:90px; background-color:#FF0000; text-align: center;">
            <table class="table table-borderless" style="opacity:0.8; height: 40px;"> 
              <tbody style="line-height:0px;">
                <tr>
                  <td class="align-middle">
                    <b><a href="<?php echo base_url().'licita/downloadbase'; ?>" class="btn btn-outline-primary btn-lg font-weight-bold" style="color: white;">Clique aqui para baixar!</a></b></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </a>
    </div>
  </div>
        
</div>
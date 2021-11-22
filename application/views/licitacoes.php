<style>
@media only screen and (max-width: 800px) {
    
    /* Force table to not be like tables anymore */
	#no-more-tables table, 
	#no-more-tables thead, 
	#no-more-tables tbody, 
	#no-more-tables th, 
	#no-more-tables td, 
	#no-more-tables tr { 
		display: block; 
	}
 
	/* Hide table headers (but not display: none;, for accessibility) */
	#no-more-tables thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
 
	#no-more-tables tr { border: 1px solid #ccc; }
 
	#no-more-tables td { 
		/* Behave  like a "row" */
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
		white-space: normal;
		text-align:left;
	}
 
	#no-more-tables td:before { 
		/* Now like a table header */
		position: absolute;
		/* Top/left values mimic padding */
		top: 6px;
		left: 6px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
		text-align:left;
		font-weight: bold;
	}
 
	/*
	Label the data
	*/
	#no-more-tables td:before { content: attr(data-title); }
}
</style>

<div class="row col-12 col-sm-12 col-lg-12">
    <h4>
       
                      
        
        <i class="fa fa-arrow-circle-down"></i><b> <?php echo $Modalidade.'('.$totLicitaModalidade.')';?></b>
    </h4>

  <div class="col-12 col-sm-12 col-lg-12">
    <div class="row">
        <div id="no-more-tables">
          <table id="tblicita" class="col-md-12 table table-bordered table-striped table-condensed cf">
        		<thead class="cf">
        			<tr>
        				<th style="width: 15%; vertical-align: middle;">Número/ano</th>
        				<th style="width: 50%; vertical-align: middle; font-size: 16px;">Descrição/objeto</th>
        				<th class="numeric" style="width: 15%; vertical-align: middle; text-align: center;">Data hora</th>
        				<th class="numeric" style="width: 15%; vertical-align: middle; text-align: center;">Custo estimado</th>
        				<th class="numeric" style="width: 5%; vertical-align: middle; text-align: center;">Anexos</th>
        			</tr>
        		</thead>
        		<tbody>
            <?php
            if(!empty($LicitaModalidade)){
              foreach($LicitaModalidade as $rec){
                $Objeto = $rec->Objeto;
                ?>
        			<tr>
                <td data-title="Número/ano" class="align-middle">
                  <a href="<?= base_url().'licitadetail/'.$rec->Id?>" title="Detalhamento e anexos">
                    <?php echo $rec->Numero.'/'.$rec->Ano ?> <i class="fas fa-arrow-circle-right"></i>
                  </a>
                </td>
        				<td data-title="Descrição/objeto" style="text-align: justify; font-size: 12px;"><?php echo $Objeto?></td>
        				<td data-title="Data-hora" class="numeric" style="vertical-align: middle; text-align: center;"><?php echo date("d/m/Y H:i", strtotime($rec->DataHoraCertame))?></td>
        				<td data-title="Custo estimado" class="numeric" style="vertical-align: middle; text-align: center;"><?php echo number_format($rec->Valor,2,',','.')?></td>
        				<td data-title="Anexos" class="numeric" style="vertical-align: middle; text-align: center;">
                  <a class="btn btn-sm btn-primary" href="<?= base_url().'licitadetail/'.$rec->Id;?>" title="Detalhamento e anexos"><i class='fa fa-folder-open' style='font-size:24px'></i></a>
                </td>
              </tr>
              <?php
              }
            }
            ?>              
        		</tbody>
          </table>          
          <hr>
        <button type="button" class="btn btn-primary btnpequenomin">
            <a href="<?php echo base_url()."dashboard"?>" style="color:white;font-size:15px;font-family: Helvetica, Arial;">
              <i style="font-size:24px" class="fa">&#xf015;</i>  
              &nbsp;Página inicial
            </a>	
          </button>
        </div>
    </div>
</div>

</div>
<script type="text/javascript">
  $(document).ready(function() { //Chamada para datatables
    responsive: true;
      $('#tblicita').dataTable( {
          "language": {
              "url": "<?php echo base_url()?>/assets/plugins/datatables/pt-br.json"
          },
          columnDefs: [
            { orderable: false, targets: -1 } //desabilitar ordenamento na última coluna
          ]
      } );
  } );
</script>
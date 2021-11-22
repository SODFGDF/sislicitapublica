<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        <i class="fa fa-users"></i> Histórico de Login
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url("dashboard"); ?>">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url("userListing"); ?>">Lista</a></li>
                        <li class="breadcrumb-item active">Histórico</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Filtros para busca do Histórico</h3>
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                          <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                    <form action="<?php echo base_url("login-history") ?>" method="POST" id="searchList">
                      <div class="row">
                        <div class="col-3">
                          <!-- Date dd/mm/yyyy -->
                          <div class="form-group">
                            <label>Dt. Inicial:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" name="fromDate"
                                    class="form-control" data-inputmask-alias="datetime"
                                    data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                            </div>
                            <!-- /.input group -->
                          </div>
                          <!-- /.form group -->
                        </div>
                        <div class="col-3">
                          <!-- Date dd/mm/yyyy -->
                          <div class="form-group">
                            <label>Dt. Final:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" name="toDate"
                                    class="form-control" data-inputmask-alias="datetime"
                                    data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                            </div>
                            <!-- /.input group -->
                          </div>
                          <!-- /.form group -->
                        </div>
                        <div class="col-4">
                          <div class="form-group">
                            <label>Procura:</label>
                            <input id="searchText" type="text" name="searchText" 
                              value="<?php echo $searchText; ?>"
                              class="form-control" placeholder="Seu texto" />
                          </div>  
                        </div>
                        <div class="col-1">
                          <label>&nbsp;</label>
                          <button type="submit" 
                            class="btn btn-md btn-outline-primary btn-block searchList pull-right"
                            title="Pesquisar">
                              <i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                        <div class="col-1">
                          <label>&nbsp;</label>
                          <button class="btn btn-md btn-default btn-block pull-right resetFilters" title="Renovar">
                            <i class="fas fa-sync-alt" aria-hidden="true"></i></button>
                        </div> 
                      </div><!-- /.end row -->  
                   
                        <!-- Date and time range -->
                        <div class="form-group">
                            <label>Escolha data customizada</label>

                            <div class="input-group">
                                <button type="button" class="btn btn-default float-right" id="daterange-btn">
                                    <i class="far fa-calendar-alt"></i> Data por período
                                    <i class="fas fa-caret-down"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.form group -->
                    </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col (right) -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Listagem de histórico de Login do usuário no sistema <b>(
                                <?= !empty($userInfo) ? $userInfo->name." : ".$userInfo->email : "All users" ?>)</b>
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tblHistorico" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Session Data</th>
                                    <th>IP Address</th>
                                    <th>User Agent</th>
                                    <th>Agent Full String</th>
                                    <th>Platform</th>
                                    <th>Date-Time</th>
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
                                    <td><?php echo $record->sessionData ?></td>
                                    <td><?php echo $record->machineIp ?></td>
                                    <td><?php echo $record->userAgent ?></td>
                                    <td><?php echo $record->agentString ?></td>
                                    <td><?php echo $record->platform ?></td>
                                    <td><?php echo $record->createdDtm ?></td>
                                </tr>
                                <?php
                        }
                    }
                    ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery('ul.pagination li a').click(function(e) {
        e.preventDefault();
        var link = jQuery(this).get(0).href;
        var value = link.substring(link.lastIndexOf('/') + 1);
        jQuery("#searchList").attr("action", baseURL + "userListing/" + value);
        jQuery("#searchList").submit();
    });
});
</script>
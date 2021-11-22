<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>NOVACAP | Licitações</title>
  <link rel='icon' href='<?php echo base_url("assets/images/icone.ico"); ?>' type='image/x-icon' sizes="16x16" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url("assets/plugins/fontawesome-free/css/all.min.css"); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url("assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"); ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url("assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css"); ?>">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url("assets/plugins/jqvmap/jqvmap.min.css"); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url("assets/dist/css/adminlte.min.css"); ?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url("assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css"); ?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url("assets/plugins/daterangepicker/daterangepicker.css"); ?>">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url("assets/plugins/summernote/summernote-bs4.css"); ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
    .error {
      color: red;
      font-weight: normal;
    }
 </style>
<script type="text/javascript">
  var baseURL = "<?php echo base_url(); ?>";

  function MascaraMoeda(objTextBox, SeparadorMilesimo, SeparadorDecimal, e){
    var sep = 0;
    var key = '';
    var i = j = 0;
    var len = len2 = 0;
    var strCheck = '0123456789-';
    var aux = aux2 = '';
    var whichCode =
        e.keyCode ? e.keyCode :
		e.charCode ? e.charCode :
		e.which ? e.which : void 0;

    if (whichCode == 13 || whichCode == 8) return true;
    key = String.fromCharCode(whichCode); // Valor para o código da Chave
    if (strCheck.indexOf(key) == -1) return false; // Chave inválida
    len = objTextBox.value.length;
    for(i = 0; i < len; i++)
        if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal)) break;
    aux = '';
    for(; i < len; i++)
        if (strCheck.indexOf(objTextBox.value.charAt(i))!=-1) aux += objTextBox.value.charAt(i);
    aux += key;
    len = aux.length;
    if (len == 0) objTextBox.value = '';
    if (len == 1) objTextBox.value = '0'+ SeparadorDecimal + '0' + aux;
    if (len == 2) objTextBox.value = '0'+ SeparadorDecimal + aux;
    if (len > 2) {
        aux2 = '';
        for (j = 0, i = len - 3; i >= 0; i--) {
            if (j == 3) {
                aux2 += SeparadorMilesimo;
                j = 0;
            }
            aux2 += aux.charAt(i);
            j++;
        }
        objTextBox.value = '';
        len2 = aux2.length;
        for (i = len2 - 1; i >= 0; i--)
        objTextBox.value += aux2.charAt(i);
        objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);
    }
    return false;
}
</script>
<!-- jQuery -->
<script src="<?php echo base_url("assets/plugins/jquery/jquery.min.js"); ?>"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper col-12 col-sm-12 col-lg-12">

<aside class="elevation-4" style="background-color: #1E90FF;">
  <a href="<?php echo base_url(); ?>dashboard" class="brand-link">
  <img src="<?php echo base_url("assets/images/logo_reduzida.png"); ?>" alt="NOVACAP Logo"
      class="brand-image img-circle elevation-3"
      style="opacity: .8">
    <span class="brand-text font-weight-bold text-white">NOVACAP Licitações</span>
  </a>
</aside>
<hr>
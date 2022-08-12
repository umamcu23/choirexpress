<?php
date_default_timezone_set("Asia/Jakarta");
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/images/icon/choir-logo.PNG') ?> ">
    <title><?= $title; ?></title>


    <!-- Custom CSS -->
    <link href="<?= base_url('assets/'); ?>extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="<?= base_url('assets/'); ?>dist/css/style.min.css" rel="stylesheet">


    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css" rel="stylesheet">
    </link>

    <script async src="https://cdn.carbonads.com/carbon.js?serve=CE7D4277&placement=iconsgetbootstrapcom" id="_carbonads_js"></script>

    <!-- Icon Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!-- Datatables -->
    <link href="<?= base_url('assets/datatables/datatables/css/dataTables.bootstrap.css') ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <style>

    </style>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/dist/css/custom.css') ?>">

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
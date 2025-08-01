<!doctype html>

<html
  lang="en"
  class="layout-menu-fixed layout-compact"
  data-assets-path="assets/"

  data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>GadgetIn Kasir</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cg fill='%23ff9800'%3E%3Cpath d='M1 0a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h5v1H2v2h6V9H2V2h10v4h2V1a1 1 0 0 0-1-1z'/%3E%3Cpath d='M10 7a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1zm1 7V9h3v5z'/%3E%3C/g%3E%3C/svg%3E" 
  
  />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />

  <link rel="stylesheet" href="assets/vendor/fonts/iconify-icons.css" />

  <!-- Serach 2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <!-- Core CSS -->
  <!-- build:css assets/vendor/css/theme.css  -->

  <link rel="stylesheet" href="assets/vendor/css/core.css" />
  <link rel="stylesheet" href="assets/css/demo.css" />

  <!-- Vendors CSS -->

  <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <!-- endbuild -->

  <link rel="stylesheet" href="assets/vendor/libs/apex-charts/apex-charts.css" />

  <!-- Page CSS -->



  <!-- Helpers -->
  <script src="assets/vendor/js/helpers.js"></script>
  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

  <script src="assets/js/config.js"></script>

  <link rel="stylesheet" href="assets/css/custom-overrides.css" />
  <link rel="stylesheet" href="assets/css/sidebar-highlight-overrides.css" />

  <style>
    .select2-container .select2-selection--single {
      height: 48px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
      line-height: 48px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
      height: 48px !important;
    }
  </style>

</head>

<body>

  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">



      <?php
      include('sidebar.php');

      ?>

      <div class="layout-page">
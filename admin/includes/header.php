<?php
session_start();
include '../includes/config.php';
include 'controller/functions.php';
date_default_timezone_set('Asia/Manila');
// Check if the user is logged in and has the 'role' session variable set
if (!isset($_SESSION['role'])) {
   // User is not logged in, redirect to the login page
   header('Location:../index.php');
   exit();
}

// Check if the user has the 'Client' role
if ($_SESSION['role'] !== 'admin') {
   // User is not an admin, you can either log them out or redirect to an admin-only page
   // For logging out:
   // unset($_SESSION['role']);
   // session_destroy();

   // For redirecting to an admin-only page:
   header('Location:../index.php'); // Create this page for access denied message
   exit();
}
?>
<!DOCTYPE html>
<html>

<head>
   <!-- Basic Page Info -->
   <meta charset="utf-8">
   <title>Dashboard</title>
   <!-- Site favicon -->
   <link rel="icon" type="image/x-icon" href="../assets/img/avatars/favico.ico" />
   <!-- Mobile Specific Metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   <!-- Google Font -->
   <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet"> <!-- CSS -->
   <link rel="stylesheet" type="text/css" href="src/plugins/fullcalendar/fullcalendar.css">
   <link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
   <link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
   <link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css">
   <link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css">
   <link rel="stylesheet" type="text/css" href="vendors/styles/style.css">
   <link rel="stylesheet" type="text/css" href="src/plugins/dropzone/src/dropzones.css">
   <!-- Global site tag (gtag.js) - Google Analytics -->
   <script async src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"></script>
   <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2973766580778258" crossorigin="anonymous"></script>
</head>

<script>
   function formatIdNumber(input) {
      let value = input.value.replace(/[^0-9]/g, ''); // Remove all non-numeric characters
      let formattedValue = '';
      for (let i = 0; i < value.length; i++) {
         if (i > 0 && i % 4 === 0) {
            formattedValue += '-';
         }
         formattedValue += value[i];
      }
      input.value = formattedValue;
   }

   function isNumberKey(event) {
      var charcode = (event.which) ? event.which : event.keyCode;
      if (charcode > 31 && (charcode < 48 || charcode > 57)) return false;
      return true

   }
</script>
<style>
   body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      font-weight: 400;
      min-height: 100%;
      color: #031e23;
      background: #eaedff;
   }

   .btn-primary {
      color: #fff;
      background-color: #4861ff;
      border-color: #4861ff;
   }

   .btn-success {
      color: #fff;
      background-color: #6375e7;
      border-color: #ffffff;
   }

   .btn-success:hover {
      color: #fff;
      background-color: #6375e7;
      border-color: #ffffff;
   }

   .hover-indicator {
      background-color: #5381f8;
      /* Bootstrap table hover color */
      color: white;
   }

   @import url('https://fonts.googleapis.com/css?family=Poppins');

   *,
   *:before,
   *:after {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
   }

   .table td {
      font-size: 15px;
      font-weight: 500;
      padding: 1rem;
   }

   .container {
      display: flex;
      flex-direction: column;
      justify-content: center;
      gap: 2rem;
      width: 100%;
      max-width: 50rem;
      padding: 4rem;
      color: #191a3c;
      background-color: #fff;
      border-radius: 3rem;
      position: relative;
      transition: all .3s linear;
   }

   .title-box>h1 {
      font-size: 2.4rem;
   }

   .title-box>p {
      margin-top: .5rem;
      font-size: 1.2rem;
      font-weight: 800;
      letter-spacing: .03rem;
   }

   .product-box {
      display: flex;
      justify-content: center;
      gap: 2rem;
   }

   .amount {
      width: 2.5rem;
      border: 1px solid #d1d1d1;
      outline: none;
      border-radius: .3rem;
      text-align: center;
      color: #191a3c;
   }

   input[type="number"]::-webkit-inner-spin-button,
   input[type="number"]::-webkit-outer-spin-button {
      -webkit-appearance: none;
      margin: 0;
   }

   input[type="number"] {
      -moz-appearance: textfield;
   }

   hr {
      border: none;
      border-top: 1px solid #e9e9e9;
   }

   .cost-box {
      display: flex;
      flex-direction: column;
      gap: 2rem;
   }

   .cost-box>div {
      display: flex;
      justify-content: space-between;
      font-size: 1.3rem;
   }

   .cost-box>div:nth-of-type(1)>p:nth-of-type(2) {
      font-weight: bold;
   }

   .cost-box>div:nth-of-type(2)>p:nth-of-type(2) {
      font-weight: bold;
   }

   .cost-box>div:nth-of-type(3)>p {
      font-weight: bold;
   }

   .cost-box>p {
      color: #5381f8;
      font-size: 1.1rem;
      text-decoration: underline;
      cursor: pointer;
   }

   .applied {
      position: absolute;
      background-color: #191a3c;
      border-radius: 5px 0 0 5px;
      color: #fff;
      padding: .5rem 1rem;
      bottom: 9.6rem;
      right: 0;
      opacity: 0;
      transition: all .3s linear;
   }

   .Checkout-btn {
      position: relative;
      margin-top: .5rem;
      width: 90%;
      position: relative;
      left: 50%;
      transform: translateX(-50%);
      background-color: #5381f8;
      border: none;
      color: #fff;
      padding: 1rem 3rem;
      font-size: 1.5rem;
      border-radius: 2rem;
      cursor: pointer;
      transition: all .25s linear;
   }

   .contact-directory-box:hover .view-contact a,
   .header-left .header-search .dropdown .dropdown-toggle:hover,
   .header-left .header-search .dropdown.show .dropdown-toggle {
      background: #6375e7;
      color: #fff;
   }

   .promo-box {
      text-align: center;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      gap: 1rem;
      width: 50%;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      padding: 5rem;
      background-color: #191a3c;
      border-radius: 1rem;
      color: #fff;
      opacity: 0;
      display: none;
      transition: all .3s linear;
   }

   .promo-box>h5 {
      font-size: 1.6rem;
   }

   #promo {
      width: 10rem;
      outline: none;
      border: none;
      padding: .4rem 1rem;

      font-family: 'Poppins', sans-serif;
      font-size: 1.7rem;
   }

   .send-promo {
      border: none;
      outline: none;
      padding: .2rem .6rem;
      border-radius: 3px;
      margin-top: .3rem;
      color: #191a3c;

      font-family: 'Poppins', sans-serif;
      cursor: pointer;
      font-weight: bold;
   }

   .sidebar-light .left-side-bar {
      background: #1B5E00;
   }

   .sidebar-light .sidebar-menu>ul>li>.dropdown-toggle.active {
      background-color: #1B5E00;
      color: #fff;
   }

   .sidebar-light .sidebar-menu .dropdown-toggle {
      color: #fbfbfb;
      font-weight: 500;
   }

   .sidebar-light .sidebar-menu .dropdown-toggle .micon {
      color: #ffffff;
   }

   .left-side-bar .close-sidebar {
      font-size: 18px;
      color: #fff;
      cursor: pointer;
      position: absolute;
      right: 10px;
      top: 20px;
   }

   .sidebar-light .sidebar-menu .dropdown-toggle:hover,
   .sidebar-light .sidebar-menu .show>.dropdown-toggle,
   .sidebar-light .sidebar-menu .submenu li a.active,
   .sidebar-light .sidebar-menu .submenu li a:hover {
      color: #fff;
      background-color: #85ac99;
   }

   input[type=file] {
      position: absolute;
      top: 0;
      right: 0;
      margin: 0;
      padding: 0;
      font-size: 20px;
      cursor: pointer;
      opacity: 0;
      filter: alpha(opacity=0);
   }

   *,
   *:before,
   *:after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
   }

   body {
      font-family: sans-serif;
   }

   #wrapper {
      margin-left: auto;
      margin-right: auto;
      max-width: 80em;
   }

   #container {
      float: left;
      padding: 1em;
      width: 100%;
   }

   @font-face {
      font-family: 'AlgerianRegular';
      src: url('../assets/algerian/Algerian-Regular.ttf') format('truetype');
      /* Replace 'path/to/Algerian-Regular.ttf' with the actual path to your font file */
      font-weight: normal;
      font-style: normal;
   }

   .certificate-container {
      background-color: white !important;
      border: 5px double #333;
   }

   .certificate-header {
      border-bottom: 2px solid #333;
      padding-bottom: 1rem;
   }

   .logo {
      max-height: 80px;
   }

   .certificate-title {
      font-family: 'AlgerianRegular', sans-serif;
      font-size: 2.5rem;
      color: #333;
   }

   h4 {
      font-family: 'AlgerianRegular', sans-serif;
      font-size: 1.5rem;
      color: #333;
   }
</style>
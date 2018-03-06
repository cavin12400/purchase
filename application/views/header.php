<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Purchase Module | Sales and Inventory System</title>
	
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/less/bootstrap-less/css/bootstrap-select.min.css'?>">
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/less/bootstrap-less/css/bootstrap.css'?>">
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/font-awesome.css'?>" >
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/daterangepicker.css'?>">
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/jquery.dataTables.min.css'?>">
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/styles.css'?>">
</head>
<body>
		<nav class="navbar navbar-default">
		  <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="#">Sales and Inventory System</a>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav">
		        <li><a href="#">Dashboard</a></li>
		        <li><a href="#">Suppliers</a></li>
		        <li><a href="#">Products</a></li>
		        <li class="active"><a href="<?php echo base_url().'purchase/start' ?>">Purchases</a></li>
		        <li><a href="#">Customers</a></li>
		        <li><a href="#">Sales</a></li>
		        
		      </ul>
		      <ul class="nav navbar-nav navbar-right">
		        <li><a href="#">Logout</a></li>
		        
		      </ul>
		    </div>
		  </div>
		</nav>
		<section class="container">
		

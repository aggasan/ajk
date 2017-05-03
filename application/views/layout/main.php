<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.2
Version: 3.7.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]--> 
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/> 
<title>SMARTCREDIT</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?= base_url('theme')?>/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url('theme')?>/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url('theme')?>/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url('theme')?>/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url('theme')?>/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?= base_url('theme')?>/assets/global/plugins/select2/select2.css"/>

<link rel="stylesheet" type="text/css" href="<?= base_url('theme')?>/assets/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url('theme')?>/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url('theme')?>/assets/global/plugins/bootstrap-summernote/summernote.css">
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN PAGE STYLES -->
<link href="<?= base_url('theme')?>/assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url('theme')?>/assets/global/plugins/icheck/skins/all.css" rel="stylesheet"/>

<!-- END PAGE STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?= base_url('theme')?>/assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?= base_url('theme')?>/assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url('theme')?>/assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url('theme')?>/assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?= base_url('theme')?>/assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->

<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?= base_url('theme')?>/assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url('theme')?>/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url('theme')?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<script src="<?= base_url('theme')?>/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
<script type="text/javascript">
        var BASE_PATH = '<?php echo base_url(); ?>';
        var SITE_PATH = '<?php echo site_url(); ?>/';
        var BASE_ICONS = BASE_PATH + 'images/icons/';
</script>
</head>
<?php
	date_default_timezone_set("Asia/Jakarta");
?>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-header-fixed page-quick-sidebar-over-content">
<!-- BEGIN HEADER -->
<div class="page-header -i navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="#">
			<!-- <img src="<?= base_url('theme')?>/assets/admin/layout/img/logo.png" alt="logo" class="logo-default"/> -->
			</a>
			<div class="menu-toggler sidebar-toggler hide">
				<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
			</div>
		</div>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right">
				<!-- BEGIN NOTIFICATION DROPDOWN -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
				<li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<i class="icon-bell"></i>
					<span class="badge badge-default">
					1 </span>
					</a>
					<ul class="dropdown-menu">
						<li class="external">
							<h3><span class="bold">1 pending</span> notifications</h3>
							<a href="#">view all</a>
						</li>
						<li>
							<ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
								<li>
									<a href="javascript:;">
									<span class="time">just now</span>
									<span class="details">
									<span class="label label-sm label-icon label-success">
									<i class="fa fa-plus"></i>
									</span>
									New user registered. </span>
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</li>
				<!-- END NOTIFICATION DROPDOWN -->
				<!-- BEGIN INBOX DROPDOWN -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
				<li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<i class="icon-envelope-open"></i>
					<span class="badge badge-default">
					1 </span>
					</a>
					<ul class="dropdown-menu">
						<li class="external">
							<h3>You have <span class="bold">1 New</span> Messages</h3>
							<a href="page_inbox.html">view all</a>
						</li>
						<li>
							<ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
								<li>
									<a href="inbox.html?a=view">
									<!-- <span class="photo">
									<img src="<?= base_url('theme')?>/assets/admin/layout3/img/avatar2.jpg" class="img-circle" alt="">
									</span> -->
									<span class="subject">
									<span class="from">
									<?= $this->session->userdata('username') ?> </span>
									<span class="time">Just Now </span>
									</span>
									<span class="message">
									Selamat datang di Smart Credit </span>
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</li>
				<!-- END INBOX DROPDOWN -->
				
				<!-- BEGIN USER LOGIN DROPDOWN -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
				<li class="dropdown dropdown-user">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<!-- <img alt="" class="img-circle" src="<?= base_url('theme')?>/assets/admin/layout/img/avatar3_small.jpg"/> -->
					<span class="username username-hide-on-mobile"><?= $this->session->userdata('username').' - '.$this->session->userdata('bank_name') ?></span>
					<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-default">
						<li>
							<a href="#">
							<i class="icon-user"></i> My Profile </a>
						</li>
						<li class="divider">
						</li>
						<li>
							<a href="#">
							<i class="icon-lock"></i> Lock Screen </a>
						</li>
						<li>
							<a href="<?= site_url('user/do_logout')?>">
							<i class="icon-key"></i> Log Out </a>
						</li>
					</ul>
				</li>
				<!-- END USER LOGIN DROPDOWN -->
				<!-- BEGIN QUICK SIDEBAR TOGGLER -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
				<li class="dropdown dropdown-quick-sidebar-toggler">
					<a href="javascript:;" class="dropdown-toggle">
					<i class="icon-logout"></i>
					</a>
				</li>
				<!-- END QUICK SIDEBAR TOGGLER -->
			</ul>
		</div>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
			<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
			<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
			<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
			<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
			<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
			<ul class="page-sidebar-menu page-sidebar-menu-light" data-keep-expanded="true" data-auto-scroll="true" data-slide-speed="200">
				<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler">
					</div>
					<!-- END SIDEBAR TOGGLER BUTTON -->
				</li>
				<!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
				
				<?php $parent_selected = $this->uri->segment(1); ?>
				<?php $parent_selected_second = $this->uri->segment(1).'/'.$this->uri->segment(2); ?>
				<li <?php if($parent_selected == 'home'){ echo 'class="start active open"'; } ?> >
					<a href="<?= site_url('home')?>">
					<i class="icon-home"></i>
					<span class="title">Dashboard</span>
					<span class="selected"></span>
					</a>
				</li>
    			<?php 
            		$roles_id = $this->session->userdata('roles_id');
                	$query = $this->db->query("
                				SELECT b.* from module_line as a, module as b, roles_permission as c
								WHERE a.module_id = b.module_id
								AND a.module_line_id = c.module_line_id
								AND c.permission = 1
								AND b.module_parent = 0
								AND c.roles_id = '$roles_id' AND a.module_line_name = 'is_view'
								ORDER BY b.sort ASC"); 

                	if ($query->num_rows() > 0) {
                	foreach ($query->result() as $row) {
                		$module_id = $row->module_id; 
                		$module_parent = $row->module_parent; 
                		$query_check = $this->db->query("SELECT b.* from module_line as a, module as b,
                						roles_permission as c
										WHERE a.module_id = b.module_id
										AND a.module_line_id = c.module_line_id
										AND c.permission = 1
										AND c.roles_id = '$roles_id'
										AND b.module_parent = '$module_id' AND a.module_line_name = 'is_view'
								"); 
                		if ($query_check->num_rows() > 0) {
                			$ses_query = $this->db->query("SELECT module_parent from module where module_address = '$parent_selected_second'");
                			$ses_row = $ses_query->row();
                			if ($ses_query->num_rows() > 0) {
                ?>
					<li <?php if($ses_row->module_parent == $module_id){ echo 'class="start active open"'; } ?> >
					<?php } else { ?>
					<li>
					<?php } ?>
					<a href="javascript:;">
					<i class="icon-<?= $row->class ?>"></i>
					<span class="title"><?= $row->module_name ?></span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<?php
		                  	$childquery = $this->db->query("SELECT b.* from module_line as a, module as b,
                						roles_permission as c
										WHERE a.module_id = b.module_id
										AND a.module_line_id = c.module_line_id
										AND c.permission = 1
										AND c.roles_id = '$roles_id'
										AND b.module_parent = '$module_id'  AND a.module_line_name = 'is_view'"); 
		                  	if ($childquery->num_rows() > 0) {
		                    foreach ($childquery->result() as $childrow) {
              			?>	
						<li>
							<a href="<?= site_url('').$childrow->module_address ?>">
							<i class="icon"></i><?= $childrow->module_name ?></a>
						</li>
						<?php } } ?>
					</ul>
				</li>
				<?php } else { ?>
				<li <?php if($parent_selected_second == $row->module_address){ echo 'class="start active open"'; } ?> >
					<a href="<?= site_url('').$row->module_address?>">
					<i class="icon-<?= $row->class ?>"></i>
					<span class="title"><?= $row->module_name ?></span>
					<span class="selected"></span>
					</a>
				</li>
				<?php } } } ?>
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Modal title</h4>
						</div>
						<div class="modal-body">
							 Widget settings form goes here
						</div>
						<div class="modal-footer">
							<button type="button" class="btn blue">Save changes</button>
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			<?= $title_1 ?> <small><?= $title_2 ?></small>
			</h3>
			
			<?= $content ?>
			
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		 2017 &copy; SMARTCREDIT.
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?= base_url('theme')?>/assets/global/plugins/respond.min.js"></script>
<script src="<?= base_url('theme')?>/assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->

	<script src="<?= base_url('theme')?>/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="<?= base_url('theme')?>/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
	<script src="<?= base_url('theme')?>/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?= base_url('theme')?>/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
	<script src="<?= base_url('theme')?>/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="<?= base_url('theme')?>/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
	<script src="<?= base_url('theme')?>/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
	<script src="<?= base_url('theme')?>/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
	<script src="<?= base_url('theme')?>/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
	<!-- END CORE PLUGINS -->
	<script src="<?= base_url('theme')?>/assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?= base_url('theme')?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<!--DATATABLE-->
	<script type="text/javascript" src="<?= base_url('theme')?>/assets/global/plugins/select2/select2.min.js"></script>
	<script type="text/javascript" src="<?= base_url('theme')?>/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="<?= base_url('theme')?>/assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
	<script type="text/javascript" src="<?= base_url('theme')?>/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
	<script src="<?= base_url('theme')?>/assets/admin/pages/scripts/table-advanced.js"></script>
	<script type="text/javascript" src="<?= base_url('theme')?>/assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
	<script src="<?= base_url('theme')?>/assets/admin/pages/scripts/form-validation.js"></script>
	<script src="<?= base_url('theme')?>/assets/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
	<!-- <script src="<?= base_url('theme')?>/assets/admin/pages/scripts/table-ajax.js"></script> -->
<!-- END PAGE LEVEL SCRIPTS -->
<!-- END JAVASCRIPTS -->
<!--END DATATABLE-->
<!-- FORM SAMPLE-->
	<script src="<?= base_url('theme')?>/assets/admin/pages/scripts/form-samples.js"></script>
<!-- END FORM SAMPLE-->
<!--ICHECK-->
	<script src="<?= base_url('theme')?>/assets/global/plugins/icheck/icheck.min.js"></script>
	<script src="<?= base_url('theme')?>/assets/admin/pages/scripts/form-icheck.js"></script>
<!--END ICHECK-->
<!--PICKER-->
	<script type="text/javascript" src="<?= base_url('theme')?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="<?= base_url('theme')?>/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<!-- END PICKER-->
<!-- INPUT MASK -->
	<script src="<?= base_url('theme')?>/assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
<!-- END INPUT MASK -->
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="<?= base_url('theme')?>/assets/global/scripts/metronic.js" type="text/javascript"></script>
	<script src="<?= base_url('theme')?>/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
	<script src="<?= base_url('theme')?>/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
	<script src="<?= base_url('theme')?>/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
	<script src="<?= base_url('theme')?>/assets/admin/pages/scripts/index.js" type="text/javascript"></script>
	<script src="<?= base_url('theme')?>/assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>
	<script src="<?= base_url('theme')?>/assets/admin/pages/scripts/components-pickers.js"></script>
	<script src="<?= base_url('theme')?>/assets/admin/pages/scripts/components-form-tools.js"></script>
	<script src="<?= base_url('theme')?>/assets/admin/pages/scripts/components-editors.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
	<script>
	jQuery(document).ready(function() {    
	   	Metronic.init(); // init metronic core componets
	   	Layout.init(); // init layout
	   	QuickSidebar.init(); // init quick sidebar
		Demo.init(); // init demo features
	   	Index.init();   
	   	ComponentsPickers.init();
	   	// ComponentsFormTools.init();
	   	Index.initDashboardDaterange();
	   	// Index.initJQVMAP(); // init index page's custom scripts
	   	// Index.initCalendar(); // init index page's custom scripts
	   	// Index.initCharts(); // init index page's custom scripts
	   	// Index.initChat();
	    // Index.initMiniCharts();
	   	// Tasks.initDashboardWidget();
	   	TableAdvanced.init();
	   	// TableAjax.init();
	   	FormSamples.init();
	   	FormiCheck.init(); // init page demo
	   	ComponentsEditors.init();
   		FormValidation.init();
	});
	</script>

</body>
<!-- END BODY -->
</html>
<!DOCTYPE html>
<html>
	<head>
		<? include "_include.php"; ?>
		<script language="javascript" type="text/javascript">

			$(function(){
				$("#passwordForm").validate({
					rules: {
						'ori_usr_pwd': {
							required: true,
							remote : {
								type:"post",
								async:true,
								url:"Admin!checkOriPassWord"
							}
						},
						'usr_pwd': {
							required: true,
						},
						're_usr_pwd': {
							equalTo:'#usr_pwd'
						}
					},
					messages: {
						'ori_usr_pwd': {
							remote : "<?=$tpwdtips[$lan]?>"
						},'re_usr_pwd': {
							equalTo : "<?=$tdiffpwdtips[$lan]?>"
						}
					}
					,
					submitHandler:function(form) {
						$.post("Admin!changePassWord",$('#passwordForm').formSerialize(),
						function(data) {
							if(data=="true"){
								alert("<?=$tsuccess[$lan]?>");
								window.location.reload();
							}else{
								alert(data);
							}
						},"html"
						);
					}

				});

			});//function end
			</script>
		</head>
		<body>
			<div id="wrapper">

				<? require_once('_navigation.php'); ?>

				<div id="page-wrapper">

					<div class="container-fluid">

						<!-- Page Heading -->
						<div class="row">
							<div class="col-lg-12">
								<h1 class="page-header"><?=$tpassword[$lan]?></h1>
								<ol class="breadcrumb">
									<li>
										<i class="fa fa-dashboard"></i>  <a href="Admin!dashboard">Dashboard</a>
									</li>
									<li class="active">
										<i class="fa fa-lock"></i> <?=$tpassword[$lan]?>
									</li>
								</ol>
							</div>
						</div>
						<!-- /.row -->

						<div class="row">
							<div class="col-lg-4">
								<form id="passwordForm" name="passwordForm">
									
									<div class="form-group">
										<input class="form-control" type="password" placeholder="<?=$tpwdori[$lan]?>" name="ori_usr_pwd"/>
									</div>
									
									<div class="form-group">
										<input class="form-control" type="password" placeholder="<?=$tpwdnew[$lan]?>" name="usr_pwd" id="usr_pwd"/>
									</div>
									
									<div class="form-group">
										<input class="form-control" type="password" placeholder="<?=$tconfirmpwd[$lan]?>" name="re_usr_pwd"/>
									</div>
									<button type="submit" onclick="saveParas()" class="btn btn-success"><?=$tok[$lan]?></button>
								</form>
							</div>
						</div>
						<!-- /.row -->

						

					</div>
					<!-- /.container-fluid -->

				</div>
				<!-- /#page-wrapper -->

			</div>
			<!-- /#wrapper -->

			<!-- jQuery -->

		</body>
	</html>

<div class="content-wrapper" ng-controller="payoutCtrl">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo isset($title) ? '' . $title : null; ?>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('manage') ?>"><i class="fa fa-th"></i> Home</a></li>
			<li class="active"><?php echo isset($title) ? '' . $title : null; ?></li>
		</ol>
	</section>
	<section class="content">
		<div class="row">	
			<div class="col-md-4"> 
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Informasi Tagihan</h3>
					</div><!-- /.box-header -->
					<div class="box-body table-responsive">
						<table class="table table-striped">
							<tbody><tr>
								<td>Jenis</td>
								<td>:</td>
								<td><?php echo $payment['payment_name'] ?></td>
							</tr>
							<tr>
								<td>Tahun Ajaran</td>
								<td>:</td>
								<td><?php echo $payment['period_year'] ?></td>
							</tr>
							<tr>
								<td>NIS</td>
								<td>:</td>
								<td><?php echo $student['student_nis'] ?></td>
							</tr>
							<tr>
								<td>Nama Siswa</td>
								<td>:</td>
								<td><?php echo $student['student_full_name'] ?></td>
							</tr>
							<tr>
								<td>Nama Ibu Kandung</td>
								<td>:</td>
								<td><?php echo $student['student_name_of_mother'] ?></td>
							</tr>
							<tr>
								<td>Kelas</td>
								<td>:</td>
								<td><?php echo $student['class_name'] ?></td>
							</tr>
							<?php if(majors() == 'senior') { ?>
							<tr>
								<td>Program Keahlian</td>
								<td>:</td>
								<td><?php echo $student['majors_name'] ?></td>
							</tr>
							<?php } ?>
							<tr class="warning">
								<td>Total Tagihan</td><td>:</td>
								<td><b><?php echo 'Rp. ' . number_format($total-$pay, 0, ',', '.') ?> </b></td>
							</tr>
						</tbody></table>
					</div>
					<div class="box-footer">
						<a href="<?php echo site_url('manage/payout?'.'n='.$payment['period_period_id'].'&'.'r='.$student['student_nis']) ?>" class="btn btn-primary pull-right">Kembali</a>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="box box-warning">
					<div class="box-header with-border">
						<form action="<?php echo site_url('manage/payout/multiple'); ?>" method="post">
							<h3 class="box-title">Pembayaran Tagihan Bulanan</h3>

							<input type="hidden" name="action" value="printAll">
							<button type="submit" class="btn btn-success btn-xs pull-right" formtarget="_blank"><span class="fa fa-print"></span> Cetak yang dipilih</button>
						</div><!-- /.box-header -->
						<div class="box-body table-responsive">
							<table class="table table-striped table-hover">
								<thead>
									<tr>
										<th><input type="checkbox" id="selectall" value="checkbox" name="checkbox"></th> 
										<th>No.</th> 
										<th>Nama Bulan</th>
										<th>Tagihan</th>
										<th>Status</th>
										<th>Bayar</th>
										<th>Cetak</th>
									</tr>
								</thead>
								<tbody>
									<tr ng-repeat="item in payouts" ng-style="item.bulan_status == 1 ? {'color' : '#00E640'} : {'color' : 'red'}">	
										<td><input type="checkbox" ng-class="item.bulan_status == 1 ? 'checkbox': ''" ng-disabled="item.bulan_status == 0" name="msg[]" ng-value="item.bulan_id"></td>							
										<td>{{$index+1}}</td>
										<td>{{item.month_name}}</td>
										<td>Rp. {{item.bulan_bill | number}}</td>
										<td>{{item.bulan_status == 1? 'Lunas' : 'Belum Lunas'}}</td>
										<td width="80" style="text-align:center">							
											<a ng-show="item.bulan_status == 1" class="btn btn-success btn-xs" title="Hapus Pembayaran" confirmed-click="notPay(item.bulan_id)" ng-confirm-click="Anda Akan Menghapus Pembayaran {{item.month_name}} ?"><span class="fa fa-close"></span></a>
											<a ng-show="item.bulan_status != 1" class="btn btn-danger btn-xs" title="Pembayaran" confirmed-click="pay(item.bulan_id)" ng-confirm-click="Anda Akan Melakukan Pembayaran Bulan {{item.month_name}} ?"><span class="fa fa-check"></span></a>
										</td>
										<td>
											<a class="btn btn-success btn-xs" ng-class="item.bulan_status == 0 ? 'disabled': 'view-pdf'" target="_blank" title="Cetak Slip" href="<?php echo site_url('manage/payout/printPay/') ?>{{item.payment_payment_id}}/{{item.student_student_id}}/{{item.bulan_id}}"><span class="fa fa-print"></span> Cetak</a>
										</td>
									</tr>
								</tbody>
							</table>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div>
			</div>
		</form>	
	</section>
</div>
<script type="text/javascript">
	(function(a){
		a.createModal=function(b){
			defaults={
				title:"",message:"Your Message Goes Here!",closeButton:true,scrollable:false
			};
			var b=a.extend({},defaults,b);
			var c=(b.scrollable===true)?'style="max-height: 420px;overflow-y: auto;"':"";
			html='<div class="modal fade" id="myModal">';
			html+='<div class="modal-dialog">';
			html+='<div class="modal-content">';
			html+='<div class="modal-header">';
			html+='<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>';
			if(b.title.length>0){
				html+='<h4 class="modal-title">'+b.title+"</h4>"
			}
			html+="</div>";
			html+='<div class="modal-body" '+c+">";
			html+=b.message;
			html+="</div>";
			html+='<div class="modal-footer">';
			if(b.closeButton===true){
				html+='<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>'
			}
			html+="</div>";
			html+="</div>";
			html+="</div>";
			html+="</div>";a("body").prepend(html);a("#myModal").modal().on("hidden.bs.modal",function(){
				a(this).remove()})}})(jQuery);

/*
* Here is how you use it
*/
$(function(){    
	$('.view-pdf').on('click',function(){
		var pdf_link = $(this).attr('href');      
		var iframe = '<object type="application/pdf" data="'+pdf_link+'" width="100%" height="350">No Support</object>'
		$.createModal({
			title:'Cetak Tagihan Bulanan',
			message: iframe,
			closeButton:true,
			scrollable:false
		});
		return false;        
	});    
})
</script>


<script>
	var App = angular.module("App", []);
	var SITEURL = "<?php echo site_url() ?>";
	var payment_id = <?php echo $payment['payment_id'] ?>;
	var student_id = <?php echo $student['student_id'] ?>;

	App.controller('payoutCtrl', function($scope, $http) {
		$scope.payouts = [];

		$scope.getPayout = function() {

			var url = SITEURL + 'api/get_payout_bulan/'+payment_id+'/'+student_id;
			$http.get(url).then(function(response) {
				$scope.payouts = response.data;
			});

		};

		$scope.pay = function(bulan_id) {
			$.ajax({
				method: "Get",
				url: SITEURL + "manage/payout/pay/"+payment_id+'/'+student_id+'/'+bulan_id,
				success: function(data) {
					$scope.getPayout();
				}
			});
		};

		$scope.notPay = function(bulan_id) {
			$.ajax({
				method: "Get",
				url: SITEURL + "manage/payout/not_pay/"+payment_id+'/'+student_id+'/'+bulan_id,
				success: function(data) {
					$scope.getPayout();
				}
			});
		};

		angular.element(document).ready(function() {
			$scope.getPayout();
		});

	});


	App.directive('ngConfirmClick', [
		function(){
			return {
				link: function (scope, element, attr) {
					var msg = attr.ngConfirmClick || "Are you sure?";
					var clickAction = attr.confirmedClick;
					element.bind('click',function (event) {
						if ( window.confirm(msg) ) {
							scope.$eval(clickAction)
						}
					});
				}
			};
		}])
	</script>

<script>
	$(document).ready(function() {
		$("#selectall").change(function() {
			$(".checkbox").prop('checked', $(this).prop("checked"));
		});
	});
</script>
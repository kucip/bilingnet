<x-templete_top :data="$data" />
<div class="row">
	<div class="col-md-12">

		<!-- Basic layout-->
		<div class="card">
			<div class="card-header header-elements-inline">
				<h5 class="card-title">Selamat datang ! {{$namelong}}</h5>
				<div class="header-elements">
					<div class="list-icons">
						<a class="list-icons-item" data-action="collapse"></a>
						<!-- <a class="list-icons-item" data-action="reload"></a> -->
						<!-- <a class="list-icons-item" data-action="remove"></a> -->
					</div>
				</div>
			</div>

			<div class="card-body">
				<img src="{{url('/')}}/assets/images/dash1.jpg" class="img-responsive" style="max-height: 420px;">				
			</div>
		</div>
		<!-- /basic layout -->
	</div>
</div>
<x-templete_bottom />
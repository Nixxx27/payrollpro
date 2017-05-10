<form class="form-horizontal">
	<div class="tabbable">
		<ul class="nav nav-tabs padding-16">
			<li class="active">
				<a data-toggle="tab" href="#edit-basic">
					<i class="green ace-icon fa fa-pencil-square-o bigger-125"></i>
						<span  style="font-family:'century gothic';font-weight:bold">EMPLOYEE RECORDS</span>
				</a>
			</li>

			<li>
				<a data-toggle="tab" href="#edit-settings">
				<i class="purple ace-icon fa fa-cog bigger-125"></i>
					<span  style="font-family:'century gothic';font-weight:bold">PERSONAL DATA</span>
					</a>
			</li>

			<li>
				<a data-toggle="tab" href="#edit-password">
					<i class="blue ace-icon fa fa-key bigger-125"></i>
				<span  style="font-family:'century gothic';font-weight:bold">PAYROLL INFORMATION</span>
				</a>
			</li>
		</ul>

		<div class="tab-content profile-edit-tab-content">
			<div id="edit-basic" class="tab-pane in active">
				@include('pages.employees.employee-record')
			</div>
		
		<div id="edit-settings" class="tab-pane">
			<div class="space-10"></div>
			@include('pages.employees.personal-data')
		</div>

		<div id="edit-password" class="tab-pane">
			<div class="space-10"></div>
			@include('pages.employees.payroll-info')
		</div>

												
											</form>
										</div><!-- /.span -->
									</div><!-- /.user-profile -->
								</div>
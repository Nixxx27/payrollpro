@extends('layouts.template')

@section('page_added_css')
		<!-- page specific plugin styles -->
@endsection

@section('css')

@endsection

@section('content')
		<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>

							<li class="active">Employee</li>
						</ul><!-- /.breadcrumb -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->
					</div>

	<div class="page-content">
	 <div class="row">
      <div class="col-md-12">
	     @include('pages.overtime.table')
      </div>
     </div>
  </div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
		@include('layouts.footer')
@endsection

@section('page_added_js')
	<!-- page specific plugin scripts -->
	
@endsection

@section('inline_js')
	

@endsection



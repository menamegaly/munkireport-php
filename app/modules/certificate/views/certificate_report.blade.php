@extends('layouts.app')

@push('scripts')
	<script src="{{ $subdirectory }}assets/js/clients/client_list.js"></script>
	<script src="{{ $subdirectory }}assets/js/munkireport.autoupdate.js"></script>
@endpush

@section('content')
<div class="container">

  <div class="row">

	  <?php $widget->render('certificate'); ?>
	  <?php $widget->render('certificate_group'); ?>

  </div> <!-- /row -->

</div>  <!-- /container -->
@endsection
@extends('layout.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
					<!-- The fileinput-button span is used to style the file input field as button -->
				    <span class="btn btn-success fileinput-button">
				        <i class="glyphicon glyphicon-plus"></i>
				        <span>Selecionar arquivos...</span>
				        <!-- The file input field used as target for the file upload widget -->
				        <input id="fileupload" type="file" name="documento"
				        data-token="{!! csrf_token() !!}"
                        >
				    </span>
				    <br>
				    <br>
				    <!-- The global progress bar -->
				    <div id="progress" class="progress">
				        <div class="progress-bar progress-bar-success"></div>
				    </div>

				    @if(Session::has('success'))
						<div class="alert alert-success">
							{!! Session::get('success') !!}
						</div>
				    @endif

				    <div class="alert alert-success hide" id="upload-success">
						Upload realizado com sucesso!
					</div>

				    <table class="table table-bordered table-striped table-hover">
				    	<thead>
				    		<tr>
				    			<th>Nome</th>
				    			<th>Enviado em</th>
				    			<th>Usuário</th>
				    			<th>Ações</th>
				    		</tr>
				    	</thead>
				    	<tbody>
				    	</tbody>
				    </table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('script')
    <script src="{{url('/portal/jquery-file-upload/js/vendor/jquery.ui.widget.js')}}"></script>
    <script src="{{url('/portal/jquery-file-upload/js/jquery.fileupload.js')}}"></script>
    <script>
	;(function($)
	{
	  'use strict';
	  $(document).ready(function()
	  {
	  	var $fileupload     = $('#fileupload'),
	  		$upload_success = $('#upload-success');

	    $fileupload.fileupload({
	        url: '/upload',
	        formData: {_token: $fileupload.data('token'), userId: $fileupload.data('userId')},
	        progressall: function (e, data) {
	            var progress = parseInt(data.loaded / data.total * 100, 10);
	            $('#progress .progress-bar').css(
	                'width',
	                progress + '%'
	            );
	        },
	        done: function (e, data) {
	        	$upload_success.removeClass('hide').hide().slideDown('fast');

			    setTimeout(function(){
			    	location.reload();
			    }, 2000);
			}
	    });
	  });
	})(window.jQuery);

    </script>
@endpush
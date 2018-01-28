@extends('layouts.default')

@section('content')
	

        <div class="content">




            <h2 class="content-subhead">Upload File</h2>

           @if(session()->has('pesan_import'))

				<p><b>{{session('pesan_import')}}</b></p>
			
			@endif
            

            <div class="pure-g">




                <form class="pure-form" action="{{route('admin.upload_file.import')}}" method="post" enctype="multipart/form-data">

                	{{ csrf_field() }}

                	<input type="file" name="import_file">

                	<button type="submit" class="pure-button pure-button-primary">Upload</button>

                </form>
            </div>

          
        </div>

@push('scripts')
	<script type="text/javascript">
		$(document).ready(function  () {
			// body...

		});
	</script>
@endpush
@stop
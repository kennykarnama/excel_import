@extends('layouts.default')

@section('content')
	

        <div class="content">




            <h2 class="content-subhead">Upload File</h2>

           @if(session()->has('pesan_import'))

           <div class="pure-alert pure-alert-warning" id="notif-import">
                <p id="pesan">{{session('pesan_import')}}</p>
           </div>

			
			
			@endif
           
           <div class="pure-alert pure-alert-success" id="notif-sukses" style="display:none;">
                <p id="pesan-sukses">Import selesai!!!</p>
           </div>

           <div class="pure-alert pure-alert-info" id="notif-info" style="display:none;">
                <p id="pesan-info">Jumlah data skrng: 0</p>
           </div> 

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
    var interval = 1000;  // 1000 = 1 second, 3000 = 3 seconds

function doAjax() {

    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });


    $.ajax({
            type: 'POST',
            url: '{{route("admin.upload_file.status")}}',
            data: {},
            dataType: 'json',
            success: function (data) {

                var test = "{{session('pesan_import')}}";

                

                   if(data.jumlah_queue == 0 && test.length > 0){
                        
                        $('#notif-sukses').show();

                        $('#notif-import').hide();

                        $('#notif-info').hide();
                   }

                   else if(test.length > 0){
                    $('#notif-sukses').hide();

                    $('#notif-import').hide();

                    $('#notif-info').show();

                    $('#pesan-info').text('Jumlah data skrng: '+data.jumlah_data_skrng);
                   }

                   else{
                    console.log(test);
                   }


            },
            complete: function (data) {
                    // Schedule the next
                    setTimeout(doAjax, interval);
            }
    });
}
		$(document).ready(function  () {
			// body...
            doAjax();
		});
	</script>
@endpush
@stop
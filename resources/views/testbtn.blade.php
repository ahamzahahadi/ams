<!-- Bootstrap core CSS -->
<link href="{{ URL::asset('css/bootstrap.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
<!--external css-->
<link href="{{ URL::asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link href="{{ URL::asset('css/sweetalert.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('js/sweetalert.min.js') }}"></script>
<script src="{{ URL::asset('js/swag.js') }}"></script>
@include('Alerts::sweetalerts')

<div class="row">
  <form id="deleteform">
  <input class="col-md-12" type="text" value="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus vel illum recusandae facere expedita quaerat repudiandae enim tempora, sit, unde officia. Nihil sit asperiores temporibus fugiat minus, voluptate reiciendis facere?" />
</form>
</div>

<button id="delete">
  <i class="fa fa-trash-o"></i>
  Delete
</button>

<script>
$('button#delete').on('click', function(){
  swal({
    title: "Are you sure?",
     text: "You will not be able to recover this imaginary file!",
     type: "warning",
     showCancelButton: true,
     confirmButtonColor: "#DD6B55",
     confirmButtonText: "Yes, delete it!",
     cancelButtonText: "No, cancel plx!",
     closeOnConfirm: false,
     closeOnCancel: false
  },
       function(isConfirm){
         if (isConfirm) {
           swal("Deleted!", "Your imaginary file has been deleted.", "success");
           delay(500);
           $("#deleteform").submit();

         } else {
             swal("Cancelled", "Your imaginary file is safe :)", "error");
         }
  });
})
</script>

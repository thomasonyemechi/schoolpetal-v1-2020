{{-- checking for success message --}}
@if(session('success'))
  <div class="alert alert-success alert-dismissible" style="position:fixed; top:10px; right:10px; z-index:100000; background-color: green; border-color: white;">
     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
     <i class="icon fa fa-check"></i>  &nbsp;&nbsp;<b>{{session('success')}}</b>&nbsp;&nbsp;&nbsp;&nbsp;
   </div>
@endif
{{-- checking for negative report --}}
@if(session('error'))
  <div class="alert alert-danger alert-dismissible" style="position:fixed; top:10px; right:10px; z-index:100000; background-color: red; border-color: white;">
   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
   <i class="icon fa fa-ban"></i>   &nbsp;&nbsp;<b>{{session('error')}}</b>&nbsp;&nbsp;&nbsp;
  </div>
@endif

{{-- // if(isset($report)){
//   if($count = 1){
//       echo'<div class="alert alert-danger alert-dismissible" style="position:fixed; top:10px; right:10px; z-index:100000; background-color: red; border-color: white;">
//         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
//         <i class="icon fa fa-ban"></i>   &nbsp;&nbsp;<b>'.$report.'</b>&nbsp;&nbsp;&nbsp;
//       </div>';
//     }else{
//       echo'<div class="alert alert-success alert-dismissible" style="position:fixed; top:10px; right:10px; z-index:100000; background-color: green; border-color: white;">
//           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
//           <i class="icon fa fa-check"></i>  &nbsp;&nbsp;<b>'.$report56.'</b>&nbsp;&nbsp;&nbsp;&nbsp;
//       </div>';
//     }
//   } --}}

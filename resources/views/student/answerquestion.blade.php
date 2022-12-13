@extends('layouts.sapp')
@section('content')
<?php $sta = new App\Http\Controllers\Profilecontroller;  ?>
    {{-- {{ Auth::guard('std')->id}} --}}

  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">ANSWER {{strtoupper($sta->esn(session()->get('esn')))}}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Active</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-12">
            <!-- MAP & BOX PANE -->
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body ">
                <div class="d-md-flex">
                    <form action="/saveanswer" method="POST">@csrf
                    <div class="row">
                        <div class=" col-12">

                            <div class="sticky-top">
                                <div class="card">
                                  <div class="card-body">
                                    <div class="text-center">Time Remaining: <span id="timmer"></span></div>
                                  </div>
                                </div>
                            </div> 
                        </div>
                        
                            <?php  $i=1;
                            $a=1; $b = 0;
                            $name='custom'.$b;foreach ($question as $row) { $e=$i++; $b=$a++;  //$col = ($row->status==1)?'success':'warning'; ?>
                            <div class="col-md-6">

                                <div class="card">
                                    <div class="card-header" >
                                        <input type="hidden" name="qn{{$e}}" value="{{$row->qn}}">
                                        <h6 class="card-title"><span style="float: left" class="pb-2"><?php  echo $e;?>.  </span>  <?php  echo trim($row['question']);?></h6>
                                    </div>
                                    
                                
                                    <div class="card-body"> 
                                        <label style="width: 100%; font-weight: normal;" ><span style="float: left"> 
                                        <input type="radio" value="A" name="custom<?php echo $b; ?>" style="margin: 8px 6px 6px 0"></span>  
                                        <?php  echo ($row['a']);?></label>
                                    
                                        
                                        <label style="width: 100%; font-weight: normal;" >
                                            <span style="float: left"> <input type="radio" name="custom<?php echo $b; ?>"  value="B"  style="margin: 8px 6px 6px 0"></span>
                                        <?php  echo ucfirst($row['b']);?></label>
                                    
                                        
                                        <label style="width: 100%; font-weight: normal;"  >
                                            <span style="float: left"> <input type="radio"   value="C" name="custom<?php echo $b; ?>"  style="margin: 8px 6px 6px 0"></span>
                                        <?php  echo ucfirst($row['c']);?></label>
                                    
                                        <label style="width: 100%; font-weight: normal;"  ><span style="float: left"> <input type="radio"  value="D"  name="custom<?php echo $b; ?>"  style="margin: 8px 6px 6px 0"></span>
                                        <?php  echo ucfirst($row['d']);?></label>
                    
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                          <div class="col-md-12">
                            <a href="#" class="btn btn-primary ml-2" data-toggle="modal" data-target="#modal-default" >Submit Exam</a>
                          </div>
                        


                        <div class="modal fade" id="modal-default">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title">Submit Exam</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">

                                    <center>
                                        <h5 class="text-center text-bold">Do you really want to Submit?</h5>
                                        <button id="exam" class="btn btn-success  mt-5 waves-effect waves-light ">Submit Exam</button>
                                    </center>
                                </div>
                              </div>
                            </div>
                          </div>


                        
                    </div>
                </form>
                  </div><!-- /.card-pane-right -->
                </div><!-- /.d-md-flex -->
              </div>
              <!-- /.card-body -->
            </div>

          </div>
          <!-- /.col -->

        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->

     <!-- jQuery -->
     <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <?php 

    $time = 1750;
    $ctime =  1606119678+(60*$time);
    $t = $ctime-time(); 

?>
    <script type="text/javascript">
       // TODO:: set the reoalding commands
        
            window.onbeforeunload = function (e){
                //e.preventDefault();
                e = e || window.event;
                if(e){
                    e.returnValue = 're';
                }
                return 'no';
            };
            $(document).ready(function(){
               // event.preventDefault();
                $(".answer_wrapper").on('change', '.answer', function () {
                    let fieldName = $(this).attr('name');
                    let no = $(this).attr('count');
                    let btn = document.getElementById('btn'+no);
                    if($('input[name='+fieldName+']:checked').val() !== 0){
                        //set the class value of the btn
                        btn.className ='';
                        btn.className = 'btn btn-success';
                    }
                    else{
                        btn.className ='btn btn-danger';
                    }
                })
        
            });
        
            function startTimer(duration, display) {
                let timer = duration, minutes, seconds;
                setInterval(function () {
                    minutes = parseInt(timer / 60, 10)
                    seconds = parseInt(timer % 60, 10);
        
                    minutes = minutes < 10 ? "0" + minutes : minutes;
                    seconds = seconds < 10 ? "0" + seconds : seconds;
        
                    display.textContent = minutes +' mins' + " : " + seconds + ' sec';
        
                   time = --timer;
                   if(time == 300){
                      alert("You Have Five Minutes Left");
                    // document.getElementById('exam').submit();
                   }
                   if(time == 290){
                    $('#exam').click();
                   }
                }, 1000);
            }
        
            let examTime ='<?php echo $t ?>', display = document.querySelector('#timmer');
            //let examTime = 3000 , display = document.querySelector('#timmer');
            startTimer(examTime, display);
        
        
    </script>

{{-- <script>
    $(function () {
      //Enable check and uncheck all functionality
      $('.checkbox-toggle').click(function () {
        var clicks = $(this).data('clicks')
        if (clicks) {
          //Uncheck all checkboxes
          $('.mailbox-messages input[type=\'checkbox\']').prop('checked', false)
          $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
        } else {
          //Check all checkboxes
          $('.mailbox-messages input[type=\'checkbox\']').prop('checked', true)
          $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
        }
        $(this).data('clicks', !clicks)
      })
  
      //Handle starring for glyphicon and font awesome
      $('.mailbox-star').click(function (e) {
        e.preventDefault()
        //detect type
        var $this = $(this).find('a > i')
        var glyph = $this.hasClass('glyphicon')
        var fa    = $this.hasClass('fa')
  
        //Switch states
        if (glyph) {
          $this.toggleClass('glyphicon-star')
          $this.toggleClass('glyphicon-star-empty')
        }
  
        if (fa) {
          $this.toggleClass('fa-star')
          $this.toggleClass('fa-star-o')
        }
      })
    })
</script> --}}





@endsection
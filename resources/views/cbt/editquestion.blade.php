@extends('layouts.app')

@section('content')
<?php $sta = new App\Http\Controllers\Profilecontroller; $esn = session()->get('esn'); ?>
  <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Enter Questions for <small class="text-sm">{{strtoupper($sta->esn($esn))}}</small> </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        {{-- <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">AddNew Student</li>
        </ol> --}}
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active" ><e style="font-size:16px"><?php echo strtoupper(date('D, d M. Y')) ?> | </e><e id="updatetime" style="font-size:18px"></e></li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
  <div class="container-fluid">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->

      <div class="card card-primary">
        @foreach ($ques as $row)
      <form action="{{ route('updatequestion', $row->sn)}}" method="post" role="form">
        
        @csrf
        <div class="card-body">
          <x-jet-validation-errors class="mb-4" />
            <div class="row">
                
                <div class="col-md-12">
                    <p><b>NOTE: </b>
                        To insert Image, Click on "</>" and Copy and paste this code &lt;img src="bussiness/cbt/imagename.format" width="200"/&gt; 
                        <b>Example</b> &lt;img src="bussiness/cbt/picture1.png" width="200" /&gt; </p>
                    <textarea name="question" class="textarea form-control" >{{$row->question}}</textarea>
                </div>
                <div class="col-md-3">
                    <label>Option A</label>
                    <textarea name="a" class="textarea form-control" >{{$row->a}}</textarea>
                </div>
                <div class="col-md-3">
                    <label>Option B</label>
                    <textarea name="b" class="textarea form-control" >{{$row->b}}</textarea>
                </div>
                <div class="col-md-3">
                    <label>Option C</label>
                    <textarea name="c" class="textarea form-control" >{{$row->c}}</textarea>
                </div>
                <div class="col-md-3">
                    <label>Option D</label>
                    <textarea name="d" class="textarea form-control" >{{$row->d}}</textarea>
                </div>
                <div class="col-md-3">
                    <label>Correct Option</label>
                    <input name="ca" value="{{$row->ca}}" class="form-control" name="ca" placeholder="example A, B ...">
                </div>
                <div class="col-md-12">
                  <button class="btn btn-primary mt-2">Save</button>
              </div>
              
            </div>
            
        </div>
      </form>
      @endforeach
    </div>


    <div class="card card-secondary">
        <div class="card-header">
            <h3>{{strtoupper($sta->esn($esn))}} Questions</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Question</th>
                            <th>A</th>
                            <th>B</th>
                            <th>C</th>
                            <th>D</th>
                            <th>Correct Answer</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0; foreach ($question as $row) { $i++; ?>
                          <tr>
                            <td>{{$i}}</td>
                            <td><?php echo $row->question ?></td>
                            <td><?php echo $row->a ?></td>
                            <td><?php echo $row->b ?></td>
                            <td><?php echo $row->c ?></td>
                            <td><?php echo $row->d ?></td>
                            <td>{{strtoupper($row->ca)}}</td>
                            <td><a href="/editquestion/{{$row->sn}}"><button class="btn btn-info">Edit</button></a></td>
                          </tr>
                        <?php } ?>
                        {{$question->links()}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    </div>
    </div>
    <!--/.col (left) -->
    <!-- right column -->
    </div>
    
    <!--/.col (right) -->
  </div>
  <!-- /.row -->
</section>

<!-- /.content -->
@endsection

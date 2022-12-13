@extends('layouts.app')

@section('content')
  <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Gurdian/Paernt Management</h1>
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
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Add Gurdian/Parent</h3>
        </div>
        <div class="card-body">
          {{-- <form action="/doparent" method="POST">@csrf
            <button class="btn btn-danger">doparent</button>
          </form>

          <form action="/shuffle" method="POST">@csrf
            <button class="btn btn-danger">shuffle me Parent</button>
          </form> --}}
          <form action="/RegisterParent" method="post">
            <x-jet-validation-errors class="mb-4" />
            @csrf
            <br>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <strong>Mother Information</strong>
                </div>
                <div class="col-xs-6 col-sm-6 col-6" style="padding-bottom:10px" >Mother`s Name
                    <x-jet-input class="block mt-1 w-full" placeholder="" type="text" name="mname" :value="old('mname')" autofocus autocomplete="mname" />
                  </div>
                  <div class="col-xs-6 col-sm-6 col-6" style="padding-bottom:10px" >Mother`s Phone Number
                    <x-jet-input class="block mt-1 w-full" placeholder="" type="text" name="phone2" :value="old('phone2')" autofocus autocomplete="phone2" />
                  </div>
     
                  <div class="col-xs-6 col-sm-6 col-6" style="padding-bottom:10px" >Mother`s E-mail
                    <x-jet-input class="block mt-1 w-full" placeholder="" type="text" name="MotherEmail" :value="old('MotherEmail')" autofocus autocomplete="MotherEmail" />
                  </div>
                  <div class="col-xs-6 col-sm-6 col-6" style="padding-bottom:10px" >Mother`s Occupation
                    <x-jet-input class="block mt-1 w-full" placeholder="" type="text" name="occupation2" :value="old('occupation2')" autofocus autocomplete="occupation2" />
                  </div>
                  <div class="col-xs-12 col-sm-12 col-12" style="padding-bottom:10px" >Mother`s Office Address
                    <x-jet-input class="block mt-1 w-full" placeholder="" type="text" name="officeadd2" :value="old('officeadd2')" autofocus autocomplete="officeadd2" />
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <strong>Father Information</strong>
                </div>
                    <div class="col-xs-6 col-sm-6 col-6" style="padding-bottom:10px" >Father`s Name
                        <x-jet-input class="block mt-1 w-full" placeholder="" type="text" name="pname" :value="old('pname')" autofocus autocomplete="pname" />
                    </div>
                    <div class="col-xs-6 col-sm-6 col-6" style="padding-bottom:10px" >Father`s Phone Number
                        <x-jet-input class="block mt-1 w-full" placeholder="" type="text" name="phone" :value="old('phone')" autofocus autocomplete="phone" />
                    </div>
                    <div class="col-xs-6 col-sm-6 col-6" style="padding-bottom:10px" >Father`s E-mail
                        <x-jet-input class="block mt-1 w-full" placeholder="" type="text" name="FatherEmail" :value="old('FatherEmail')" autofocus autocomplete="FatherEmail" />
                    </div>
                    <div class="col-xs-6 col-sm-6 col-6" style="padding-bottom:10px" >Father`s Occupation
                        <x-jet-input class="block mt-1 w-full" placeholder="" type="text" name="occupation" :value="old('occupation')" autofocus autocomplete="occupation" />
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px" >Father`s Office Address
                        <x-jet-input class="block mt-1 w-full" placeholder="" type="text" name="officeadd" :value="old('officeadd')" autofocus autocomplete="officeadd" />
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                      <strong style="padding-left:15px">OTHERS</strong>
                  </div>

                    <div class="col-xs-6 col-sm-6 col-6" style="padding-bottom:10px" >Parent/Gurdian State Of Orgin
                      <x-jet-input class="block mt-1 w-full" type="text" name="state" :value="old('state')"/>
                  </div>

                  <div class="col-xs-6 col-sm-6 col-6" style="padding-bottom:10px" >Parent/Gurdian L.G.A
                    <x-jet-input class="block mt-1 w-full" type="text" name="lga" :value="old('lga')"/>
                </div>
                
                    <div class="col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px" >Parent/Gurdian Address
                      <x-jet-input class="block mt-1 w-full" type="text" name="address" :value="old('address')"/>
                  </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <strong style="padding-left:15px">LOGIN INFORMATION</strong>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6" style="padding-bottom:10px" >Password
                        <x-jet-input class="block mt-1 w-full" placeholder="" type="password" name="password"/>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6" style="padding-bottom:10px" >Confirm Password
                      <x-jet-input class="block mt-1 w-full" type="password" required placeholder="Confirm Password" name="password_confirmation" title="Please enter the same Password as above"/>
                    </div>

                </div>

               <button style="text-align:center;" type="submit" class="btn btn-primary float-right">Register Parent</button>
           </form>
        </div>
        <!-- /.card-body -->
      </div>

      <div class="card card-secondary">
        <div class="card-header">
          <h3 class="card-title">
             Recently Added
          </h3>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="example5"  class="table table-sm">
              <thead>
                <tr>
                  <th> SN </th>
                  <th> Father`s Name </th>
                  <th> Father`s Email </th>
                  <th> Father`s Phone No</th>
                  <th> Mother`s Name </th>
                  <th> Mother`s Email </th>
                  <th> Mother`s Phone No </th>
                  <th> Check Profile </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($parents as $row)
                <tr>
                  <td>{{$loop->iteration}} </td>
                  <td>{{$row->pname}} </td>
                  <td>{{$row->fatheremail}} </td>
                  <td><?php echo $row->phone ?></td>
                  <td>{{$row->mname}} </td>
                  <td>{{$row->email2}} </td>
                  <td>{{$row->phone2}} </td>
                  <td><button class="btn btn-sm btn-info"><i class="fa fa-pencil-alt"></i></button> </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{$parents->links()}}
          </div>
        </div>
      </div>


    </div>

    <!-- right column -->



    </div>
    <!--/.col (right) -->
  </div>
  <!-- /.row -->
</section>

<!-- /.content -->
@endsection

@extends('layouts.app')

@section('content') <?php $sta = new App\Http\Controllers\ProfileCOntroller;
 $sum = 0; $salesid = session()->get('expense'); ?>
  <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Expenditure</h1>
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
      <div class="col-md-6">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Add Expenditure</h3>
          </div>
          <form action="{{route('addExpenditure')}}" method="post" role="form">
            @csrf
            <div class="card-body">
              <x-jet-validation-errors class="mb-4" />
              <div class="row">
                <div class="col-md-4 form-group">
                  <label>Expense</label>
                  <select name="cat" class="form-control form-group select2bs4" required>
                    <option selected="selected" disabled="disabled" value="">... select expense</option>
                    @foreach ($items as $item)
                      <option value="{{$item->id}}">{{$item->item}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-4 col-6 form-group">
                  <label>Amount</label>
                  <x-jet-input class="block w-full form-control" placeholder="Cost of Expense" type="number" name="amount" :value="old('amount')" required autofocus autocomplete="amount" />
                </div>
                <div class="col-md-4 col-6 form-group">
                  <label>Agent</label>
                  <x-jet-input class="block w-full form-control" placeholder="Representative" type="text" name="agent" :value="old('agent')" required autofocus autocomplete="agent" />
                </div>
                <div class="col-md-6 col-12 form-group">
                  <label>Description</label>
                  <x-jet-input class="block w-full form-control" placeholder="Description of Expenditure" type="text" name="description" :value="old('description')" required autofocus autocomplete="description" />
                </div>
                <div class="col-md-6 form-group mt-1">
                  <br>
                  <button type="submit" class="btn btn-primary btn-block">Add Expenditure</button>
                </div>
            </div>
          </div>
          </form>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Expense Details</h3>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-sm">
                <thead>
                <tr>
                  <th>Item</th>
                  <th>Description</th>
                  <th>Amount</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php $i=0; foreach ($exps as $exp){ $i++; @$sum += $exp->amount; ?>
  
                    <tr>
  
                      <td>{{$iname[$i-1]}}</td>
                      <td>{{$exp->des}}</td>
                      <td>{{$exp->amount}}</td>
  
                      <td>
                        <div class="btn-group btn-group-sm">
                          <form action="{{route('deleteExpenditure')}}" method="post"> @csrf
                            <button name="delete" value="{{$exp->id}}" type="submit" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></button>
                          </form>
                        </div></td>
                    </tr>
                  <?php } ?>
                  <tr>
                    <td colspan="2"><label>Sub-total</label></td>
                    <td colspan="">{{$sum}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Checkout Invoice</h3>
          </div>
          <form action="/expenseCheckout" method="post" role="form">
            @csrf
            <div class="card-body">
              <div class="row">
                <div class="col-md-4 form-group">
                  <label>Supplier</label>
                  <select name="vid" class="form-control form-group select2bs4" required>
                    <option selected="selected" disabled="disabled" value="">... select Supplier</option>
                    @foreach ($supp as $sup)
                      <option value="{{$sup->id}}">{{$sup->name}}<br>{{$sup->phone}}</option>
                    @endforeach
                  </select>
                </div>
                {{-- <label></label> --}}
                <div class="col-md-4 col-6 form-group">
                  <label>Invoice Amount</label>
                  <input type="hidden" name="total" value="{{$sum}} ">
                  <x-jet-input class="block w-full form-control" placeholder="Cost of Expense" type="number" name="cash" required />
                </div>
                <div class="col-md-4 col-6 form-group">
                  <label>Invoice Number</label>
                  <x-jet-input class="block w-full form-control" placeholder="INV" type="text" name="agent" value="{{$salesid}} " disabled autofocus autocomplete="agent" />
                </div>
                <div class="col-md-6 col-6 form-group">
                  <a class="btn btn-secondary float-left">Print Last Invocie</a>
                </div>
                <div class="col-md-6 col-6 form-group">
                  <button class="btn btn-primary float-right">Close Invoice</button>
                </div>
            </div>
          </div>
          </form>
        </div>
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Options</h3>
          </div>
            <div class="card-body">

               <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-recent">Recent<br>Expenses</button>
               <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-summary">Expenses<br>Summary</button>
               <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">Last <br>Expense</button>
               <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default1">Add<br>Supplier</button>
               <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">Add<br>Expense</button>
               <a href="#" class="btn btn-default" onclick="BrWindow('trackexpenses.php','','width=800,height=600')" >Track<br>Invoice </a>

               <br><br>
          </div>
        </div>
      </div>

    </div>

  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->


      <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Expense Type</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{route('addExpenditureType')}}" method="post" role="form">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4 form-group">
                      <label>Expense Category</label>
                      <x-jet-input class="block w-full form-control" type="text" name="ExpenseCategory" :value="old('ExpenseCategory')" required autofocus autocomplete="ExpenseCategory" />
                    </div>
                    <div class="col-md-8 form-group">
                      <label>Description</label>
                      <x-jet-input class="block w-full form-control" type="text" name="ExpenseDescription" :value="old('ExpenseDescription')" required autofocus autocomplete="ExpenseDescription" />
                    </div>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


      <div class="modal fade" id="modal-default1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Supplier</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{route('addSupplier')}}" method="post" role="form">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4 form-group">
                      <label>Name</label>
                      <x-jet-input class="block w-full form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    </div>
                    <div class="col-md-4 form-group">
                      <label>Phone Number</label>
                      <x-jet-input class="block w-full form-control" type="text" name="phone" :value="old('phone')" required autofocus autocomplete="phone" />
                    </div>
                    <div class="col-md-4 form-group">
                      <label>Address</label>
                      <x-jet-input class="block w-full form-control" type="text" name="address" :value="old('address')" required autofocus autocomplete="address" />
                    </div>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

@endsection

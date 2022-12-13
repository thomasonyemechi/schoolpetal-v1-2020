@extends('layouts.app')

@section('content')
@php
    $sta = new App\Http\Controllers\ProfileCOntroller;
    $bid = $sta->bid();
    $token = 82396413;//session()->get('slottoken');
  //  $arr = slotInfo($token,'total')
@endphp

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Invoice</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Invoice</li>
        </ol>
        </div>
    </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
    <div class="row">
        <div class="col-12">
        {{-- <div class="callout callout-info">
            <h5><i class="fas fa-info"></i> Note:</h5>
            This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
        </div> --}}


        <!-- Main content -->
        <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
            <div class="col-12">
                <h4>
                    <strong>{{ucwords($sta->binfo())}}</strong>
                    <small class="float-right">Date: {{date('j/m/Y',slotInfo($token,'ctime'))}}</small><br>
                    {{ucwords($sta->binfo('address'))}}<br>
                    Phone: {{ucwords($sta->binfo('phone'))}}<br>
                    Email: {{ucwords($sta->binfo('email'))}}
                
                </h4>
            </div>
            <!-- /.col -->
            </div>
            <!-- info row -->

            <div class="row">
    
            <!-- /.col -->
            <div class="col-6 mt-2">
                <p class="lead"></p>

                <div class="table-responsive">
                <table class="table">
                    <tr>
                    <th style="width:50%">Subtotal:</th>
                    <td>$250.30</td>
                    </tr>
                    <tr>
                    <th>Tax (9.3%)</th>
                    <td>$10.34</td>
                    </tr>
                    <tr>
                    <th>Discount:</th>
                    <td>$5.80</td>
                    </tr>
                    <tr>
                    <th>Total:</th>
                    <td>$265.24</td>
                    </tr>
                </table>
                </div>
            </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
            <div class="col-12">
                <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> 
                    Debit/Credit Card
                </button>
                <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                Livepetal Wallet
                </button>
            </div>
            </div>
        </div>
        <!-- /.invoice -->
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection

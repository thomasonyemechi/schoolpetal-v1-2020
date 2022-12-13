<?php 
$salesid = '';
if(isset($_GET['transactionIndex'])){
  $salesid = $_GET['transactionIndex'];
}
$sta = new App\Http\Controllers\Profilecontroller;  

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=10.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sales Receipt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
        <!-- Favicons -->
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  
</head>

  <body onLoad="print()" style="margin:0;" >

                   <div style="font:Courier New">
                  
                    <table class="table table-sm" style="font-size:15px;" >
                      <thead><?php $bid = $sta->bid(); 
                      
                      ?>
                        <tr>
                          <td colspan="5" align="center"><?php //$q=$db->query("select * FROM title WHERE bid = '$bid' LIMIT 1 " );
      // $r=mysqli_fetch_array($q); ?> <strong> {{ucwords($sta->binfo())}} </strong><br>
                                             {{ucwords($sta->binfo('address'))}}<br>
                                             {{ucwords($sta->binfo('phone'))}}, {{ucwords($sta->binfo('phone2'))}}<br><br></td>
                        </tr>
                        <tr>
                          <td colspan="5"><div style="float:right"> <strong>
                           Receipt No:
                            <strong><?php  echo $salesid; ?></strong>
                            <br>
                            Customer:
<b>                           {{ucwords($sta->resql($salesid,'name'))}}</b>&nbsp;&nbsp;&nbsp;                            Pay Mode:
<b>                           {{ucwords($sta->resql($salesid,'mode'))}}</b>
                            
                           </td>
                        </tr>
                      <td colspan="4" align="center"><strong>SALES RECEIPT</strong></td>
      <tr style="border-bottom:thin dashed #999; border-top:thin dashed #999;">
                                     
                                        <th width="80">Item</th>
                                        <th width="30">Qty</th>
                                        <th width="40">Price</th>
                                        <th width="50">Amount</th>
                                      </tr>
                      <tbody>
                        <?php 
     $i = 1 ;
              $query=$sta->resql2($salesid);
              foreach($query as $row){
              
             $e = $i++ ;  
              ?>
                        <tr>
                     
                          <td><?php echo ucwords(strtolower($row->item)) ?></td>
                          <td><?php echo $row->qty; ?></td>
                          <td class="center">₦<?php echo number_format($row->price) ?></td>
                          <td class="center">₦<?php echo number_format($row->amount); ?></td>
                        </tr>
                        <?php  } ?>
                        <tr style="border-bottom:thin dashed #999; border-top:thin dashed #999; ">
                         
                          <td colspan="3" >Sub-Total:<br>
                            Charges:<br>
                          
                            Total Amount:</td>
                          <td><b>₦{{number_format($sta->resql($salesid,'amount'))}}
                            <br>
                            ₦0.00<br>
                            ₦{{number_format($sta->resql($salesid,'amount'))}}</b>
                            </td>
                        </tr>
                       
                        <tr>
                          <td colspan="4">                             
                            <div style="float:right"> Served by: <strong><?php echo auth()->user()->name; ?></strong></div></td>
                        </tr>
                      </tbody>
                    </table>
                    
                    </div>
         

   
    
  </body>
</html>
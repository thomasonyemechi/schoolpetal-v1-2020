<?php
session_start(); ob_start();
include('lib.php');
$pro->checkLogin();
//Recharge::verifyAirtime('1256878');
function asset($file){
    return 'assets/img'.$file;
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Livepetal</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="description" content="Finapp HTML Mobile Template">
    <meta name="keywords" content="bootstrap, mobile template, cordova, phonegap, mobile, html, responsive" />
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png" sizes="32x32">
    <link rel="shortcut icon" href="assets/img/favicon.png">
    <style type="text/css">
         .no-line > li {
  border-bottom: solid thin #DCDCE9;
   padding: 400;
}

.bcolor{border-color: #273fb1; color: #273fb1;}
table tr td a {color: black !important;}
    </style>

</head>

<body>

    <!-- loader -->
    <div id="loader">
       <div class="spinner-border text-primary p-4" role="status"></div>
    </div>

<!-- <img src="assets/img/livepetal2.png" id="imgx" style="display:none; z-index: 2000000"/ >
 -->
    <!-- * loader -->

    <!-- App Header -->
    <div style="display: block;" id="mainPage">
    <div class="appHeader bg-primary text-light" >
        <div class="left">
            <a href="#" class="headerButton" data-toggle="modal" data-target="#sidebarPanel">
                <ion-icon name="menu-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle" style="font-family: Trebuchet MS;">
         <b id="pTitle">Livepetal</b> <!--   <img src="assets/img/logo.png" alt="logo" class="logo"> -->
        </div>
        <div class="right">
            <a href="#" onclick="swapPages(2,'Notifications')" class="headerButton">
           <!--  <a href="#" onclick="myNewPage('Notifications')" class="headerButton"> -->
                <ion-icon class="icon" name="notifications-outline"></ion-icon>
                <span class="badge badge-danger"><?php echo sqL2('notice','id',$uid,'status',0) ?></span>
            </a>
           
        </div>
    </div>
    <!-- * App Header -->




    <div id="refe" style="display: none">
    <div id="appCapsule">
        <!-- Send Money -->
    <div class="p-2">
        
        <h3>Refer a friend and earn</h3>
        My Referral Code: <b><?php echo $ref ?> </b>
        <span style="float: right"><small><a href="#" onclick="navigator.share({
  title: document.title,
  text: 'Join Livepetal for an experience of unlimited earnings and opportunities. ',
  url: 'https://livepetal.com/home/s/G'+<?php echo $ref ?>,
})">Share referal code</a></small>
    </span>
    </div>
   <h3 class="p-2"><?php if(isset($_GET['find'])){ $uidx=$_GET['find'];  $idd = sqLx('matuser','sn',$uidx,'id');  echo userName($idd); }else{echo 'My Referrals'; }  ?>
   <?php if(isset($_GET['find'])){ ?><span style="float: right"><a href="javascript:;" class="headerButton goBack">
                Back</a></span><?php } ?></h3> 
        <ul class="listview image-listview">
            <?php
                    $i=1; $ti=0;  
                    $sql = $db->query("SELECT * FROM matuser WHERE b1='$uidx' "); 
                    while($row = mysqli_fetch_assoc($sql)) { $e = $i++;
                       $id = $row['id'];
                    ?>

            <li>
                <a href="?find=<?php echo $row['sn'] ?>" class="item" onclick="showLoader()">
                    <img src="assets/img/s1.jpg" alt="image" class="image">
                    <div class="in">
                        <div><?php echo userName($id) ?></div>

                       <!--  <footer>Paris</footer> -->
                       <?php if($row['sp']>0){ ?>
                        <span class="badge badge-primary"><?php echo $row['sp'] ?></span>
                    <?php } ?>
                    </div>
                </a>
            </li>
        <?php } ?>
           
        </ul>     
</div>  
</div>



    <div id="promo" style="display: none">
    <div id="appCapsule">
        <div class="p-2 pb-0"><h3>Smart Promotions</h3>
            Your first 30 days of join Livepetal is the most important part of the business as it opens up limitless earning opportunity for smart earners 
        </div>
<div class="goals p-2" onclick="proDetail(1)">
                <!-- item -->
                <div class="item" style="border: thin solid grey">
                    <div class="in">
                        <div>
                            <h4>Referral Smart Promo</h4>
                            <p style="line-height: 1.5" class="pr-3">Generate 1,000 RPV within 30 days of joining Livepetal</p>
                        </div>
                        <div class="price"><big>₦250,000</big></div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: <?php $gress = $rpv/10; echo $gress ?>%;" aria-valuenow="85"
                            aria-valuemin="0" aria-valuemax="100"><?php echo number_format($gress,1) ?>%</div>

                    </div>
                </div>
                        
            </div>
<div class="goals p-2 pt-0" onclick="proDetail(2)">
                <!-- item -->
                <div class="item" style="border: thin solid grey">
                    <div class="in">
                        <div>
                            <h4>Sales Smart Promo</h4>
                            <p style="line-height: 1.5" class="pr-3">Generate 1,000 SPV within 30 days of joining Livepetal</p>
                        </div>
                        <div class="price"><big>₦250,000</big></div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: <?php $gress = $spv/10; echo $gress ?>%;" aria-valuenow="85"
                            aria-valuemin="0" aria-valuemax="100"><?php echo number_format($gress,1) ?>%</div>

                    </div>
                </div>
                        
            </div>
<div class="goals p-2 pt-0" onclick="proDetail(3)">
                <!-- item -->
                <div class="item" style="border: thin solid grey">
                    <div class="in">
                        <div>
                            <h4>Smart Leader Promo</h4>
                            <p style="line-height: 1.5" class="pr-3">Raise 100 leaders within 90days of joining Livepetal</p>
                        </div>
                        <div class="price"><big>₦3,000,000</big></div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: <?php $gress = 0; echo $gress ?>%;" aria-valuenow="85"
                            aria-valuemin="0" aria-valuemax="100"><?php echo number_format($gress,1) ?>%</div>

                    </div>
                </div>
                        
            </div>
    </div>
</div>


    <div id="profile" style="display: none">
    <div id="appCapsule">

        <h3 class="p-2">Profile Data</h3>
        <ul class="listview image-listview text inset">
            <li>
                <a href="#" class="item">
                    <div class="in">
                        <div>Name: <?php echo userName($uid); ?></div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#" class="item">
                    <div class="in">
                        <div>Mobile: <?php echo userName($uid,'phone'); ?></div>
                    </div>
                </a>
            </li> <li>
                <a href="#" class="item">
                    <div class="in">
                        <div>Email: <?php echo userName($uid,'email'); ?></div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#" class="item">
                    <div class="in">
                        <div>Address: <?php echo userName($uid,'address'); ?></div>
                        <span class="text-primary">Edit</span>
                    </div>
                </a>
            </li>
            <li>
                <div class="item">
                    <div class="in">
                        <div>
                            Birthday: <?php echo userName($uid,'birthday'); ?>
                        </div>
                       
                    </div>
                </div>
            </li>
        </ul>

        <h3 class="p-2">Security Information</h3>
        <ul class="listview image-listview text mb-2 inset">
            <li>
                <a href="#" class="item">
                    <div class="in">
                        <div>Update Password</div>
                    </div>
                </a>
            </li>

             <li>
                <div class="item">
                    <div class="in">
                        <div>
                            Remember Password
                            <div class="text-muted">
                                Keep me logged in
                            </div>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input"  id="keepLogin" onchange="keepLogin()" <?php if(sqLx('user','id',$uid,'keep')==1){ echo 'checked'; } ?> />
                            <label class="custom-control-label" for="keepLogin"></label>
                        </div>
                    </div>
                </div>
            </li>
           
            <li>
                <div class="item">
                    <div class="in">
                        <div>Log out all devices</div>
                        <div class="custom-control custom-switch">
                         <a href="?logout=true" class="headerButton" onclick="showLoader()">
                <big><ion-icon class="icon" name="power-outline"></ion-icon></big>
              
            </a>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    
</div>


    <!-- App Capsule -->
    <div id="trans" style="display: none">
    <div id="appCapsule">

       <div class="listview-title mt-2 mb-0">
        <table width="100%"><tr><td>
<input type="date" name="trdate" id="trdate" class="form-control"></td><td width="50%">
     <button type="button" class="btn btn-primary btn-block" onclick="moreTransaction()">VIEW BY DATE</button></td></tr>
</table>
       
   </div>
   <div id="dateMoreTr"></div>

   <h3 class="pt-2 pl-2">Recent Transactions</h3>
        <ul class="listview image-listview no-line">

            <?php $i = 1;
            $sql = $db->query("SELECT * FROM ewalletx WHERE id='$uid' ORDER BY sn DESC LIMIT 10 ");
                while ($row = mysqli_fetch_assoc($sql)) {
                       $e = $i++;  
                       $s = '';
                       if($row['type']<=10){ $col='red'; $col2='danger'; $s='-';}else{ $col='green'; $col2='success';}
                       if($row['status']<5){ $col='purple'; $col2='primary';}
                                        ?>
            <li id ="transaction" data-trx="<?php echo $row['trno']; ?>" style="margin-bottom: 4px; margin-left: 5px;  border-left: thick solid <?php echo $col; ?>">
                <span class="item p-1">
                 
                    <div class="in">
                        <div>
                           
                            <?php echo $row['remark']; ?>
                            <footer><?php echo substr($row['created'],0,16); ?> | <?php echo $pro->walletStatus($row['status']); ?></footer>
                        </div>
                         <div class="right">
                        <div class="price text-<?php echo $col2; ?>"><b><?php echo $s; ?>₦<?php echo number_format(abs($row['cos']),2) ?></b></div>
                    </div>
                    </div>
                </span>
            </li>
        <?php } ?>
          
        </ul>
        <div class="clear"></div>
        
    </div>
    </div>

    <!-- App Capsule -->
    <div id="home" style="display: block;">
    <div id="appCapsule">

        <!-- Wallet Card -->
        <div class="section wallet-card-section">
            <div class="wallet-card p-2 pt-0 text-light bg-primary" >
                <!-- Balance -->
                <div class="balance mb-0">
                    <div class="left pb-0">
                        <span class="title text-light">Wallet Balance</span>
                        <h1 class="total pb-0 text-light">₦<?php $rd = $pro->wallet($uid)>1000000?1:2; echo number_format($pro->wallet($uid), $rd); ?></h1>



                    </div>
                    <div class="right" style="line-height: 0.4">
                        <a href="#" class=" text-light" data-toggle="modal" data-target="#depositActionSheet">
                        <center>
              <ion-icon name="card-outline"  style="font-size: 38px;"></ion-icon><br>

                <strong style="font-size: 9px; font-weight: bolder">Add Funds</strong>
           </center>
                        </a>
                    </div>
                </div>
                <!-- * Balance -->
                <!-- Wallet Footer -->
                <div class="wallet-footer pt-2">
                   <div class="item">
                        <a>
                            <h3 class="total text-light" >₦<?php echo number_format($pro->walletPending($uid,21,30)) ?></h3>
                            <strong class=" text-light">Sales Bonus</strong>
                        </a>
                    </div>
                    <div class="item">
                        <a>
                             <h3 class="total text-light">₦<?php echo number_format($pro->getIncentive($uid,3)) ?></h3>
                            <strong class=" text-light">RPV Bonus</strong>
                        </a>
                    </div>
                    <div class="item">
                        <a>
                             <h3 class="total text-light">₦<?php echo number_format($pro->totalEarned($uid)) ?></h3>
                            <strong class=" text-light">Total Earned</strong>
                        </a>
                    </div>

                </div>
                <!-- * Wallet Footer -->
                            <!-- Wallet Footer -->
               
                <!-- * Wallet Footer -->
            </div>
        </div>
        <!-- Wallet Card -->




        <!-- News -->
        <div class="section full mt-2 mb-0">
           
            <div class="shadowfix carousel-single owl-carousel owl-theme">

                <!-- item -->
                <div class="item">
                    <a href="app-blog-post.html">
                        <div class="blog-card">
                            <img src="assets/img/slider2.jpg" alt="image" class="imaged w-100">
                           
                        </div>
                    </a>
                </div>
                <!-- * item -->

                <!-- item -->
                <div class="item">
                    <a href="app-blog-post.html">
                        <div class="blog-card">
                            <img src="assets/img/slider2.jpg" alt="image" class="imaged w-100">
                            
                        </div>
                    </a>
                </div>
                <!-- * item -->

                <!-- item -->
                <div class="item">
                    <a href="app-blog-post.html">
                        <div class="blog-card">
                            <img src="assets/img/slider2.jpg" alt="image" class="imaged w-100">
                            
                        </div>
                    </a>
                </div>
                <!-- * item -->

                <!-- item -->
                <div class="item">
                    <a href="app-blog-post.html">
                        <div class="blog-card">
                            <img src="assets/img/slider2.jpg" alt="image" class="imaged w-100">
                            
                        </div>
                    </a>
                </div>
                <!-- * item -->

            </div>
        </div>
        <!-- * News -->

        <div class="section pt-2">
        <!-- Wallet Card -->
        <h4>Quick Links</h4>
        <?php //echo $_SESSION['report'] ?>
<table width="100%" cellpadding="10"><tr style="font-size: 14px;line-height: 2; font-family: Trebuchet MS !important;"><td><a href="#" data-toggle="modal" data-target="#BuyAirtime">
                                 <center>
              <img src="assets/icons/airtime.png" height="24"></ion-icon><br>

                Airtime
           </center>
                        </a>
                    </td><td>
                        <a href="#" data-toggle="modal" data-target="#BuyData">
                             <center>
              <img src="assets/icons/wifi.png" height="24"><br>

                Data
           </center>
                        </a>
                    </td><td>
                        <a href="#"  data-toggle="modal" data-target="#BuyCable">
                             <center>
              <img src="assets/icons/cable.png" height="24"><br>

                Cable TV
           </center>
                        </a>
                    </td><td>
                        <a href="#" data-toggle="modal" data-target="#BuyElectric">
                             <center>
              <img src="assets/icons/electric.png" height="24"><br>

                Electricity
           </center>
                        </a>
                    </td></tr><tr style="font-size: 14px;line-height: 2; font-family: Trebuchet MS;"><td>
                        <a href="#" data-toggle="modal" data-target="#withdrawActionSheet">
                                 <center>
              <img src="assets/icons/withdraw.png" height="24"><br>

                Withdraw
           </center>
                        </a>
                    </td><td>
                        <a href="#" data-toggle="modal" data-target="#sendActionSheet">
                             <center>
              <img src="assets/icons/transfer.png" height="24"><br>

                Transfer
           </center>
                        </a>
                    </td><td>
                        <a href="#" data-toggle="modal" data-target="#unAvailable">
                             <center>
              <img src="assets/icons/bonus.png" height="24"><br>

                Bonuses
           </center>
                        </a>
                    </td><td>
                        <a href="#" data-toggle="modal" data-target="#upgradeMembership">
                             <center>
              <img src="assets/icons/upgrade.png" height="24"><br>

                Upgrade
           </center>
                        </a>
                    </td></tr>

                    <tr style="font-size: 14px;line-height: 2; font-family: Trebuchet MS;">
                        <td><a href="#" data-toggle="modal" data-target="#unAvailable">
                                 <center>
              <img src="assets/icons/invest.png" height="24"><br>

                Invest
           </center>
                        </a>
                    </td><td>
                        <a href="#" data-toggle="modal" data-target="#unAvailable">
                             <center>
              <img src="assets/icons/save.png" height="24"></ion-icon><br>

                Save
           </center>
                        </a>
                    </td><td>
                     <a href="#" data-toggle="modal" data-target="#unAvailable">
                             <center>
              <img src="assets/icons/loan.png" height="24"><br>

                Loan
           </center>
                        </a>
                    </td><td>
                       <a href="#" data-toggle="modal" data-target="#unAvailable">
                             <center>
             <img src="assets/icons/more.png" height="24"><br>

                More...
           </center>
                        </a>
                    </td></tr></table>
</div>


<hr class="p-0">

        <!-- Saving Goals -->
        <div class="section mt-2 mb-2">
            <div class="section-heading">
                <h4>Incentives & Bonuses</h4>
              
            </div>
            <div class="goals">
                <!-- item -->
                <div class="item" style="border: thin solid grey">
                    <div class="in">
                        <div>
                            <h4><?php echo $pro->getIncentive($uid); ?></h4>
                            <p>₦<?php echo number_format($pro->getIncentive($uid,3)) ?> RPV Incentive </p>
                        </div>
                        <div class="price">₦<?php echo number_format($pro->getIncentive($uid,5)) ?></div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: <?php echo $pro->getIncentive($uid,4) ?>%;" aria-valuenow="85"
                            aria-valuemin="0" aria-valuemax="100"><?php echo number_format($pro->getIncentive($uid,4),1) ?>%</div>

                    </div>
                </div>
                        
            </div>
        </div>
        <!-- * Saving Goals -->

         <div class="section full mt-4 mb-4">
            <div class="section-heading padding">
                <h4>Latest Referrals</h4>
                <a href="#" onclick="startMenux(3)" class="link"><big>See More</big></a>
            </div>
            <div class="shadowfix carousel-small owl-carousel owl-theme">
                <!-- item -->
                <?php
                
                    $sql = $db->query("SELECT * FROM matuser WHERE b1='$uidx' ORDER BY sn DESC LIMIT 12 "); 
                    while($row = mysqli_fetch_assoc($sql)) {                    
                       $id = $row['id'];
                    

                    ?>
            <!-- item -->
                <div class="item">
                    <a href="?find=<?php echo $row['sn'] ?>">
                        <div class="user-card" style="padding: 5px">
                            <img src="assets/img/s1.jpg" alt="img" class="imaged w-48">
                           
                        </div> 
                      </a>  
                      <center><small><?php echo substr(userName($id,'firstname'),0,8) ?></small></center>
                    
                </div>
                <!-- * item -->
            <?php }

             ?>
            
             
            </div>
        </div>
    </div>
 </div>
   
 </div>



       



        <!-- * Send Money -->
    <!-- * App Capsule -->
    <div style="display: block;"  id="menuPage">
<?php include('menu.php') ?>
</div>
    <!-- App Bottom Menu -->
</div>




<div style="display: none;" id="pagePage">
        <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left" >
            <a href="#" onclick="swapPages(1,1)" class="text-light">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle" id="pageTitle2">
            Livepetal
        </div>
        <div class="right">
            <!-- <a href="javascript:;" class="headerButton">
                <ion-icon name="add-outline"></ion-icon>
            </a> -->
        </div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">

        <div class="section full" id="pageContent2">
<center><div class="spinner-border text-primary p-3 m-5" role="status"></div> </center>
        </div>

    </div>
    <!-- * App Capsule -->
</div>

    <?php if(isset($report)){ $pro->AlertMobile(); } ?>





    <!-- All Modals  -->
<?php include('modals.php') ?>

    
    <!-- * App Sidebar -->

    <!-- ///////////// Js Files ////////////////////  -->
    <!-- Jquery -->
    <script src="assets/js/lib/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap-->
    <script src="assets/js/lib/popper.min.js"></script>
    <script src="assets/js/lib/bootstrap.min.js"></script>
    <!-- Ionicons -->
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
    <!-- Owl Carousel -->
    <script src="assets/js/plugins/owl-carousel/owl.carousel.min.js"></script>
    <!-- Base Js File -->
    <script src="assets/js/base.js"></script>
    <!-- <script src="next.js"></script> -->
    <script type="text/javascript">

        <?php if(isset($_GET['find'])){ ?>
            startMenux(3);
        <?php } ?>

    $(function(){
        $('body').on('click', '#transaction', function () {
            var tranx = $(this).data('trx');
$('#transactionD').modal('show');
            $.ajax({
                url: 'ajax.php?trx='+tranx,
                method: 'GET',
            }).done(function (res) {
           //$('#transactionD').modal('show');     

                $('#transactionB').html(res);
            })
        })



 $("#userid").keyup(function(){
            var v = $(this).val();
            
            $.ajax({
                type: 'get',
                url : 'ajax.php?val='+v
            }).done(function(data){
                
                if(data == ''){
                    $("#output").html('');
                }
                else {
                  //  $("#output").html('<img src="loading36.gif" />');
                    $("#output").html(data);
                }
            })
        })

function proDetail(value){

}


        $("#dnetwork").change(function(){
            var v = $(this).val();
            
            if(v != ''){
                    $("#output2").html('<center><div class="spinner-border text-primary p-3 m-5" role="status"></div> </center>');
                }

            $.ajax({
                type: 'get',
                url : 'ajax.php?val2='+v,
            }).done(function(data){
                
                if(data == ''){
                    $("#output2").html('');
                }
                else {
                    $("#output2").html(data);
                }
            })
        })

        $("#output2").change(function(){
            var v = $(this).val();
            if(v != ''){
                    $("#output3").html('<center><div class="spinner-border text-primary p-3 m-5" role="status"></div> </center>');
                }
            $.ajax({
                type: 'get',
                url : 'ajax.php?val3='+v
            }).done(function(data){
                
                if(data == ''){
                    $("#output3").html('');
                }
                else {
                    $("#output3").html(data);
                }
            })
        })
    })

     $(document).ready(function() {
             $("#Dstatus").html('<img src="loading36.gif" />');
            $('#Dstatus').load('ajax2.php'); 
        });

   // var input = document.getElementById("amount1").value;
    function trackChange(value){  
    //$('#BuyAirtime').modal('hide');  
 //$('#ConfirmD').modal('show');// 
 $("#cashback").text('Cashback: ₦' + value*0.03);
} 

 function confirmAirtime(){  
 var network = document.getElementById('airnetwork').value;
 var phone = document.getElementById('airphone').value;
 var amount = document.getElementById('airamount').value;
if(network == '' || phone == '' || amount == ''){
  toastbox('toast-12', 4000);// $('#showError').modal('show');//   
}else{
$('#ConfirmD').modal('show');// 
  $.ajax({
                type: 'get',
                url : 'confirm.php?network='+network+'&phone='+phone+'&amount='+amount+'&bal='+<?php echo $pro->wallet($uid) ?>+'&type=airtime'
            }).done(function(data){
                
                 $('#ConfirmB').html(data);
            })
}
} 
 
 function myNewPage(page){  

$('#newPage').modal('show');// 
  $.ajax({
                type: 'get',
                url : 'pages.php?page='+page+'&type=pages'
            }).done(function(data){
                
               $('#pageContent').html(data);
                 $('#pageTitle').html(page);

            })

} 
 

 function confirmTransfer(){  
 var rec = document.getElementById('userid').value;
 var name = document.getElementById('tname').value;
 var amount = document.getElementById('tamount').value;
 $('#ConfirmD').modal('show');// 
  $.ajax({
                type: 'get',
    url : 'confirm.php?rec='+rec+'&name='+name+'&amount='+amount+'&bal='+<?php echo $pro->wallet($uid) ?>+'&type=transfer'
            }).done(function(data){
                
                 $('#ConfirmB').html(data);
            })

} 
 

 function verifyMeter(){  
 var eprovider = document.getElementById('eprovider').value;
 var emeter = document.getElementById('emeter').value;
 var meter_type = document.meterdata.metertype.value ; 
 var a = document.getElementById('verifyres');
 var b = document.getElementById('verifybtn'); 
 
 $('#btnloader').html('<div class="spinner-border spinner-border-sm mr-05 text-light" role="status"></div> Loading...');
 
$.ajax({
                type: 'get',
                url : 'ajax.php?provider='+eprovider+'&metertype='+meter_type+'&meter='+emeter+'&typevm=verifye',
            }).done(function(data){
                
                 $('#verifyres').html(data);
                 b.style.display = 'none';
                 a.style.display = 'block'; 
                  $('#btnloader').html('Verify Meter');
            })
} 


 function verifyMeter2(){  
 var cprovider = document.getElementById('cprovider').value;
 var smartcard = document.getElementById('smartcard').value;
const verifybtn2 = document.getElementById('verifybtn2');

 var a = document.getElementById('verifyres2');
 var b = document.getElementById('verifybtn2'); 
 //alert(smartcard);
$('#verifybtn2').attr('disabled', 'disabled'); //disable form element
// jQuery('#verifybtn2').attr('disabled', 'disabled');//this work also
 $('#btnloader2').html('<div class="spinner-border spinner-border-sm mr-05 text-light" role="status"></div> Loading...');
 
$.ajax({
                type: 'get',
                url : 'ajax.php?provider='+cprovider+'&smartcard='+smartcard+'&typevc=verifyc',
            }).done(function(data){
                
                 $('#verifyres2').html(data);
                 b.style.display = 'none';
                 a.style.display = 'block'; 
                  $('#btnloader2').html('Verify Smart Card/IUC Number');
            })
} 

function moreTransaction(){
var trdate = document.getElementById('trdate').value;
 
 $('#dateMoreTr').html('<center><div class="spinner-border text-primary p-3 m-3" role="status"></div> </center>');
 $.ajax({
                type: 'get',
                url : 'pages.php?trdate='+trdate+'&page=datetransaction',
            }).done(function(data){
                
                 $('#dateMoreTr').html(data);
            })   
}


function toggleMeter(){
  var a = document.getElementById('verifyres');
 var b = document.getElementById('verifybtn'); 
  var c = document.getElementById('prepaid');
 var d = document.getElementById('postpaid');  
 var meter_type = document.meterdata.metertype.value;

if(meter_type=='_prepaid_custom'){
 c.classList.add("bcolor");
 d.classList.remove("bcolor"); 
}
else{
 c.classList.remove("bcolor");
 d.classList.add("bcolor");  
}
//alert(meter_type);
 b.style.display = 'block';
 a.style.display = 'none'; 
 $('#btnloader').html('Verify Meter');
}

function swapPages(value,value2){
  var g = document.getElementById('mainPage');
  var h = document.getElementById('pagePage'); 
  var i = document.getElementById('menuPage');


if(value==1){
 g.style.display = 'block';
 h.style.display = 'none'; 
 i.style.display = 'block';
 $('#pageContent2').html('<center><div class="spinner-border text-primary p-3 m-5" role="status"></div> </center>');
}else{
 g.style.display = 'none';
 h.style.display = 'block'; 
 i.style.display = 'none'; 
$('#pageTitle2').html(value2);
   $.ajax({
                type: 'get',
                url : 'pages.php?page='+value2+'&type=pages'
            }).done(function(data){                
               $('#pageContent2').html(data);

            })   
}

}


function toggleMeter2(){
  var a = document.getElementById('verifyres2');
 var b = document.getElementById('verifybtn2');  

  b.style.display = 'block';
 a.style.display = 'none'; 
 $('#btnloader2').html('Verify Smart Card/IUC Number');
}

function showBtnLoader(){ 
                 $('#btnloader').html('<div class="spinner-border spinner-border-sm mr-05 text-light" role="status"></div> Loading...');
           
} 


 function confirmElectric(){  
 var network = document.getElementById('eprovider').value;
 var meter = document.getElementById('emeter').value;
 var amount = document.getElementById('eamount').value;
 var name = document.getElementById('ename').value;
 var meter_type = document.meterdata.metertype.value ; 
 $('#ConfirmD').modal('show');// 
  $.ajax({
                type: 'get',
                url : 'confirm.php?network='+network+'&meter='+meter+'&metertype='+meter_type+'&amount='+amount+'&name='+name+'&bal='+<?php echo $pro->wallet($uid) ?>+'&type=electric'
            }).done(function(data){
                
                 $('#ConfirmB').html(data);
            })

}

 function confirmCable(){  
 var cprovider = document.getElementById('cprovider').value;
 var smartcard = document.getElementById('smartcard').value;
 var amount = document.getElementById('camount').value;
 var name = document.getElementById('cname').value;

 $('#ConfirmD').modal('show');// 
  $.ajax({
                type: 'get',
                url : 'confirm.php?provider='+cprovider+'&smartcard='+smartcard+'&amount='+amount+'&name='+name+'&bal='+<?php echo $pro->wallet($uid) ?>+'&type=cable'
            }).done(function(data){
                
                 $('#ConfirmB').html(data);
            })

}

 function confirmData(){  
 var network = document.getElementById('dnetwork').value;
 var phone = document.getElementById('dphone').value;
 var productcode = document.getElementById('dproductcode').value;
 $('#ConfirmD').modal('show');// 
  $.ajax({
                type: 'get',
                url : 'confirm.php?network='+network+'&phone='+phone+'&productcode='+productcode+'&bal='+<?php echo $pro->wallet($uid) ?>+'&type=data'
            }).done(function(data){
                
                 $('#ConfirmB').html(data);
            })

}
    function transferAmt(value){    
  $("#transferAmt").text('₦'+numberWithCommas(value));
}

function numberWithCommas(x) {
    return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
}

        //remove the on load to trigger it any time you want 
        <?php if(isset($report)){ ?>
    $(window).on('load',function(){
        $('#AlertMobile').modal('show');
    });
<?php }  ?>

   function ConfirmBas()
    {
        $('#ConfirmBasic').modal('show');
    };



    function controlForm(){
        $('#subscribeId').attr('disabled', true);
        $('#subscribeId').html('<div id="loader"><div class="spinner-border text-danger" role="status"></div></div> Processing...');
      }



      $("#idForm").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
    var url = form.attr('action');
    
    $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // serializes the form's elements.
           success: function(data)
           {
           $('#FormData').html(data);//  alert(data); // show response from the php script.
           }
         });

    
});


 function showLoader(){ 
     $('#showProcess').modal('show');// 
//$('#btnloader').html('<div class="spinner-border spinner-border-sm mr-05 text-light" role="status"></div> Processing...');            
} 


//div1.classList.add("active");
        function startMenux(value){
        var home = document.getElementById('home');
        var trans = document.getElementById('trans');
        var refe = document.getElementById('refe');
        var promo = document.getElementById('promo');
        var profile = document.getElementById('profile');
        var div1 = document.getElementById("div1");
        var div2 = document.getElementById("div2");
        var div3 = document.getElementById("div3");
        var div4 = document.getElementById("div4");
        var div5 = document.getElementById("div5");


     if(value==1){
       home.style.display = 'block';
       trans.style.display = 'none';
       refe.style.display = 'none';
       promo.style.display = 'none';
       profile.style.display = 'none';
       $('#pTitle').html('Livepetal');
       div1.classList.add("active");
       div2.classList.remove("active");
       div3.classList.remove("active");
       div4.classList.remove("active");
       div5.classList.remove("active");
        }
        else if(value==2){
         home.style.display = 'none';
       trans.style.display = 'block';
         refe.style.display = 'none';
         promo.style.display = 'none';
         profile.style.display = 'none'; 
       $('#pTitle').html('Transactions'); 
       div1.classList.remove("active");
       div2.classList.add("active");
       div3.classList.remove("active");
       div4.classList.remove("active");
       div5.classList.remove("active"); 
        }
        else if(value==3){
         home.style.display = 'none';
       trans.style.display = 'none';
         refe.style.display = 'block';
         promo.style.display = 'none';
         profile.style.display = 'none'; 
       $('#pTitle').html('Referrals'); 
       div1.classList.remove("active");
       div2.classList.remove("active");
       div3.classList.add("active");
       div4.classList.remove("active");
       div5.classList.remove("active"); 
        }
        else if(value==4){
         home.style.display = 'none';
       trans.style.display = 'none';
         refe.style.display = 'none';
         promo.style.display = 'block';
         profile.style.display = 'none'; 
       $('#pTitle').html('Promotions'); 
       div1.classList.remove("active");
       div2.classList.remove("active");
       div3.classList.remove("active");
       div4.classList.add("active");
       div5.classList.remove("active"); 
        }
        else if(value==5){
         home.style.display = 'none';
       trans.style.display = 'none';
         refe.style.display = 'none';
         promo.style.display = 'none';
         profile.style.display = 'block'; 
       $('#pTitle').html('Account Information');  
       div1.classList.remove("active");
       div2.classList.remove("active");
       div3.classList.remove("active");
       div4.classList.remove("active");
       div5.classList.add("active");
        }
        //return false;
         // $('#ConfirmBasic').modal('show');
    }

 function keepLogin(){
     $.ajax({
                type: 'get',
                url : 'pages.php?page=togglekeeplogin',
            }).done(function(data){
         toastbox('toast-11', 3000);//notify 
            }) 
  
 }


$('#showProcess').modal('show');//

function showCover(dela=6000){
 setTimeout(function(){

$('#ConfirmBasic').modal('show');//
 // 
}, dela); 
}

showCover(600000);
 function removeCover(value){
    if(value.length==4){
  if(value==<?php echo userName($uid,'auth') ?>){
   $('#ConfirmBasic').modal('hide');
   document.getElementById("smscode").value = "";
showCover(600000);
  }else{
toastbox('toast-10', 3000);
  } 
 }
}
    </script>


 <div id="toast-10" class="toast-box toast-center" style="z-index: 100000000">
            <div class="in">
                <div class="text">
                   Invalid Authentication Code
                </div>
            </div>
        </div>

 <div id="toast-11" class="toast-box toast-center" style="z-index: 100000000">
            <div class="in">
                <div class="text">
                    Settings Updated Successfully
                </div>
            </div>
        </div>

 <div id="toast-12" class="toast-box toast-center" style="z-index: 100000000">
            <div class="in">
                <div class="text">
                    All fields are required
                </div>
            </div>
        </div>

</body>

</html>
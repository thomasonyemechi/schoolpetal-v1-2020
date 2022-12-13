<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
view routes
dashboard  
*/
Route::middleware(['auth:sanctum', 'verified'])->get('receipt', 'ViewController@rindex')->name('rindex')->middleware('auth');

//E-liabry Routes   
Route::middleware(['auth:sanctum', 'verified'])->get('addbook', 'LibraryController@addbookindex2')->name('addbook')->middleware('auth');
Route::middleware(['auth:sanctum', 'verified'])->get('addebook', 'LibraryController@addbookindex')->name('addbookindex')->middleware('auth');
Route::middleware(['auth:sanctum', 'verified'])->post('createbookcategory', 'LibraryController@createbookcategory')->name('createbookcategory')->middleware('auth');
Route::middleware(['auth:sanctum', 'verified'])->post('AddBook', 'LibraryController@AddBook')->name('AddBook')->middleware('auth');


//student routes 
Route::middleware(['auth:sanctum', 'verified'])->post('updateuname', 'Student\GeneralController@updateuname')->name('updateuname')->middleware('auth');
Route::get('mydashboard', 'Student\GeneralController@index')->name('mydashboard')->middleware('student');
Route::get('activeexam', 'Student\GeneralController@activeexam')->name('activeexam')->middleware('student');
Route::get('myprofile', 'Student\GeneralController@mprofile')->name('myprofile')->middleware('student');
Route::get('course', 'Student\GeneralController@activecourse')->name('course')->middleware('student');
Route::get('courseinfo/{sn}', 'Student\GeneralController@courseinfo')->name('courseinfo')->middleware('student');
Route::get('answerquestion', 'Student\GeneralController@answer')->name('answerquestion')->middleware('student')->middleware('tcode');
Route::get('answer/{esn}', 'Student\GeneralController@answerf')->name('answer')->middleware('student');
Route::post('saveanswer', 'Student\GeneralController@saveanswer')->name('saveanswer')->middleware('student');
Route::post('atuofillresult', 'Student\GeneralController@atuofillresult')->name('atuofillresult')->middleware('auth');
Route::post('pickresult', 'Student\GeneralController@pickresult')->name('pickresult')->middleware('auth');
Route::get('studentresult', 'Student\GeneralController@allresult')->name('allresult')->middleware('auth');


Route::get('resultchecker', 'Student\OtherController@CheckMyResult');


//e-learning
Route::middleware(['auth:sanctum', 'verified'])->get('course/createcourse', 'Course\CourseController@index')->name('createcourse')->middleware('auth');
Route::middleware(['auth:sanctum', 'verified'])->get('createmodule/{sn}', 'Course\CourseController@chapindex')->name('createmodule')->middleware('auth');
Route::middleware(['auth:sanctum', 'verified'])->post('addcourse', 'Course\CourseController@addcourse')->name('addcourse')->middleware('auth');
Route::middleware(['auth:sanctum', 'verified'])->post('addmoudle', 'Course\CourseController@addmoudle')->name('addmoudle')->middleware('auth');
Route::middleware(['auth:sanctum', 'verified'])->post('moduleup', 'Course\CourseController@moduleup')->name('moduleup')->middleware('auth');
Route::middleware(['auth:sanctum', 'verified'])->post('moduledown', 'Course\CourseController@moduledown')->name('moduledown')->middleware('auth');

///danger   

Route::middleware(['auth:sanctum', 'verified'])->post('updatesmssetup', 'SmsController@updatesmssetup')->name('updatesmssetup')->middleware('auth');
Route::middleware(['auth:sanctum', 'verified'])->post('dostudent', 'Course\CourseController@dostudent')->name('dostudent')->middleware('auth');
Route::middleware(['auth:sanctum', 'verified'])->post('autofillschoolresult', 'ResultController@autofillschoolresult')->name('autofillschoolresult')->middleware('auth');
Route::middleware(['auth:sanctum', 'verified'])->post('triggerpay', 'Course\CourseController@triggerpay')->name('triggerpay')->middleware('auth');
Route::middleware(['auth:sanctum', 'verified'])->post('triggerques', 'Student\GeneralController@trig')->name('triggerques')->middleware('auth');
Route::middleware(['auth:sanctum', 'verified'])->post('test', 'Student\GeneralController@test')->name('test')->middleware('auth');
Route::middleware(['auth:sanctum', 'verified'])->post('adderuser', 'Student\GeneralController@adderuser')->name('adderuser')->middleware('auth');
Route::middleware(['auth:sanctum', 'verified'])->post('updatepwd', 'Course\CourseController@updatepwd')->name('updatepwd')->middleware('auth');
//Route::middleware(['auth:sanctum', 'verified'])->post('triggerques', 'Student\GeneralController@trig')->name('triggerques')->middleware('auth');



//route for Cbt 
Route::middleware(['auth:sanctum', 'verified'])->post('updatequestion/{id}', 'Cbt\QuestionController@updatequestion')->name('updatequestion')->middleware('auth');
Route::middleware(['auth:sanctum', 'verified'])->get('editquestion/{id}/', 'Cbt\QuestionController@showq')->name('editquestion')->middleware('auth');
Route::middleware(['auth:sanctum', 'verified'])->get('addquestion', 'Cbt\QuestionController@index')->name('addquestion')->middleware('auth');
Route::middleware(['auth:sanctum', 'verified'])->get('createtype', 'Cbt\QuestionController@typein')->name('createtype')->middleware('auth');
Route::middleware(['auth:sanctum', 'verified'])->get('createexam', 'Cbt\QuestionController@examin')->name('createexam')->middleware('auth');
Route::middleware(['auth:sanctum', 'verified'])->post('addtype', 'Cbt\QuestionController@addtype')->name('addtype')->middleware('auth');
Route::middleware(['auth:sanctum', 'verified'])->post('addexam', 'Cbt\QuestionController@addexam')->name('addexam')->middleware('auth');
Route::middleware(['auth:sanctum', 'verified'])->post('submitQuestion', 'Cbt\QuestionController@submitQuestion')->name('submitQuestion')->middleware('auth');
Route::middleware(['auth:sanctum', 'verified'])->post('getesn', 'Cbt\QuestionController@getesn')->name('getesn')->middleware('auth');

//Dashboard Routes
Route::middleware(['auth', 'verified'])->get('dashboard', 'ViewController@index')->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->get('salesdetails', 'ViewController@sadr')->name('salesdetails');
Route::middleware(['auth:sanctum', 'verified'])->post('getinfo', 'ViewController@getinfo')->name('getinfo');
Route::middleware(['auth:sanctum', 'verified'])->get('feereceipt/{transaction}', 'ViewController@feereceipt')->name('feereceipt');
//route for school feee report
Route::middleware(['auth:sanctum', 'verified'])->get('generalfee', 'ViewController@genfee')->name('generalfee');
Route::middleware(['auth:sanctum', 'verified'])->get('dailyfee', 'ViewController@dailyfee')->name('dailyfee');
Route::middleware(['auth:sanctum', 'verified'])->post('getday2', 'ViewController@getday2')->name('getday2');
Route::middleware(['auth:sanctum', 'verified'])->get('weeklyfee', 'ViewController@weeklyfee')->name('weeklyfee');
Route::middleware(['auth:sanctum', 'verified'])->post('getweek2', 'ViewController@getweek2')->name('getweek2');
Route::middleware(['auth:sanctum', 'verified'])->get('termlyfee', 'ViewController@termlyfee')->name('termlyfee');
Route::middleware(['auth:sanctum', 'verified'])->post('getterm', 'ViewController@getterm')->name('getterm');

//parent routes
Route::middleware(['auth:sanctum', 'verified'])->post('RegisterParent', 'ParentController@RegisterParent')->name('RegisterParent');
Route::middleware(['auth:sanctum', 'verified'])->post('doparent', 'ParentController@doparent')->name('doparent');
Route::middleware(['auth:sanctum', 'verified'])->post('shuffle', 'ParentController@shuffle')->name('shuffle');
Route::middleware(['auth:sanctum', 'verified'])->get('addparentstd', 'StudentController@addstd')->name('addstd');
Route::middleware(['auth:sanctum', 'verified'])->get('parent/add', 'ParentController@index')->name('index');


// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/invoice', function () {
    return view('other.invoice');
})->name('invoice');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');




//student registration
// Route::middleware(['auth:sanctum', 'verified'])->get('/registerstudent', function () {
//     return view('student.create');
// })->name('registerstudent');
//student
// Route::middleware(['auth:sanctum', 'verified'])->get('/allstudent', function () {
//     return view('allstudent');
// })->name('allstudent');
//student
// Route::middleware(['auth:sanctum', 'verified'])->get('/student', function () {
//     return view('student.index');
// })->name('student');
//

Route::get('/', function () {
    return view('index');
})->name('/');

/*startresult
Controller routes
*/
//sms 
Route::get('smssetup', 'SmsController@index')->name('smssetup')->middleware('auth');
Route::post('updateapikeyssms', 'SmsController@updateapikeyssms')->name('updateapikeyssms')->middleware('auth');
Route::post('updatesmsprefer', 'SmsController@updatesmsprefer')->name('updatesmsprefer')->middleware('auth');

//result printers and others 
Route::middleware(['auth:sanctum', 'verified'])->get('printresult', 'PrintController@index1')->name('printresult')->middleware('auth');
Route::middleware(['auth:sanctum', 'verified'])->get('checkresult', 'PrintController@index1')->name('printresult')->middleware('auth');
Route::middleware(['auth:sanctum', 'verified'])->get('printresultall', 'PrintController@allprintlink')->name('allprintlink')->middleware('auth');

Route::middleware(['auth:sanctum', 'verified'])->get('printresultallxx', 'PrintController@allprintlinkxx')->middleware('auth');


Route::middleware(['auth:sanctum', 'verified'])->get('print', 'PrintController@index2')->name('print')->middleware('auth');
Route::middleware(['auth:sanctum', 'verified'])->post('getsid', 'PrintController@getsid')->name('getsid');
Route::middleware(['auth:sanctum', 'verified'])->post('getclass', 'PrintController@getclass')->name('getclass');
Route::middleware(['auth:sanctum', 'verified'])->get('printbyclass', 'PrintController@allprint')->name('printbyclass');
//result routes
Route::middleware(['auth:sanctum', 'verified'])->get('postresult', 'ResultController@index')->name('postresult');
Route::middleware(['auth:sanctum', 'verified'])->post('startresult', 'ResultController@startresult')->name('startresult');
Route::middleware(['auth:sanctum', 'verified'])->post('submitresult', 'ResultController@submitresult')->name('submitresult');
//student resource route
Route::middleware(['auth:sanctum', 'verified'])->resource('student', 'StudentController');
Route::middleware(['admin', 'verified'])->get('promotion', 'StudentController@index2')->name('promotion')->middleware('auth');
Route::middleware(['auth:sanctum', 'verified'])->post('promoteall', 'StudentController@promoteall')->name('promoteall');
Route::middleware(['auth:sanctum', 'verified'])->post('promotesome', 'StudentController@promotesome')->name('promotesome');
Route::middleware(['auth:sanctum', 'verified'])->post('demoteStudent', 'StudentController@demoteStudent')->name('demoteStudent');
Route::middleware(['auth:sanctum', 'verified'])->post('promoteStudent', 'StudentController@promoteStudent')->name('promoteStudent');
Route::middleware(['admin', 'verified'])->get('promotion/{classid}', 'StudentController@index3')->name('promotion/{classid}');
Route::middleware(['auth:sanctum', 'verified'])->post('getstudent', 'StudentController@getstudent')->name('getstudent');
Route::middleware(['auth:sanctum', 'verified'])->post('payfee', 'StudentController@payfee')->name('payfee');
Route::middleware(['auth:sanctum', 'verified'])->post('deactivatestudent', 'StudentController@deactivatestudent')->name('deactivatestudent');
Route::middleware(['auth:sanctum', 'verified'])->post('activatestudent', 'StudentController@activatestudent')->name('activatestudent');
Route::middleware(['auth:sanctum', 'verified'])->post('updatestudent', 'StudentController@updatestudent')->name('updatestudent');
//SchoolRegistration Routes
Route::post('register', 'Auth\SignupController@signup')->name('signup');
//set fees
Route::middleware(['setfees', 'verified','auth'])->get('setfee', 'FeeController@index')->name('setfee')->middleware('auth');
Route::middleware(['auth:sanctum', 'verified'])->get('paymentprofile', 'FeeController@payindex')->name('paymentprofile')->middleware('auth');
Route::middleware(['auth:sanctum', 'verified'])->post('addfeecat', 'FeeController@addfeecat')->name('addfeecat');
Route::middleware(['auth:sanctum', 'verified'])->post('addfee', 'FeeController@addfee')->name('addfee');
Route::middleware(['auth:sanctum', 'verified'])->post('adjustfee', 'FeeController@adjustfee')->name('adjustfee');
//exependiture
Route::middleware(['addexpense', 'verified'])->get('expenditure', 'ExpenditureController@index')->name('expenditure')->middleware('auth');
Route::middleware(['auth:sanctum', 'verified'])->post('addExpenditureType', 'ExpenditureController@addExpenditureType')->name('addExpenditureType');
Route::middleware(['auth:sanctum', 'verified'])->post('addExpenditure', 'ExpenditureController@addExpenditure')->name('addExpenditure');
Route::middleware(['auth:sanctum', 'verified'])->post('deleteExpenditure', 'ExpenditureController@deleteExpenditure')->name('deleteExpenditure');
Route::middleware(['auth:sanctum', 'verified'])->post('addSupplier', 'ExpenditureController@addSupplier')->name('addSupplier');
//terms setup 
Route::middleware(['auth:sanctum', 'verified'])->post('createterm', 'TermController@createterm')->name('createterm');
Route::middleware(['auth:sanctum', 'verified'])->post('updatedate', 'TermController@updatedate')->name('updatedate');
Route::middleware(['auth:sanctum', 'verified'])->post('ActivateTerm', 'TermController@ActivateTerm')->name('ActivateTerm');
//Setups routes
Route::middleware(['auth:sanctum', 'verified'])->post('UpdateTitleLogo', 'SetupController@UpdateTitleLogo')->name('UpdateTitleLogo');
Route::middleware(['auth:sanctum', 'verified'])->post('UserShutdown', 'SetupController@UserShutdown')->name('UserShutdown');
Route::middleware(['auth:sanctum', 'verified'])->post('pick', 'SetupController@pick')->name('pick');
Route::middleware(['auth:sanctum', 'verified'])->post('UpdateOperatingHr', 'SetupController@UpdateOperatingHr')->name('UpdateOperatingHr');
Route::middleware(['auth:sanctum', 'verified'])->post('UpdateComment', 'GradeController@UpdateComment')->name('UpdateComment');
Route::middleware(['auth:sanctum', 'verified'])->post('updateDefaultScore', 'GradeController@updateDefaultScore')->name('updateDefaultScore');
Route::middleware(['auth:sanctum', 'verified'])->post('updateDefaultGrade', 'GradeController@updateDefaultGrade')->name('updateDefaultGrade');
Route::middleware(['admin', 'verified'])->get('resultsetup', 'GradeController@index')->name('resultsetup');
Route::middleware(['admin', 'verified'])->get('generalsetup', 'SetupController@generalindex')->name('generalsetup')->middleware('auth');
Route::middleware(['admin', 'verified'])->get('adminsetup', 'SetupController@adminindex')->name('adminsetup')->middleware('auth');
Route::middleware(['admin', 'verified'])->post('updaterole', 'SetupController@updaterole')->name('updaterole')->middleware('auth');
Route::middleware(['auth:sanctum', 'verified'])->post('adduser', 'SetupController@adduser')->name('adduser')->middleware('auth');
Route::middleware(['auth:sanctum', 'verified'])->post('updateadinfo', 'SetupController@updateinfo')->name('updateadinfo');
//adding of staff and workers
Route::middleware(['auth:sanctum', 'verified'])->get('staffs', 'StaffController@index')->name('staffs')->middleware('auth');
Route::middleware(['auth:sanctum', 'verified'])->get('staffprofile', 'StaffController@index2')->name('staffprofile')->middleware('auth');
Route::middleware(['auth:sanctum', 'verified'])->post('updatestaff', 'StaffController@updatestaff')->name('updatestaff');
Route::middleware(['auth:sanctum', 'verified'])->post('deactivatestaff', 'StaffController@deactivatestaff')->name('deactivatestaff');
Route::middleware(['auth:sanctum', 'verified'])->post('activatestaff', 'StaffController@activatestaff')->name('activatestaff');
Route::middleware(['auth:sanctum', 'verified'])->post('getmy', 'StaffController@getmy')->name('getmy');
Route::middleware(['auth:sanctum', 'verified'])->post('addstaff', 'StaffController@addstaff')->name('addstaff');
Route::middleware(['auth:sanctum', 'verified'])->post('getstaff', 'StaffController@getstaff')->name('getstaff');
Route::middleware(['auth:sanctum', 'verified'])->post('deletesubject2', 'StaffController@deletesubject2')->name('deletesubject2');
Route::middleware(['auth:sanctum', 'verified'])->post('setsubject/{id}', 'StaffController@setsubject')->name('setsubject');
Route::middleware(['auth:sanctum', 'verified'])->post('paymentdetail', 'StaffController@paymentdetail')->name('paymentdetail');
Route::middleware(['auth:sanctum', 'verified'])->post('addpayment', 'StaffController@addpayment')->name('addpayment');
//subject routes
Route::middleware(['admin', 'verified'])->get('subjects', 'SubjectController@index')->name('subjects');
Route::middleware(['auth:sanctum', 'verified'])->post('createsubject', 'SubjectController@createsubject')->name('createsubject');
Route::middleware(['auth:sanctum', 'verified'])->post('deletesubject', 'SubjectController@deletesubject')->name('deletesubject');

//class cat, arm route
Route::middleware(['auth:sanctum', 'verified'])->get('classes', 'ClasseController@index')->name('classes')->middleware('auth');
Route::middleware(['auth:sanctum', 'verified'])->post('ClassDown', 'ClasseController@ClassDown')->name('ClassDown');
Route::middleware(['auth:sanctum', 'verified'])->post('ClassUp', 'ClasseController@ClassUp')->name('ClassUp');
Route::middleware(['admin', 'verified'])->post('classdelete', 'ClasseController@DeleteClass')->name('classdelete');
Route::middleware(['auth:sanctum', 'verified'])->post('createclass', 'ClasseController@createclass')->name('createclass');
Route::middleware(['auth:sanctum', 'verified'])->post('createcat', 'ClasscatController@createcat')->name('createcat');
Route::middleware(['auth:sanctum', 'verified'])->post('createarm', 'ClasscatController@createarm')->name('createarm');
Route::middleware(['admin', 'verified'])->get('classcat', 'ClasscatController@index')->name('classcat');

//General login
Route::post('login', 'Auth\LoginController@login')->name('login');
//student login
Route::post('studentlogin', 'Auth\LoginController@studentlogin')->name('studentlogin');
Route::get('/studentaccess', function () { return view('student.login'); })->name('/student/login');
//Route::resource('login', 'Auth\LoginController');


//Route::sales

Route::middleware(['auth:sanctum', 'verified'])->post('StockItemUnit', 'Sale@StockItemUnit')->name('StockItemUnit');
Route::middleware(['auth:sanctum', 'verified'])->post('invoiceCheckout', 'Sale@invoiceCheckout')->name('invoiceCheckout');
Route::middleware(['auth:sanctum', 'verified'])->post('UnstockItemUnit', 'Unstock@UnstockItemUnit')->name('UnstockItemUnit');
Route::middleware(['auth:sanctum', 'verified'])->post('unitSales', 'Stocks@unitSales')->name('unitSales');
Route::middleware(['auth:sanctum', 'verified'])->post('salesCheckout', 'Stocks@salesCheckout')->name('salesCheckout');
Route::middleware(['auth:sanctum', 'verified'])->post('EditLinePos', 'Stocks@EditLinePos')->name('EditLinePos');
Route::middleware(['auth:sanctum', 'verified'])->post('removeItem', 'Stocks@removeItem')->name('removeItem');
Route::middleware(['auth:sanctum', 'verified'])->post('expenseCheckout', 'ExpenditureController@expenseCheckout')->name('expenseCheckout');
Route::middleware(['bigsalesrep', 'verified'])->get('repprofile', 'ViewController@repindex')->name('repprofile')->middleware('auth');
Route::middleware(['bigsalesrep', 'verified'])->get('vendorprofile', 'ViewController@supindex')->name('vendorprofile')->middleware('auth');
Route::middleware(['bigsalesrep', 'verified'])->get('genstock', 'ViewController@genstock')->name('genstock')->middleware('auth');
Route::middleware(['bigsalesrep', 'verified'])->get('stockprofile', 'ViewController@stockindex')->name('stockprofile')->middleware('auth');
Route::middleware(['bigsalesrep', 'verified'])->get('stockpreorder', 'OrderController@oindex')->name('stockpreorder')->middleware('auth');
Route::middleware(['bigsalesrep', 'verified'])->get('orderprocessing', 'OrderController@index')->name('orderprocessing')->middleware('auth');
Route::middleware(['bigsalesrep', 'verified'])->get('dailysales', 'ViewController@dailysales')->name('dailysales')->middleware('auth');
Route::middleware(['bigsalesrep', 'verified'])->get('weeklysales', 'ViewController@weeklysales')->name('weeklysales')->middleware('auth');
Route::middleware(['bigsalesrep', 'verified'])->get('monthlysales', 'ViewController@monthlysales')->name('monthlysales')->middleware('auth');
Route::middleware(['bigsalesrep', 'verified'])->get('annualsales', 'ViewController@annualsales')->name('annualsales')->middleware('auth');
Route::middleware(['bigsalesrep', 'verified'])->get('annualstock', 'ViewController@annualstock')->name('annualstock')->middleware('auth');
Route::middleware(['bigsalesrep', 'verified'])->get('profitloss', 'ViewController@profitloss')->name('profitloss')->middleware('auth');
Route::middleware(['bigsalesrep', 'verified'])->get('expend', 'ViewController@expend')->name('expend')->middleware('auth');
Route::middleware(['auth:sanctum', 'verified'])->post('getsrep', 'ViewController@getsrep')->name('getsrep');
Route::middleware(['auth:sanctum', 'verified'])->post('getvendor', 'ViewController@getvendor')->name('getvendor');
Route::middleware(['auth:sanctum', 'verified'])->post('updateStockProfile', 'Stocks@updateStockProfile')->name('updateStockProfile');
Route::middleware(['auth:sanctum', 'verified'])->post('unitPreOrder', 'OrderController@unitPreOrder')->name('unitPreOrder');
Route::middleware(['auth:sanctum', 'verified'])->post('EditLine', 'OrderController@EditLine')->name('EditLine');
Route::middleware(['auth:sanctum', 'verified'])->post('removeOrderItem', 'OrderController@removeOrderItem')->name('removeOrderItem');
Route::middleware(['auth:sanctum', 'verified'])->post('PreOrderCheckout', 'OrderController@PreOrderCheckout')->name('PreOrderCheckout');
Route::middleware(['auth:sanctum', 'verified'])->post('ViewOrder', 'OrderController@ViewOrder')->name('ViewOrder');
Route::middleware(['bigsalesrep', 'verified'])->post('ApprovePreOrder', 'OrderController@ApprovePreOrder')->name('ApprovePreOrder');
Route::middleware(['bigsalesrep', 'verified'])->post('getday', 'ViewController@getday')->name('getday');
Route::middleware(['bigsalesrep', 'verified'])->post('getweek', 'ViewController@getweek')->name('getweek');
Route::middleware(['bigsalesrep', 'verified'])->post('getmonth', 'ViewController@getmonth')->name('getmonth');
Route::middleware(['auth:sanctum', 'verified'])->post('upower', 'PowerController@power')->name('upower');
Route::middleware(['auth:sanctum', 'verified'])->post('updatepower', 'PowerController@update')->name('update'); 
Route::middleware(['power', 'verified'])->get('power', 'PowerController@index')->name('power')->middleware('auth');

Route::get('generatecomment', 'student\OtherController@generateComment')->middleware('auth');
Route::post('UpdateresultComment', 'student\OtherController@UpdateresultComment')->name('UpdateresultComment')->middleware('auth');

//billing routes

Route::middleware(['admin', 'verified'])->get('renew', 'BillController@index')->middleware('auth');
Route::middleware(['admin', 'verified'])->get('slot', 'BillController@slotindex')->middleware('auth');
Route::middleware(['admin', 'verified'])->post('generateSlotInvoice', 'BillController@generateSlotInvoice')->middleware('auth');
Route::middleware(['admin', 'verified'])->post('getSlot', 'BillController@getSlot')->middleware('auth');
Route::middleware(['admin', 'verified'])->get('slotinvoice', 'BillController@slotInvoiceIndex')->middleware('auth');

//password Routes 

Route::middleware(['auth', 'verified'])->post('changepassword', 'PasswordController@changepassword');




Route::get('genstocks', 'Genstock@index')->name('genstocks');
Route::post('createcategory', 'Category@add_category')->name('createcategory')->middleware('auth');
Route::get('category', 'Category@category')->name('category')->middleware('auth');
Route::post('postitem', 'Category@post_item')->name('postitem')->middleware('auth');
Route::get('createitem', 'Category@add_item')->name('createitem')->middleware('auth');
Route::get('sales', 'Sale@index')->name('sales')->middleware('auth');
//Route::get('stockprofile', 'Stocks@stock_profile')->name('stockprofile')->middleware('auth');
Route::get('restocks', 'Sale@restock')->name('restocks')->middleware('auth');
Route::post('postitempin', 'Sale@post_itempin')->name('postitempin')->middleware('auth');
Route::post('unititem', 'Sale@unit_item')->name('unititem')->middleware('auth');
Route::post('packitem', 'Sale@pack_item')->name('packitem')->middleware('auth');
Route::post('addsupplier', 'Genstock@add_supplier')->name('addsupplier')->middleware('auth');
Route::post('positem', 'Stocks@pos')->name('positem')->middleware('auth');
Route::post('salebyunit', 'Stocks@sale_by_unit')->name('salebyunit')->middleware('auth');
Route::post('salebypack', 'Stocks@sale_by_pack')->name('salebypack')->middleware('auth');
Route::post('postuid', 'Pos@post_uid')->name('postuid')->middleware('auth');
Route::get('sales', 'Stocks@index')->name('sales')->middleware('auth')->middleware('makesales');
Route::get('uid', 'Pos@get_uid')->name('uid')->middleware('auth');
Route::post('profiles', 'Genstock@profile')->name('profiles')->middleware('auth');
Route::get('profile', 'Genstock@stock_profile')->name('profile')->middleware('auth');
Route::get('unstock', 'Unstock@unstock')->name('unstock')->middleware('auth');
Route::post('unstocks', 'Unstock@unstocks')->name('unstocks')->middleware('auth');
Route::post('reason', 'Unstock@reason')->name('reason')->middleware('auth');
Route::post('allreasons', 'Unstock@allreasons')->name('allreasons')->middleware('auth');
Route::post('checkout', 'Sale@checkout')->name('checkout')->middleware('auth');

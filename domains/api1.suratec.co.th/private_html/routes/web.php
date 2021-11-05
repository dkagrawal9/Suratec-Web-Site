<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});



/*$router->group(['prefix' => '/auth'], function ($router) {
    $router->post('/login', 'Auth\AuthController@authenticate');
	$router->post('/loginfacebook', 'Auth\AuthController@authenticatefacebook');
	$router->post('/logingoogle', 'Auth\AuthController@authenticategoogle');
    $router->post('/home', 'Auth\HomeController@homemenu');
    $router->post('/updata-password', 'Auth\UpdataPasswordController@new_password');
    $router->post('/updata-email', 'Auth\UpdataPasswordController@updataemail');
    $router->post('/logout', 'Auth\AuthController@authentlogouticate');
    $router->post('/register', 'Auth\RegisterController@register');
    $router->post('/change-password', 'Auth\ChangPasswordController@new_password');
    $router->post('/tracking', 'Auth\TrackingController@trackting');
    $router->post('/receive', 'Auth\ReceivepackageController@receivepackage');
    $router->post('/bring', 'Auth\BringthepackageController@bringthepackage');
    $router->post('/deliver', 'Auth\DeliverparcelController@deliver');
    $router->post('/deliverdetail', 'Auth\DeliverparcelController@deliverdetail');
    $router->post('/deliveredit', 'Auth\DeliverparcelController@deliveredit');
    $router->post('/deliveretracking', 'Auth\DeliverparcelController@deliveretracking');
    $router->post('/claim', 'Auth\ClaimController@claim');
    $router->post('/claimselect', 'Auth\ClaimController@claimselect');
});*/

$router->group(['prefix' => '/check'], function ($router) {
    $router->post('/login', 'Auth\AuthController@authenticate');
    $router->post('/logout', 'Auth\AuthController@authentlogouticate');
});
$router->group(['prefix' => '/appointments'], function ($router) {
    $router->post('/', 'AppointmentController@create');
    $router->get('/getBookingTime', 'AppointmentController@getBookingTime');/* Create by Rajesh Rathod  call other place also*/
    $router->get('/patients/{id_customer}', 'AppointmentController@patientsAppointments');
    $router->get('/doctors/{id_employee}', 'AppointmentController@doctorsAppointments');
    $router->get('/cancel/{id_appointment}/{id_customer}/{status}', 'AppointmentController@cancelAppointment');
    $router->patch('/call-status/{id_appointment}/{id_employee}', 'AppointmentController@updateCallStatus');
    $router->patch('/end-call/{id_appointment}/{id_employee}', 'AppointmentController@endAppointmentCall');
});


$router->group(['prefix' => '/chat'], function ($router) {
    $router->post('/add-message', 'ChatController@addMessage');
    $router->get('/messages/{user_id}', 'ChatController@chatMessages');
    $router->get('/getPubnumMessage', 'ChatPubnubController@getPubnumMessage');
    $router->get('/getchatstatus/{id_user}', 'ChatController@getchatstatus');

    $router->post('/addonlineofflinestatus', 'ChatController@addonlineofflinestatus');
    $router->get('/lazyMessageList/{channel_id}/{timetoken}', 'ChatPubnubController@lazyMessageList');
});


$router->group(['prefix' => '/notifications'], function ($router) {
    $router->get('/{id_user}', 'NotificationController@all');
    $router->get('/read/{id_notification}/{id_user}', 'NotificationController@readNotification');
});
/* Create by Rajesh Rathod */
$router->group(['prefix' => '/member'], function ($router) {
    $router->get('/get-member/{role}', 'MemberController@getMember');
    $router->get('/get-my-doctor-list/{id}', 'MemberController@getMydoctorlist');
    $router->post('/getUserDetails', 'MemberController@getUserDetails');
});
$router->post('/register', 'Auth\RegisterController@register');
$router->post('/forget-password', 'Auth\ForgetPasswordController@generate_new_password');
$router->post('/change-password', 'Auth\ChangPasswordController@new_password');
$router->post('/updata-profile', 'Auth\UpdataProfileController@updataprofile');

$router->post('/updata-profile', 'Auth\UpdataProfileController@updataprofile');
$router->post('/select-profile', 'Auth\UpdataProfileController@selectprofile');
$router->post('/insert-dailydata', 'Auth\DailydataController@insertprofile');
$router->post('/select-dailydata', 'Auth\DailydataController@selectdailydata');
$router->post('/updata-surasolepressure', 'Auth\SurasoleController@updatesurasolepressure');
$router->post('/select-surasolepressure', 'Auth\SurasoleController@selectsurasolepressure');
$router->post('/updata-surasolebalance', 'Auth\SurasoleController@updatesurasolebalance');
$router->post('/select-surasolebalance', 'Auth\SurasoleController@selectsurasolebalance');
$router->post('/updata-surasolesensor', 'Auth\SurasoleController@updatesurasolesensor');
$router->post('/select-surasolesensor', 'Auth\SurasoleController@selectsurasolesensor');
$router->post('/updata-surasoleleftstride', 'Auth\SurasoleController@updatesurasoleleftstride');
$router->post('/select-surasoleleftstride', 'Auth\SurasoleController@selectsurasoleleftstride');
$router->post('/updata-surasolerightstride', 'Auth\SurasoleController@updatesurasolerightstride');
$router->post('/select-surasolerightstride', 'Auth\SurasoleController@selectsurasolerightstride');
$router->post('/updata-surasolewing', 'Auth\SurasoleController@updatesurasolewing');
$router->post('/select-surasolewing', 'Auth\SurasoleController@selectsurasolewing');
$router->post('/select-dashboard', 'Auth\DashboardController@selectdashboard');
$router->post('/loginfacebook', 'Auth\AuthController@authenticatefacebook');

$router->post('/addjson', 'Auth\SurasoleController@getDataFromJson');
$router->post('/profile', 'Auth\SurasoleController@upDateProfile');
$router->get('/pic/{path}', 'Auth\SurasoleController@getProfilePicture');
$router->post('/pic/path', 'Auth\SurasoleController@getProfilePath');
$router->post('/record', 'Auth\SurasoleController@getRecordData');


$router->post('/addDevice', 'MemberController@addDevice');
$router->post('/testNotification', 'MemberController@testNotification');
$router->post('/insertChannel', 'ChatController@insertChannel');
$router->post('/uploadFile', 'ChatController@uploadFile');
$router->get('/channelList/{id}', 'ChatController@channelList');
$router->post('/messageNotification', 'ChatController@messageNotification');
//GameDatabase
$router->post('/gamerunnermaze', 'GameController@gamerunnermaze');
$router->post('/gamerunnermazelist', 'GameController@gamerunnermazelist');
$router->post('/addUserInsert', 'UserListController@addUserInsert');
$router->post('/setgame', 'GameController@Insert');
$router->post('/querygame', 'GameController@Query');

$router->post('/levelgame', 'GameController@Level');

$router->group(
    ['middleware' => 'jwt.auth'],
    function () use ($router) {
        $router->get('users', function () {
            $users = \App\Member::all();
            return response()->json($users);
        });
    }
);

$router->get('/',  function () {
    return '
    <html lang="en">
<head>
  <title> SURATEC </title>	
  <meta charset="UTF-8">	
<style>  
 h1{  
  color: white;  
  background-color: #2d9488;  
  padding: 5px;  
 }  
 h2{  
 color: #5bafa0;
 }  
</style>  
</head>  

<body>  
<center><h1> SURATEC API</h1> 
<h2> Hello word<br>SURATEC<br><br><a href="https://www.suratec.co.th/">กลับสู่หน้าหลัก</a></h2></center>
</body>  
</html> ';
});

// $router->group(['prefix' => '/test'], function ($router) { // แบบไม่เช็ค token
$router->group(['prefix' => '/test', 'middleware' => 'jwt.auth'], function ($router) {
    $router->post('/',  function () use ($router) {
        return 'It Work!';
    });
});


$router->group(['prefix' => '/api', 'middleware' => 'jwt.auth'], function ($router) {
    // $router->get('/gps/all',  'GpsController@all');
    // $router->post('/gps/add-multiple',  'GpsController@addMultiple');
});

/*$router->group(['prefix' => '/api'], function ($router) {
    //$router->get('/gps/all',  'GpsController@all');
   //$router->post('/gps/find',  'GpsController@gps_history');
});*/

/*$router->group(['prefix' => '/api/problem/all'], function ($router) {
    //$router->get('/',  'ProblemController@all');
});*/

// Send Email
// $router->get('/sendbasicemail','MailController@basic_email');
//$router->post('/forget-password', 'Auth\ForgetPasswordController@generate_new_password');
// $router->get('/sendattachmentemail','MailController@attachment_email');

//$router->post('/send-parcel', 'Auth\SendparcelController@sendparcel');

//$router->get('/package', 'Auth\PackageController@package');
//$router->post('/packageid', 'Auth\PackageController@packageid');
//$router->post('/over_package', 'Auth\PackageController@over_package');

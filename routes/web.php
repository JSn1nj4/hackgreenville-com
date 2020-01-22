<?php

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

use App\Models\User;

Route::get('/', 'HomeController@index');

Route::get('/calendar', 'CalendarController@index')->name('calendar.index');
Route::get('/events', 'EventsController@index')->name('events.index');
Route::get('/orgs', 'OrgsController@index')->name('orgs.index');
Route::get('/about', 'HomeController@about')->name('about');

Route::get('/join-slack', 'SlackController@join')->name('join-slack');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/styles', 'StyleController@index')->name('styles.index');

Route::get('test/notification/request', function(){
    // Get all the users who approve slack. Should be one
    $users = User::whereIs('slack_approver')->get();

    // loop all the users who receive this request and notify them using their preferences.
    $users->map(function(User $user){
        $user->notify(new \App\Notifications\RequestedNotification('test', 'test@test.com', 'slack'));
    });
});

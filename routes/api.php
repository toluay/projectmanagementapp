<?php

use App\Http\Resources\UpcomingTaskResource;
use App\Models\Today;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Upcoming;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// ** Upcoming Tasks *//
Route::get("/upcoming", function(){
    $upcoming=Upcoming::all();

    return UpcomingTaskResource::collection($upcoming);
});
//Add A new TASK 
Route::post('/Upcoming', function( Request  $request){
    return Upcoming::create([
        'title'=>$request->title,
        'taskId'=>$request->taskId,
        'waiting'=>$request->waiting,

    ]);
});
#delete upcoming request 
Route::delete('/upcomming/{taskId}',function($taskId){
 DB::table('upcomings')->where('taskId', $taskId)->delete();

 return 204;
} );

//* Today task */
Route::post('/dailytask', function(Request $request){
    return Today::create([
        'id'=>$request->id,
        'title'=>$request->title,
        'taskId'=> $request->taskId
    ]);
});

//Delete Today Task */

Route::delete('dailytask/{taskId}', function($taskId){
 DB::table('todays')->where('taskId',$taskId)->delete();
 return 204;
});
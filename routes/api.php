<?php


use App\Http\Controllers\AdminController;
use App\Models\Level;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/subjects', function(){
    // get all the subjects
    $subjects  = Subject::get(['id','name','val']);
    return response()->json($subjects);
});
Route::get('/levels', function(){
    // get all the educational levels
    $levels  = Level::get(['id','name','val']);
    return response()->json($levels);
});

Route::prefix('/admin/model-test')->group(function(){
    Route::controller(AdminController::class)->group(function(){
        Route::post('/add', 'model_test_add');
        Route::get('/get', 'all_model_tests');
        Route::get('/get/{id}', 'model_test');
        Route::post('/update/{id}', 'update_model_test');

        Route::get('/{id}/questions/get', 'get_model_test_questions');
        Route::post('/{id}/questions/add', 'add_model_test_question');
    });
});


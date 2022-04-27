<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminModelTestPackageController;
use App\Http\Controllers\AdminQuestionBankController;
use App\Http\Controllers\AuthController;
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
Route::post('/image/upload', function(Request $request){
    $request->validate([
        'file' => 'required|mimes:jpg,jpeg,png,webp|max:5048'
    ]);
    if($request->file()) {
        $file_name = time().'_'.$request->file->getClientOriginalName();
        $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');

        $file_path = '/storage/'.$file_path;

        return response()->json(['success'=>'File uploaded successfully.', 'file_path' => $file_path]);
    }
});

Route::post('/check-phone-verification', [AuthController::class, 'check_verification']);

Route::prefix('/admin/model-test')->group(function(){
    Route::controller(AdminController::class)->group(function(){
        Route::post('/add', 'model_test_add');
        Route::get('/get', 'all_model_tests');
        Route::get('/get/{id}', 'model_test');
        Route::post('/update/{id}', 'update_model_test');
        Route::post('/delete/{id}', 'delete_model_test');

        Route::get('/{id}/questions/get', 'get_model_test_questions');
        Route::post('/{id}/questions/add', 'add_model_test_question');
        Route::post('/{model_test_id}/questions/{question_id}/edit', 'edit_model_test_question');
        Route::post('/{model_test_id}/questions/{question_id}/delete', 'delete_model_test_question');
    });
});

Route::prefix('/admin/question-bank')->group(function(){
    Route::controller(AdminQuestionBankController::class)->group(function(){
        Route::post('/add', 'question_bank_add');
        Route::get('/get', 'all_question_banks');
        Route::get('/get/{id}', 'question_bank');
        Route::post('/update/{id}', 'update_question_bank');
        Route::post('/delete/{id}', 'delete_question_bank');

        Route::get('/{id}/chapters/get', 'get_question_bank_chapters');
        Route::post('/{id}/chapters/add', 'add_question_bank_chapter');
        Route::get('/{question_bank_id}/chapters/{chapter_id}/get', 'get_chapter');
        Route::post('/{question_bank_id}/chapters/{chapter_id}/edit', 'edit_question_bank_chapter');
        Route::post('/{question_bank_id}/chapters/{chapter_id}/delete', 'delete_question_bank_chapter');

        Route::get('/{question_bank_id}/chapters/{chapter_id}/questions/get', 'get_chapter_questions');
        Route::post('/{question_bank_id}/chapters/{chapter_id}/questions/add', 'add_chapter_question');
        Route::post('/{question_bank_id}/chapters/{chapter_id}/questions/{question_id}/edit', 'edit_chapter_question');
        Route::post('/{question_bank_id}/chapters/{chapter_id}/questions/{question_id}/delete', 'delete_chapter_question');
    });
});

Route::prefix('/admin/model-test-package/')->group(function(){
   Route::controller(AdminModelTestPackageController::class)->group(function(){
       Route::get('/get', 'all_model_test_packages');
       Route::get('/get/{id}', 'model_test_package');
       Route::post('/add', 'model_test_package_add');
       Route::post('/update/{id}', 'update_model_test_package');
       Route::post('/delete/{id}', 'delete_model_test_package');

       Route::get('/{id}/model-tests', 'model_tests');
       Route::get('/{id}/question-banks', 'question_banks');
   });
});

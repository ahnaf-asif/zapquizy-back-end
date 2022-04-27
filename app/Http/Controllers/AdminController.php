<?php

namespace App\Http\Controllers;

use App\Models\ModelTest;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Exception;

class AdminController extends Controller
{
    public function model_test_add(Request $req){
        $new_model_test = new ModelTest;
        $new_model_test -> name = $req->name;
        $new_model_test -> duration = $req -> duration;
        $new_model_test -> level_id = $req -> level_id;
        $new_model_test -> subject_id = $req -> subject_id;
        $new_model_test -> model_test_package_id = $req -> model_test_package_id;

        $new_model_test -> save();

        return ModelTest::with('subject')->with('level')->orderBy('id', 'desc')->get();
    }
    public function all_model_tests(){
        return ModelTest::with('subject')->with('level')->orderBy('id', 'desc')->get();
    }
    public function model_test($id){
        return ModelTest::with('subject')->with('level')->find($id);
    }
    public function update_model_test($id, Request $mt){
        $model_test = ModelTest::find($id);

        $model_test -> name = $mt -> name;
        $model_test -> duration = $mt -> duration;
        $model_test -> subject_id = $mt -> subject_id;
        $model_test -> level_id = $mt -> level_id;

        $model_test -> save();

        return ModelTest::with('subject')->with('level')->find($id);
    }
    public function delete_model_test($id){
        // all associated questions and options will be deleted too
        $model_test = ModelTest::find($id);
        if($model_test){
            foreach($model_test->questions as $ques){
                foreach($ques->options as $opt){
                    $opt->delete();
                }
                $ques->delete();
            }
            $model_test->delete();
        }
        return ModelTest::with('subject')->with('level')->orderBy('id', 'desc')->get();
    }
    public function get_model_test_questions($id){
        return ModelTest::find($id)->questions;
    }
    public function add_model_test_question($id, Request $req){
        $question = new Question;

        $question->model_test_id = $id;
        $question->name = $req->name;
        $question->type = $req->type;
        $question->save();
//        return ModelTest::find($id)->questions;
        foreach($req->options as $option){
            $new_op = new Option;
            $new_op -> name = $option['name'];
            $new_op -> correct = $option['correct'];
            $new_op -> question_id = $question->id;

            $new_op -> save();
        }
        return ModelTest::find($id)->questions;
    }
    public function edit_model_test_question($model_test_id, $question_id, Request $req){
        $question = Question::find($question_id);

        if(!$question){
            return response()->json(['error'=>'no data found']);
        }
        $question->name = $req->name;
        $question->type = $req->type;
        $question->save();

        foreach($question->options as $option){
            $option->delete();
        }
        foreach($req->options as $option){
            $new_op = new Option;
            $new_op -> name = $option['name'];
            $new_op -> correct = $option['correct'];
            $new_op -> question_id = $question->id;

            $new_op -> save();
        }
        return response()->json(['status'=>'ok']);
    }
    public function delete_model_test_question($model_test_id, $question_id){
        $question = Question::find($question_id);
        if(!$question){
            return response()->json(['error'=>'no data found']);
        }
        foreach($question->options as $option){
            $option->delete();
        }
        $question->delete();
        return response()->json(['status'=>'ok']);
    }
}

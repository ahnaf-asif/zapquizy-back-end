<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Option;
use App\Models\Question;
use App\Models\QuestionBank;
use Illuminate\Http\Request;

class AdminQuestionBankController extends Controller
{
    public function all_question_banks(){
        return QuestionBank::with('subject')->with('level')->orderBy('id', 'desc')->get();
    }
    public function question_bank_add(Request $req){
        $new_question_bank = new QuestionBank;
        $new_question_bank -> name = $req->name;
        $new_question_bank -> level_id = $req -> level_id;
        $new_question_bank -> subject_id = $req -> subject_id;

        $new_question_bank -> save();

        return QuestionBank::with('subject')->with('level')->orderBy('id', 'desc')->get();
    }
    public function delete_question_bank($id){
        // all associated questions and options will be deleted too
        $question_bank = QuestionBank::find($id);
        if($question_bank){
            foreach($question_bank->chapters as $chap){
                foreach($chap->questions as $ques){
                    foreach($ques->options as $opt){
                        $opt->delete();
                    }
                    $ques->delete();
                }
                $chap->delete();
            }
            $question_bank->delete();
        }
        return QuestionBank::with('subject')->with('level')->orderBy('id', 'desc')->get();
    }
    public function question_bank($id){
        return QuestionBank::with('subject')->with('level')->find($id);
    }
    public function update_question_bank($id, Request $req){
//        return $req;
        $qb = QuestionBank::find($id);
        $qb -> name = $req->name;
        $qb -> level_id = $req -> level_id;
        $qb -> subject_id = $req -> subject_id;

        $qb -> save();
        return QuestionBank::with('subject')->with('level')->find($id);
    }
    public function get_question_bank_chapters($id){
        $qb = QuestionBank::find($id);
        return $qb->chapters;
    }
    public function add_question_bank_chapter($id, Request $req){
        $chapter = new Chapter;
        $chapter->name = $req->name;
        $chapter->question_bank_id = $id;
        $chapter->save();
        return QuestionBank::find($id)->chapters;
    }
    public function delete_question_bank_chapter($question_bank_id, $chapter_id){
        $chap = Chapter::find($chapter_id);
        foreach($chap->questions as $ques){
            foreach($ques->options as $opt){
                $opt->delete();
            }
            $ques->delete();
        }
        $chap->delete();
        return QuestionBank::find($question_bank_id)->chapters;
    }
    public function get_chapter($question_bank_id, $chapter_id){
        return Chapter::find($chapter_id);
    }
    public function get_chapter_questions($question_bank_id, $chapter_id){
        return Chapter::find($chapter_id)->questions;
    }
    public function edit_question_bank_chapter($question_bank_id, $chapter_id, Request $req){
        $chap = Chapter::find($chapter_id);
        $chap -> name = $req -> name;
        $chap -> save();
        return $chap;
    }
    public function add_chapter_question($question_bank_id, $chapter_id, Request $req){
        $question = new Question;

        $question->chapter_id = $chapter_id;
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
        return Chapter::find($chapter_id)->questions;
    }
    public function edit_chapter_question($question_bank_id, $chapter_id, $question_id, Request $req){
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
    public function delete_chapter_question($question_bank_id, $chapter_id, $question_id){
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

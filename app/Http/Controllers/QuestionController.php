<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Question;
use App\Level;
use Auth;
use DB;

class QuestionController extends Controller
{
    public function checkAnswer(Request $request)
    {
    	$User=Auth::user();
    	$answer=$request->answer;
    	$question=Question::find(($User->level->level)+1);
    	if($answer==$question->answer)
    	{
    		$level=$User->level;
            $level->level++;
            $level->save();

    		return 0;
    	}
    	return 1;
    }
}

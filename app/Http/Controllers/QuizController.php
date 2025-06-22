<?php
// app/Http/Controllers/QuizController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class QuizController extends Controller
{
    public function home()
    {
        return view('home');
    }
    
    public function startQuiz(Request $request)
    {
        $difficulty = $request->input('difficulty', 'medium');
        $isTraining = $request->boolean('training');
        
        if ($isTraining) {
            return redirect()->route('training');
        }
        
        $questionCount = $this->getQuestionCount($difficulty);
        $optionCount = $this->getOptionCount($difficulty);
        
        $questions = $this->generateQuestions($questionCount, $optionCount);
        
        session([
            'quiz' => [
                'questions' => $questions,
                'current' => 0,
                'score' => 0,
                'difficulty' => $difficulty,
                'start_time' => now()
            ]
        ]);
        
        return redirect()->route('quiz');
    }
    
    public function showQuiz()
    {
        $quiz = session('quiz');
        
        if (!$quiz || $quiz['current'] >= count($quiz['questions'])) {
            return redirect()->route('results');
        }
        
        $question = $quiz['questions'][$quiz['current']];
        
        return view('quiz', [
            'question' => $question,
            'questionNumber' => $quiz['current'] + 1,
            'totalQuestions' => count($quiz['questions']),
            'score' => $quiz['score'],
            'difficulty' => $quiz['difficulty']
        ]);
    }
    
    public function submitAnswer(Request $request)
    {
        $quiz = session('quiz');
        $answer = $request->input('answer');
        
        if ($quiz && $quiz['current'] < count($quiz['questions'])) {
            $currentQuestion = $quiz['questions'][$quiz['current']];
            
            if ($answer === $currentQuestion['correct']) {
                $quiz['score']++;
            }
            
            $quiz['current']++;
            session(['quiz' => $quiz]);
        }
        
        return redirect()->route('quiz');
    }
    
    public function results()
    {
        $quiz = session('quiz');
        
        if (!$quiz) {
            return redirect()->route('home');
        }
        
        $score = $quiz['score'];
        $total = count($quiz['questions']);
        $percentage = $total > 0 ? round(($score / $total) * 100) : 0;
        
        // Calculate time taken
        $timeElapsed = null;
        if (isset($quiz['start_time'])) {
            $timeElapsed = now()->diffInSeconds($quiz['start_time']);
        }
        
        session()->forget('quiz');
        
        return view('results', [
            'score' => $score,
            'total' => $total,
            'percentage' => $percentage,
            'difficulty' => $quiz['difficulty'] ?? 'medium',
            'timeElapsed' => $timeElapsed
        ]);
    }
    
    public function training()
    {
        $countries = Country::orderBy('name')->get();
        return view('training', compact('countries'));
    }
    
    private function getQuestionCount($difficulty)
    {
        return match($difficulty) {
            'easy' => 5,
            'medium' => 10,
            'hard' => 15,
            default => 10
        };
    }
    
    private function getOptionCount($difficulty)
    {
        return match($difficulty) {
            'easy' => 3,
            'medium' => 4,
            'hard' => 5,
            default => 4
        };
    }
    
    private function generateQuestions($count, $optionCount)
    {
        $countries = Country::inRandomOrder()->take($count)->get();
        $allCountries = Country::all();
        $questions = [];
        
        foreach ($countries as $country) {
            // Get wrong options that are different from the correct answer
            $wrongOptions = $allCountries
                ->where('code', '!=', $country->code)
                ->where('capital', '!=', $country->capital)
                ->pluck('capital')
                ->unique()
                ->random(min($optionCount - 1, $allCountries->count() - 1))
                ->toArray();
            
            $options = array_merge([$country->capital], $wrongOptions);
            shuffle($options);
            
            $questions[] = [
                'question' => "What is the capital of {$country->name}?",
                'options' => $options,
                'correct' => $country->capital,
                'country' => $country->name,
                'country_code' => $country->code,
                'flag_url' => $country->flag_url
            ];
        }
        
        return $questions;
    }
}
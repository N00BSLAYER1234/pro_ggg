<!-- resources/views/home.blade.php -->
@extends('layout')

@section('title', 'Countries Quiz - Home')

@section('content')
<div class="text-center">
    <h1>Countries Quiz</h1>
    <p class="subtitle">Test your geographical knowledge!</p>

    <form action="{{ route('start.quiz') }}" method="POST" style="margin-top: 30px;">
        @csrf
        <div class="form-group">
            <label for="difficulty">Choose difficulty level:</label>
            <select name="difficulty" id="difficulty">
                <option value="easy">Easy (5 questions, 3 options)</option>
                <option value="medium" selected>Medium (10 questions, 4 options)</option>
                <option value="hard">Hard (15 questions, 5 options)</option>
            </select>
        </div>

        <div class="form-group text-center">
            <button type="submit" name="training" value="0" class="btn">
                 Start quiz
            </button>
            <button type="submit" name="training" value="1" class="btn btn-secondary">
                 Training mode
            </button>
        </div>
    </form>

    <div style="margin-top: 40px; padding: 20px; background: rgba(255,255,255,0.1); border-radius: 10px;">
        <h3>How to Play:</h3>
        <div style="text-align: left; margin: 20px 0;">
            <p>• <strong>Quiz mode:</strong> Answer multiple choice questions about country capitals</p>
            <p>• <strong>Training Mode:</strong> Study countries and their capitals wirh flashcards</p>
            <p>• <strong>Difficulty:</strong> Choose from easy (3 options) to hard (5 options)</p>
            <p>• <strong>Scoring:</strong> Get points for each correct answer</p>
        </div>
    </div>
</div>
@endsection

<!-- resources/views/results.blade.php -->
@extends('layout')

@section('title', 'Quiz Results')

@section('content')
<div class="text-center">
    <h1> Quiz Complete!</h1>

    <div class="score-display" style="margin: 30px 0;">
        <div class="score-circle">
            {{ $percentage }}%
        </div>
        <p style="font-size: 1.3em; margin-top: 20px;">
            {{ $score }} out of {{ $total }} correct answers
        </p>
    </div>

    <div class="performance-feedback" style="margin: 30px 0;">
        @if($percentage >= 90)
            <div class="feedback excellent">
                 <strong>Excellent!</strong>
            </div>
        @elseif($percentage >= 70)
            <div class="feedback good">
                 <strong>Very goose!</strong>
            </div>
        @elseif($percentage >= 50)
            <div class="feedback average">
                 <strong>Not bad!</strong>
            </div>
        @else
            <div class="feedback poor">
                 <strong>Keep learning!</strong>
            </div>
        @endif
    </div>

    <div class="stats-grid">
        <div class="stat-item">
            <div class="stat-number">{{ $score }}</div>
            <div class="stat-label">Correct</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ $total - $score }}</div>
            <div class="stat-label">Wrong</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ ucfirst($difficulty) }}</div>
            <div class="stat-label">Level</div>
        </div>
        @if($timeElapsed)
        <div class="stat-item">
            <div class="stat-number">{{ gmdate('i:s', $timeElapsed) }}</div>
            <div class="stat-label">Time</div>
        </div>
        @endif
    </div>

    <div style="margin-top: 40px;">
        <a href="{{ route('home') }}" class="btn">
             Play Again
        </a>
        <a href="{{ route('training') }}" class="btn btn-secondary">
             Study Mode
        </a>
    </div>
</div>

@push('styles')
<style>
    .score-circle {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: conic-gradient(
            #4CAF50 0deg,
            #4CAF50 {{ $percentage * 3.6 }}deg,
            rgba(255,255,255,0.2) {{ $percentage * 3.6 }}deg
        );
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5em;
        font-weight: bold;
        margin: 0 auto;
        color: white;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 20px;
        margin: 30px 0;
    }

    .stat-item {
        background: rgba(255,255,255,0.1);
        padding: 20px;
        border-radius: 10px;
        text-align: center;
    }

    .stat-number {
        font-size: 2em;
        font-weight: bold;
        color: #4CAF50;
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 0.9em;
        opacity: 0.8;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .feedback {
        padding: 20px;
        border-radius: 10px;
        font-size: 1.2em;
        margin: 20px 0;
    }

    .feedback.excellent {
        background: rgba(76, 175, 80, 0.2);
        border: 2px solid #4CAF50;
    }

    .feedback.good {
        background: rgba(255, 193, 7, 0.2);
        border: 2px solid #FFC107;
    }

    .feedback.average {
        background: rgba(33, 150, 243, 0.2);
        border: 2px solid #2196F3;
    }

    .feedback.poor {
        background: rgba(244, 67, 54, 0.2);
        border: 2px solid #f44336;
    }
</style>
@endpush
@endsection

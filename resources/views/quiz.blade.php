
@extends('layout')

@section('title', 'Quiz Question')

@section('content')
<div class="text-center">
    <h2> Countries Quiz</h2>

    <div class="stats">
        <span>Question {{ $questionNumber }} of {{ $totalQuestions }}</span>
        <span>Score: {{ $score }}</span>
    </div>

    <div class="progress-bar">
        <div class="progress-fill" style="width: {{ ($questionNumber / $totalQuestions) * 100 }}%"></div>
    </div>

    <div style="margin: 30px 0;">
        @if(isset($question['flag_url']))
            <img src="{{ $question['flag_url'] }}"
                 alt="Flag of {{ $question['country'] }}"
                 class="flag-img"
                 onerror="this.style.display='none'">
        @endif
    </div>

    <div style="margin: 30px 0;">
        <h3>{{ $question['question'] }}</h3>
    </div>

    <form action="{{ route('submit.answer') }}" method="POST" id="quizForm">
        @csrf
        <div style="margin: 20px 0;">
            @foreach($question['options'] as $index => $option)
                <div class="option-wrapper" style="margin: 12px 0;">
                    <label class="option-label" onclick="selectOption(this)">
                        <input type="radio" name="answer" value="{{ $option }}" required style="display: none;">
                        <div class="option-content">
                            <span class="option-letter">{{ chr(65 + $index) }}.</span>
                            <span class="option-text">{{ $option }}</span>
                        </div>
                    </label>
                </div>
            @endforeach
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" id="submitBtn" class="btn" disabled>
                Submit answer
            </button>
        </div>
    </form>
</div>

@push('styles')
<style>
    .option-label {
        display: block;
        padding: 15px 20px;
        background: rgba(255,255,255,0.1);
        border: 2px solid transparent;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: left;
    }

    .option-label:hover {
        background: rgba(255,255,255,0.2);
        border-color: rgba(255,255,255,0.3);
        transform: translateX(5px);
    }

    .option-label.selected {
        background: rgba(76, 175, 80, 0.3);
        border-color: #4CAF50;
        transform: translateX(5px);
    }

    .option-content {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .option-letter {
        font-weight: bold;
        color: #4CAF50;
        min-width: 25px;
    }

    .option-text {
        flex: 1;
        font-size: 16px;
    }

    #submitBtn:disabled {
        background: #666;
        cursor: not-allowed;
        transform: none;
    }

    #submitBtn:disabled:hover {
        background: #666;
        transform: none;
        box-shadow: none;
    }
</style>
@endpush

@push('scripts')
<script>
    function selectOption(element) {

        document.querySelectorAll('.option-label').forEach(label => {
            label.classList.remove('selected');
        });


        element.classList.add('selected');
        element.querySelector('input[type="radio"]').checked = true;


        document.getElementById('submitBtn').disabled = false;
    }
    document.addEventListener('keydown', function(e) {
        if (e.key >= '1' && e.key <= '5') {
            const optionIndex = parseInt(e.key) - 1;
            const options = document.querySelectorAll('.option-label');
            if (options[optionIndex]) {
                selectOption(options[optionIndex]);
            }
        }
    });
</script>
@endpush
@endsection

@extends('components.layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h1>{{ $question->title }}</h1>
                            <div class="ml-auto">
                                <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Back to all questions</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="media">
                        <div class="d-flex flex-column vote-controls">
                            <a title="This question is useful" class="vote-up">
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <span class="votes-count">1230</span>
                            <a title="This question is not useful" class="vote-down off">
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            <a title="Click to mark as favorite question (click again to undo)" class="favorite mt-2 {{ Auth::guest() ? 'off' : ($question->is_favorited ? 'favorited' : '') }}"
                                onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $question->id }}').submit(); ">
                                <i class="fas fa-star fa-2x"></i>
                                <span class="favorites-count">{{ $question->favorites_count }}</span>
                            </a>
                            <form id="favorite-question-{{ $question->id }}" action="/questions/{{ $question->id }}/favorites" method="POST" style="display: none;">
                                @csrf
                                @if ($question->is_favorited)
                                @method('DELETE')
                                @endif
                            </form>
                        </div>
                        <div class="media-body">
                            {!! e($question->body_html) !!}
                            <div class="row">
                                <div class="col-4"></div>
                                <div class="col-4"></div>
                                <div class="col-4">
                                    <user-info :model="{{ $question }}" label="Asked by"></user-info>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('answers._index', [
    'answers' => $question->answers,
    'answersCount' => $question->answers_count,
    ])
    @include('answers._create')
</div>
@endsection
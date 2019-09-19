@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h1>{{ $question->title }}</h1>
                            <div class="ml-auto">
                                <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Back to all Questions</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {{-- La réponse sous forme de markdown --}}
                        {!! $question->body_html !!}
                        <div class="d-flex justify-content-end">
                            <span class="text-muted">Répondu {{ $question->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="d-flex justify-content-end mt-1">
                            <div class="media">
                                <a href="{{ $question->user->url }}" class="pr-2">
                                    <img src="{{ $question->user->avatar }}" alt="">
                                </a>
                            </div>
                            <div class="media mt-1">
                                <a href="{{ $question->user->url }}">
                                    {{ $question->user->name }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h2>{{ $question->answers_count . " " . Illuminate\Support\Str::plural('Réponse', $question->answers_count) }}</h2>
                            <hr>
                            @foreach ($question->answers as $answer)
                                <div class="media">
                                    <div class="media-body">
                                        {!! $answer->body_html !!}
                                        <!-- ICI J'UTILISE LA CLASSE D-FLEX DE BOOTSTRAP 4 ET JUSTIFY-CONTENT-END
                                        POUR METTRE À LA FIN AU LIEU DE FLOAT-RIGHT -->
                                        <div class="d-flex justify-content-end">
                                            <span class="text-muted">Répondu {{ $answer->created_at->diffForHumans() }}</span>
                                        </div>
                                        <div class="d-flex justify-content-end mt-1">
                                            <div class="media">
                                                <a href="{{ $answer->user->url }}" class="pr-2">
                                                    <img src="{{ $answer->user->avatar }}" alt="">
                                                </a>
                                            </div>
                                            <div class="media mt-1">
                                                <a href="{{ $answer->user->url }}">
                                                    {{ $answer->user->name }}
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <hr>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
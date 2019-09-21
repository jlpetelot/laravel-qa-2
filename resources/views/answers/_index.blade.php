<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{ $answersCount . " " . Illuminate\Support\Str::plural('Réponse', $answersCount) }}</h2>
                    <hr>

                    @include ('layouts._messages')

                    @foreach ($answers as $answer)
                        <div class="media">
                            <div class="d-fex flex-column vote-controls">
                                <a title="This answer is useful" class="vote-up">
                                    <i class="fas fa-caret-up fa-3x"></i>
                                </a>
                                <span class="votes-count">1230</span>
                                <a title="This answer is not useful" class="vote-down off">
                                    <i class="fas fa-caret-down fa-3x"></i>
                                </a>
                                <a title="Mark this answer as best one" class="vote-accepted mt-2">
                                    <i class="fas fa-check fa-2x"></i>
                                </a>
                            </div>

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

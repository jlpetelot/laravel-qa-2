<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3>Votre réponse</h3>
                </div>

                @if (Auth::check())
                    <form action="{{ route('questions.answers.store', $question->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control {{ $errors->has('body') ? 'is-invalid' : ''}}" name="body" rows="7"></textarea>
                            @if ($errors->has('body'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <button class="btn btn-lg btn-outline-primary" type="submit">Submit</button>
                        </div>
                    </form>
                @else
                    <span class="text-danger ml-auto">* Svp, identifiez-vous afin de poster une réponse.</span>
                @endif

            </div>
        </div>
    </div>
</div>

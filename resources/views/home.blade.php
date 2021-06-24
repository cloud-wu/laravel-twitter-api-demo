@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-lg-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Post</div>

                <div class="card-body">
                    <form method="post" action="{{ route('tweet.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Message</label>
                            <input name="message" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">tweets</div>

                <div class="card-body">

                    <div class="list-group">
                        @foreach($tweets as $tweet)

                            <div class="list-group-item list-group-item-action flex-column align-items-start">
                                <div>
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ $tweet->user->name }}</h5>
                                        <small>{{ $tweet->created_at }}</small>
                                    </div>
                                    <p class="mb-1">{{ $tweet->text }}</p>
                                </div>
                            </div>

                        @endforeach

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

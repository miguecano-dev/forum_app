@extends('layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="mb-3">
                <a href="{{ route('home') }}">Return to Home</a>
            </div>
            <div class="col-lg-12 mb-2">
                <!-- Post list-->
                    <section>
                        <div>
                            @if ($post->image && \Illuminate\Support\Facades\Storage::has($post->image))
                                <img src="{{ Storage::url($post->image) }}" width="100%" height="320" alt="">
                            @elseif($post->image)
                                <img src="{{ $post->image }}" width="100%" height="320" alt="">
                            @endif
                        </div>
                        <div>
                            <div class="card row-hover pos-relative py-3 px-3 mb-3 border-warning border-top-0 border-right-0 border-bottom-0 rounded-0">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <h5>
                                            <span href="#" class="text-primary">{{ $post->title }}</span>
                                        </h5>
                                        <div class="text-sm"><p>{{ $post->problem }}</p><span class="op-6">Posted</span> <a class="text-black" href="#">{{ $post->created_at->diffForHumans() }}</a> <span class="op-6">ago by</span> <a class="text-black" href="#">{{ $post->user->username }}</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="mb-3">
                        <div class="row d-flex flex-row mb-3">
                            <div class="col-md-6">
                                <h3>Responses</h3>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end">
                                @if(auth()->user()?->role == 'admin')
                                    <a class="btn btn-primary" id="add_response">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus mr-2">
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>
                                        New Response
                                    </a>
                                @endif
                            </div>
                        </div>
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="card mb-3 p-5" id="new-response-form" >
                            <h3>Create Response</h3>
                            <form method="POST" action="{{ route('response.store') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}" />                         
                                <div class="form-group row mb-3">
                                    <label for="response" class="col-md-4 col-form-label text-md-right">Response</label>
                                    <div class="col-md-6">
                                        <textarea name="response" id="response" class="form-control  @error('response') is-invalid @enderror" name="response" value="{{ old('response') }}" required autocomplete="response"></textarea>
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-3">
                                    <label for="image" class="col-md-4 col-form-label text-md-right">Image</label>
                                    <div class="col-md-6">
                                        <input type="file" class="custom-file-input" name="image" id="image" multiple="" />
                                        <label class="custom-file-label" for="image">Attachment</label>
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @foreach ($responses as $response)
                            <div class="card ml-3 mb-3 row-hover pos-relative py-3 px-3 border-primary border-top-0 border-right-0 border-bottom-0 rounded-0">
                                <div class="row align-items-center">
                                    <div class="col-md-12 ml-1 mb-3 mb-sm-0 d-flex justify-content-between">
                                        <div class="text-sm ps-3">
                                            <p class="pl-3">{{ $response->response }}</p><span class="op-6">Posted</span> <a class="text-black" href="#">{{ $response->created_at->diffForHumans() }}</a> <span class="op-6">ago by</span> <a class="text-black" href="#">username</a>
                                        </div>
                                        <div class="">
                                            @if ($response->image && \Illuminate\Support\Facades\Storage::has($response->image))
                                                <img src="{{ Storage::url($response->image) }}" width="200" height="150" alt="">
                                            @elseif($response->image)
                                                <img src="{{ $response->image }}" width="200" height="150" alt="">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </section>
            </div>
            <div id="pagination-list" class="mb-3">
                <div id="show-information">
                    Showing {{ $responses->firstItem() }} to {{ $responses->lastItem() }}
                    of total {{$responses->total()}} entries
                </div>
                <div id="links-list">
                    {{ $responses->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $("#add_response").click(function(){
                $("#new-response-form").toggle();
            });
        });
    </script>
@endsection
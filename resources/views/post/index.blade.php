@extends('layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-2">
                <div class="row text-left mb-3 d-flex align-items-center">
                    <div class="col-lg-6 mb-3 mb-sm-0">
                        @if(auth()->user()?->role == 'admin')
                            <a class="btn btn-primary" id="add_post">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus mr-2">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                New Post
                            </a>
                        @endif
                    </div>
                    <div class="col-lg-6 text-lg-right">
                        <div class="form-control form-control-lg bg-white bg-op-9 ml-auto text-sm w-lg-100">
                            <form method="GET" class="d-flex flex-row" action="{{ route('post.index') }}">
                                @csrf
                                <input id="search" type="text" class="form-control form-control-lg bg-white bg-op-9 ml-auto text-sm w-lg-50" placeholder="Search..." name="search" value="{{ old('search') }}" autofocus>
                                <button type="submit" class="btn btn-primary ms-3">Search</button>
                            </form>
                        </div>
                    </div>
                </div>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="card mb-3 p-5" id="new-post-form" >
                    <h3>Create Post</h3>
                    <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>
                            </div>
                        </div>
                       
                        <div class="form-group row mb-3">
                            <label for="problem" class="col-md-4 col-form-label text-md-right">Problem</label>
                            <div class="col-md-6">
                                <textarea name="problem" id="problem" class="form-control  @error('problem') is-invalid @enderror" name="problem" value="{{ old('problem') }}" required autocomplete="problem"></textarea>
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
                @foreach($posts as $post)
                    <section>
                        <a href="{{route('post.show', ['post' => $post->id ])}}">
                            <div class="card row-hover pos-relative py-3 px-3 mb-3 border-warning border-top-0 border-right-0 border-bottom-0 rounded-0">
                                <div class="row align-items-center">
                                    <div class="col-md-10 mb-3 mb-sm-0">
                                        <h5>
                                            <span href="#" class="text-primary">{{ $post->title }}</span>
                                        </h5>
                                        <div class="text-sm"><p>{{ Str::limit($post->problem, 100) }}</p><span class="op-6">Posted</span> <a class="text-black" href="#">{{ $post->created_at->diffForHumans() }}</a> <span class="op-6">ago by</span> <a class="text-black" href="#">{{ $post->user->username }}</a></div>
                                    </div>
                                    <div class="col-md-2 op-7">
                                        <div class="row text-center op-7">
                                            <div class="col px-1"> <i class="ion-connection-bars icon-1x"></i> <span class="d-block text-sm"><b>5</b> Responses</span> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </section>
                @endforeach
            </div>
            <div id="pagination-list" class="mb-3">
                <div id="show-information">
                    Showing {{ $posts->firstItem() }} to {{ $posts->lastItem() }}
                    of total {{$posts->total()}} entries
                </div>
                <div id="links-list">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $("#add_post").click(function(){
                $("#new-post-form").toggle();
            });
        });
    </script>
@endsection
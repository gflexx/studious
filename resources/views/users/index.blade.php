@extends('layouts.app')

@section('content')

<div class="profile">

    <h4 class="text-white">Profile</h4>
    <div class="text-center">
        <img class="profile-img rounded-circle img-fluid" src="{{ asset('user_images/'.auth()->user()->image) }}" alt="">
        <p class="text-light">{{ auth()->user()->email }}</p>
    </div>
    <hr class="text-white">
    <div class="row">
        <div class="col-md-3">
            <div class="card bg-dark p-2 border px-3">
                <h6 class="text-white">
                    Messages:
                </h6>
                @forelse ($contacts as $contact)
                    <div class="row studio-song rounded mb-2 ">
                        <div class="col-4">
                            <img src="{{ asset('user_images/'. $contact->image) }}" class="small-img rounded-circle img-fluid" alt="">
                        </div>
                        <div class="col-6">
                            <a href="{{ route('chat', $contact->id) }}" style="text-decoration: none">{{ $contact->username }}</a>
                        </div>
                    </div>
                @empty
                    <p class="text-white">No messages yet</p>
                @endforelse
            </div>
            @if (!$studio->count() == 0)
                <div class="card bg-dark border p-2 mt-3">
                    <h6 class="text-white">
                        Studio Session:
                    </h6>
                    <p class="text-white">No request or responses.</p>
                </div>
            @endif

        </div>
        <div class="col">
            <div class="py-2 mb-2">
                <h5 class="text-white">User information</h5>
                <p class="text-info">Username: <span class="text-white">{{ auth()->user()->username }}</span></p>
                <p class="text-info">Email: <span class="text-white">{{ auth()->user()->email }}</span></p>
                <p class="text-info">Created: <span class="text-white">{{ auth()->user()->created_at }}</span></p>
                <div class="mt-3">
                    <a href="{{ route('edit_profile', auth()->user()) }}" class="btn btn-primary">Update Profile</a>
                </div>
            </div>
            <div class="mb-5 py-2">
                <h5 class="text-white">Tracks and Studio</h5>
                <div class="p-2">
                    <a href="{{ route('add_track') }}" class="btn btn-info">Upload Track</a>
                    @if (!$studio->count() == 0)

                        <a href="{{ route('edit_studio', $studio[0]->id) }}" class="btn btn-success">Edit Studio</a>
                        <a href="{{ route('sign_artist', $studio[0]->id) }}" class="btn btn-primary">Studio Signings</a>
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addNoticeModal">Add Notice</button>

                        <div class="modal fade" id="addNoticeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content bg-dark text-white">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Add Notice</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <p>Add notice to be displayed on studio wall.</p>
                                  <div>
                                      <form action="{{ route('create_notice') }}" method="post" class="mt-2" enctype="multipart/form-data">
                                          @csrf
                                          <input type="hidden" name="studio_id" value="{{ $studio[0]->id }}">

                                          <div class="mb-3">
                                            <label for="formFile" class="form-label">Image</label>
                                            <input class="form-control" accept="image/*" name="image" type="file" id="formFile">
                                          </div>

                                          <div class="mb-3">
                                            <label class="text-white" for="text">Text</label>
                                            <textarea name="text" id="text" class="form-control" rows="2"></textarea>
                                          </div>

                                          <button type="submit" class="btn btn-primary btn-sm">Create Notice</button>
                                      </form>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#studioSessionModal">Studio Sessions</button>

                        <div class="modal fade" id="studioSessionModal" tabindex="-1" aria-labelledby="exampleLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content bg-dark text-white">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleLabel">Studio Sessions</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <p>Enable or disable studio session booking</p>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                              </div>
                            </div>
                        </div>
                    @else
                        @if (!$signed_studio)
                            <a href="{{ route('create_studio') }}" class="btn btn-success">Create Studio</a>
                        @endif

                    @endif
                </div>
                <div class="py-2">
                    <h5 class="text-white mt-3 mb-2">Studio</h5>
                    @if($studio->count() == 0)
                        @if ($signed_studio)
                        <div class="card studio-card">
                            <div class="row">
                                <div class="col-3 col-md-2">
                                    <a href="{{ route('show_studio', $signed_studio[0]->id) }}">
                                        <img class="studio-img img-fluid" src="{{ asset($signed_studio[0]->image) }}" alt="">
                                    </a>
                                </div>
                                <div class="col">
                                    <a style="text-decoration: none;" class="h4 text-info" href="{{ route('show_studio', $signed_studio[0]->id) }}">{{ $signed_studio[0]->title }}</a>
                                    <p class="text-info mt-2">About: <span class="text-white">{{ $signed_studio[0]->description }}</span></p>
                                    <p class="text-info mt-1">Created: <span class="text-white">{{ $signed_studio[0]->created_at }}</span></p>
                                    <p class="text-info mt-1">Signings: <span class="text-white">{{ $signed_studio[0]->signings()->count() }}</span></p>
                                </div>
                            </div>
                        </div>
                        @else
                            <p class="text-white">No Studio </p>
                        @endif
                    @else
                        <div class="card studio-card">
                            <div class="row">
                                <div class="col-3 col-md-2">
                                    <a href="{{ route('show_studio', $studio[0]->id) }}">
                                        <img class="studio-img img-fluid" src="{{ asset($studio[0]->image) }}" alt="">
                                    </a>
                                </div>
                                <div class="col">
                                    <a style="text-decoration: none;" class="h4 text-info" href="{{ route('show_studio', $studio[0]->id) }}">{{ $studio[0]->title }}</a>
                                    <p class="text-info mt-2">About: <span class="text-white">{{ $studio[0]->description }}</span></p>
                                    <p class="text-info mt-1">Created: <span class="text-white">{{ $studio[0]->created_at }}</span></p>
                                    <p class="text-info mt-1">Signings: <span class="text-white">{{ $studio[0]->signings()->count() }}</span></p>
                                </div>
                            </div>
                        </div>

                    @endif
                </div>

                <div class="py-2">
                    <h5 class="text-white mt-3 mb-2">Tracks</h5>
                    @if(! $tracks->count() > 0)
                        <p class="text-light">No tracks to show</p>
                    @else
                        <div class="row py-2 g-2">
                            @foreach ($tracks as $track)
                                <div class="col col-md-6">
                                    <div class="card bg-secondary">
                                        <div class="row">
                                            <div class="col-4 col-md-4">
                                                <a href="{{ route('show_track', $track->id) }}">
                                                    <img class="track-image" src="{{ asset($track->image) }}" alt="">
                                                </a>
                                            </div>
                                            <div class="col">
                                                <a style="text-decoration: none;" class="text-info h4" href="{{ route('show_track', $track->id) }}">{{ $track->title }}</a>
                                                <p class="text-dark mt-2">By: <span class="text-light">{{ $track->owner->username }}</span></p>
                                                <p class="text-dark mt-1">Added: <span class="text-light">{{ $track->created_at }}</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>


</div>

@endsection

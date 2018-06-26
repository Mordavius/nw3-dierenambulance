@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach($user as $user)
            <div class="profile">
                <div class="profile-info">
                    {{ $user->name }}
                </div>
                <div class="container">
                  <div class="profile-wrapper">
                    <div class="profile-icon">
                      <img src="/images/email-icon.png">
                    </div>
                    <div class="profile-text">
                      {{ $user->email }}
                    </div>
                  </div>

                  <div class="profile-wrapper">
                    <div class="profile-icon">
                      <img src="/images/home-icon.png">
                    </div>
                    <div class="profile-text">
                      {{ $user->address }} {{ $user->house_number }} </br>
                      <p class="profile-postalcode"> {{ $user->postal_code }} {{ $user->city }} </p>
                    </div>
                  </div>

                </div>
              </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

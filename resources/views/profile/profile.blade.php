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
                      <img src="/images/phone-icon.png">
                    </div>
                    <div class="profile-text">
                      06 11609877
                    </div>
                  </div>

                  <div class="profile-wrapper">
                    <div class="profile-icon">
                      <img src="/images/home-icon.png">
                    </div>
                    <div class="profile-text">
                      Nijverheidsweg 2 </br>
                      <p class="profile-postalcode"> 9791DA Ten Boer </p>
                    </div>
                  </div>

                </div>
              </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

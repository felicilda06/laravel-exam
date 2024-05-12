@extends('app')
<div class='main'>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-primary">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav d-flex w-100 justify-content-end px-3">
                <li class="nav-item active">
                  <a class="nav-link text-white" href="/signin">Signin</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="/register">Signup</a>
                </li>
              </ul>
            </div>
          </nav>
    </header>
    <div class="contents w-100 py-3 px-5">
        <h4 class="mx-3">Announcements</h4>

        <div class="announcements">
            @foreach ($announcements as $item)
                <div class="card w-100 my-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text">{{ $item->content }}</p>
                        <div>
                            <p>Date Posted:</p>
                            <span class="text-primary">{{ $item->startDate }} - {{ $item->endDate }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
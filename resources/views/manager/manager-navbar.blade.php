@extends('layout')
<link rel="shortcut icon" href="{{ asset('images/favicon.svg') }}">
   <body>
       <nav class="navbar navbar-expand-lg p-0">
           <a class="navbar-brand" href="@yield('link')">Manager</a>
           <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
               aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
           </button>

           <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav mr-auto">
                   <li class="nav-item active">
                       <a class="navbar-buttons button3" href="@yield('link')" style="text-decoration: none;">
                           <svg class="input-icon1 mb-1" xmlns="http://www.w3.org/2000/svg"
                               viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                               <path
                                   d="M575.8 255.5c0 18-15 32.1-32 32.1l-32 0 .7 160.2c0 2.7-.2 5.4-.5 8.1l0 16.2c0 22.1-17.9 40-40 40l-16 0c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1L416 512l-24 0c-22.1 0-40-17.9-40-40l0-24 0-64c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32 14.3-32 32l0 64 0 24c0 22.1-17.9 40-40 40l-24 0-31.9 0c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2l-16 0c-22.1 0-40-17.9-40-40l0-112c0-.9 0-1.9 .1-2.8l0-69.7-32 0c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z" />
                           </svg> Home <span class="sr-only">(current)</span></a>
                   </li>
                   <li class="nav-item">
                       <a class="button3 navbar-buttons" href="#" style="text-decoration: none;">
                           <svg class="input-icon1 mb-1" xmlns="http://www.w3.org/2000/svg"
                               viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                               <path
                                   d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z" />
                           </svg> Add Products</a>
                   </li>
                   <li class="nav-item">
                       <a class="button3 navbar-buttons" href="" style="text-decoration: none;">
                           <svg class="input-icon1 mb-1" xmlns="http://www.w3.org/2000/svg"
                               viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                               <path
                                   d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z" />
                    </svg>Sale Records</a>
                   </li>
               </ul>
           </div>
           <!-- Example single danger button -->
           <div class="btn-group mr-5">
               <button type="button" class="btn text-light dropdown-toggle" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                   Hello, @auth
                   {{Auth::User()->user_name}}
                        @endauth
               </button>
               <div class="dropdown-menu">
                  <div class="buttons">
                   <a class="button4" href="{{route('profile.page')}}">Profile</a>
               </div>
               <div class="buttons">
                   <a href="{{ route('user.logout') }}" class="button4">Log out</a>
               </div>
               </div>
           </div>
       </nav>
   </body>

   </html>

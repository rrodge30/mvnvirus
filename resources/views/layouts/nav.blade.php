<div class="pos-f-t">
        <div class="collapse" id="navbarToggleExternalContent">
          <div class="row bg-dark">
            {{-- <h4 class="text-white">Collapsed content</h4>
            <span class="text-muted">Toggleable via the navbar brand.</span> --}}
                <div class="p-4 col-md-1">
                      
                </div>

                <div class="p-4 col-md-10">
                    @guest
                    @else
                        <div class="row">
                            <div class="col-md-1 text-center">
                           
                                <i class="material-icons">home</i><a class="lead" style="color:white;font-size:12px !important;" href="{{ route('home') }}">{{ __('Home') }}</a>
                                
                            </div>
                            @if(Auth::user()->user_level == "99")      
                                <div class="col-md-2 text-center">
                                    
                                    <i class="material-icons">people</i><a class="lead links" style="color:white;font-size:12px !important;" href="{{ route('user.manage') }}">{{ __('Manage Users') }}</a>
                                    
                                </div>  
                            @endif
                        </div>
                    @endguest        
                </div>
          </div>
        </div>
        <nav class="navbar navbar-dark bg-dark">
          @guest
          @else
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          @endguest
          
          <a class="navbar-brand" href="<?php (@guest === true) ? '/' : '/home' ?>" style="margin-left:50px;">
                <b>{{ config('app.name', 'MELBERN FRUITS N VEGGIES') }}</b>
          </a>
          
          <ul class="navbar-nav ml-auto" style="margin-right:30px;">
                <!-- Authentication Links -->
                @guest
                    
                @else
                    
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->username }}
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('user.change.account') }}">
                                    {{ __('My Account') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            
                        </div>
                    </li>
                    
                @endguest
            </ul>
            @guest
                <a class="navbar-brand" href="{{ route('login') }}">{{ __('Login') }}</a>
            @else
            @endguest
        </nav>
</div>


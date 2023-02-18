@include('components/header')
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
      <div class="col-lg-7 text-center text-lg-start">
        <h1 class="display-4 fw-bold lh-1 mb-3">SMS App</h1>
        <p class="col-lg-10 fs-4">Simple and easy way to send bulk sms & whatsapp message.</p>
      </div>
      <div class="col-md-10 mx-auto col-lg-5">
        <!-- Session Status -->
        <x-auth-session-status class="alert alert-danger mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="alert alert-danger mb-4" :errors="$errors" />

        <form class="p-4 p-md-5 border rounded-3 bg-light" method="POST" action="{{ route('login') }}">
        @csrf
        @if (Route::has('login'))
        @auth
          <a class="w-100 btn btn-lg btn-success mt-5" href="{{ url('/dashboard') }}" >Dashboard</a>
        @else
      
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput"  type="email" name="email" :value="old('email')" required autofocus  placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
          </div>
        
          <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password"
                                required autocomplete="current-password" >
            <label for="floatingPassword">Password</label>
          </div>
          
          <div class="checkbox mb-3">
            <label>
              <input id="remember_me" type="checkbox" name="remember"> Remember me
            </label>
          </div>

          <button class="w-100 btn btn-lg btn-primary" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
  <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
</svg> Sign in</button>

        @endif
        @endauth
          <hr class="my-4">
          <small class="text-muted">v1.01 created by @techhost</small>
        </form>
      </div>
    </div>
  </div>
                </div>
@include('components/footer')
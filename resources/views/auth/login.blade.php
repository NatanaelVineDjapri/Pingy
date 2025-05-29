<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/styleAuth.css') }}">
    <title>Login Page-Pingy</title>
</head>

<body>
    <video class="video-bg" autoplay muted loop>
    <source src="image/video1.mp4" type="video/mp4">
  </video>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form method="POST" action="{{ url('/register') }}">
                @csrf
                <h1 class="h1-pink">Create Account</h1>
                <input type="text" name="username" placeholder="Username" value="{{ old('username') }}"required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="name" placeholder="Full Name" required>
                <input type="date" name="dob" placeholder="Date of Birth" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                <button>Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form method="POST" action="{{ url('/login') }}">
                @csrf
                <h1 class ="h1-pink">Sign In</h1>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <a href="{{ url('forget-password') }}">Forget Your Password?</a>
                <button>Sign In</button>
                @error('email')
                    <div class="error_situation">
                        <p>{{ $message }}</p>
                    </div>
                @enderror
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your details to enjoy all features available on the site</p>
                    <button class="hidden" id="login">Sign In</button>
                    @if ($errors->register->any())
                    <div class="error_situation">
                     @foreach ($errors->register->all() as $error)
                          <p class="text-danger">{{ $error }}</p>
                    @endforeach
                    </div>
                @endif
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Pingys!</h1>
                    <p>Sign up now to enjoy the complete range of features we offer</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
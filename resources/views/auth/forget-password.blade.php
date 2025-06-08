<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/styleForgetPass.css') }}">
    <title>Forget Password Page-Pingy</title>
</head>

<body>
    <video class="video-bg" autoplay muted loop>
    <source src="image/video1.mp4" type="video/mp4">
  </video>

    <div class="container" id="container">
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-right">
                    <h1 class="h1-pinkys">Forgot Your Password, Pingys?</h1>
                    <p>No worries! Just fill in the form and we'll help you reset it</p>
                </div>
            </div>
        </div>
        <div class="form-container sign-up">
            <form method="POST" action="{{ route('submitforgetpassword') }}">
                @csrf
                <h1 class ="h1-pink">Reset Password</h1>
                <input type="text" name="username" placeholder="Username" value="{{ old('username') }}" required>
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                <input type="date" name="dob" placeholder="Date of Birth" value="{{ old('dob') }}" required>
                <input type="password" name="password" placeholder="New Password" required>
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                <button type="submit">Confirmed</button>
                    @if ($errors->reset->any())
                        <div class = "error_situation">
                             @foreach ($errors->reset->all() as $error)
                                <p>{{ $error }}</p>
                             @endforeach
                         </div>
                    @endif
            </form>
        </div>
</body>

</html>
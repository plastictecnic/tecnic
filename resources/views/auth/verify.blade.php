<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Forgot Password | Plastictecnic Sdn. Bhd.</title>
    <!-- Favicon-->
    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
        type="text/css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>

<body class="fp-page">
    <div class="fp-box">
        <div class="logo">
            <a href="javascript:void(0);">Verify Your Email Address <b>PTSB</b></a>
            <small>Plastictecnic Sdn Bhd</small>
        </div>
        <div class="card">
            <div class="body">
                <form>
                    @csrf
                    <div class="msg">
                        @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}, 
                    <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{asset('js/app.js')}}"></script>
</body>

</html>
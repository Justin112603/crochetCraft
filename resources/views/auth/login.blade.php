<x-guest-layout>

    <style>
        body{
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f8f3ee, #f1e4da);
        }

        .login-wrapper{
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            position: relative;
            overflow: hidden;
        }

        .login-wrapper::before{
            content:'';
            position:absolute;
            width:600px;
            height:600px;
            background:radial-gradient(circle, rgba(212,178,156,0.35), transparent 70%);
            top:-250px;
            right:-150px;
            border-radius:50%;
        }

        .login-card{
            width:100%;
            max-width:460px;
            background:rgba(255,255,255,0.75);
            backdrop-filter: blur(18px);
            border:1px solid rgba(255,255,255,0.5);
            border-radius:32px;
            padding:50px 40px;
            box-shadow:0 25px 60px rgba(0,0,0,0.08);
            position:relative;
            z-index:2;
        }

        .brand{
            text-align:center;
            margin-bottom:35px;
        }

        .brand h1{
            font-size:3rem;
            font-weight:700;
            color:#5c3b2e;
            margin-bottom:10px;
            font-family:'Cormorant Garamond', serif;
        }

        .brand span{
            color:#b07d62;
            font-style:italic;
        }

        .brand p{
            color:#8d7365;
            font-size:0.95rem;
        }

        .input-group{
            margin-bottom:22px;
        }

        .input-label{
            display:block;
            margin-bottom:10px;
            font-size:0.9rem;
            font-weight:600;
            color:#5c3b2e;
        }

        .modern-input{
            width:100%;
            padding:16px 18px;
            border-radius:16px;
            border:1.5px solid #e2d2c6;
            background:#fff;
            font-size:0.95rem;
            transition:.3s;
            outline:none;
        }

        .modern-input:focus{
            border-color:#b07d62;
            box-shadow:0 0 0 4px rgba(176,125,98,0.12);
        }

        .remember-row{
            display:flex;
            align-items:center;
            justify-content:space-between;
            margin-top:10px;
            margin-bottom:28px;
        }

        .remember{
            display:flex;
            align-items:center;
            gap:8px;
            font-size:0.9rem;
            color:#6f584c;
        }

        .remember input{
            accent-color:#b07d62;
        }

        .forgot{
            font-size:0.88rem;
            color:#b07d62;
            text-decoration:none;
            transition:.3s;
        }

        .forgot:hover{
            color:#8a5e46;
        }

        .login-btn{
            width:100%;
            padding:16px;
            border:none;
            border-radius:18px;
            background:linear-gradient(135deg,#b07d62,#8b5e46);
            color:white;
            font-size:1rem;
            font-weight:600;
            cursor:pointer;
            transition:.35s;
            box-shadow:0 15px 30px rgba(176,125,98,0.28);
        }

        .login-btn:hover{
            transform:translateY(-3px);
            box-shadow:0 18px 40px rgba(176,125,98,0.35);
        }

        .bottom-text{
            text-align:center;
            margin-top:28px;
            font-size:0.92rem;
            color:#8d7365;
        }

        .bottom-text a{
            color:#b07d62;
            text-decoration:none;
            font-weight:600;
        }

        .bottom-text a:hover{
            color:#8a5e46;
        }

        .error-text{
            color:#dc2626;
            font-size:0.82rem;
            margin-top:8px;
        }

        @media(max-width:500px){

            .login-card{
                padding:40px 25px;
            }

            .brand h1{
                font-size:2.5rem;
            }
        }
    </style>

    <div class="login-wrapper">

        <div class="login-card">

            <div class="brand">
                <h1>Crochet<span>Craft</span></h1>
                <p>Welcome back to your handmade collection</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="input-group">
                    <label for="email" class="input-label">
                        Email Address
                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        class="modern-input"
                        placeholder="Enter your email"
                    >

                    <x-input-error :messages="$errors->get('email')" class="error-text" />
                </div>

                <!-- Password -->
                <div class="input-group">
                    <label for="password" class="input-label">
                        Password
                    </label>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        class="modern-input"
                        placeholder="Enter your password"
                    >

                    <x-input-error :messages="$errors->get('password')" class="error-text" />
                </div>

                <!-- Remember + Forgot -->
                <div class="remember-row">

                    <label for="remember_me" class="remember">
                        <input id="remember_me" type="checkbox" name="remember">
                        Remember me
                    </label>

                    @if (Route::has('password.request'))
                        <a class="forgot" href="{{ route('password.request') }}">
                            Forgot Password?
                        </a>
                    @endif

                </div>

                <!-- Button -->
                <button type="submit" class="login-btn">
                    Log In
                </button>

                <div class="bottom-text">
                    Don’t have an account?
                    <a href="{{ route('register') }}">Create one</a>
                </div>

            </form>

        </div>

    </div>

</x-guest-layout>
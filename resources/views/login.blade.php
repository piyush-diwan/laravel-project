<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel By Piyush</title>
</head>

<div class="login-container">
    <div class="login-card">
         @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <h2 class="login-title">Welcome Back</h2>
        <p class="login-subtitle">Please enter your email and password for login</p>
        
        <form method="POST" action="{{ route('login') }}" class="login-form">
            @csrf
            
            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input type="text" name="email" id="email" class="form-input" placeholder="Enter registered email" value="{{ old('email') }}">
                <i class="fas fa-envelope input-icon"></i>
                @error('email') <span>{{ $message }}</span> @enderror
            </div>

            
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-input" placeholder="Enter your password">
                <i class="fas fa-lock input-icon"></i>
                @error('password') <span>{{ $message }}</span> @enderror
            </div>
            
            <button type="submit" class="login-button">Login</button>
            
            <p class="signup-link">Don't have an account? <a href="{{ route('register') }}">Sign up</a></p>
        </form>
    </div>
</div>

<style>
    :root {
        --primary-color: #4361ee;
        --primary-hover: #3a56d4;
        --text-color: #2b2d42;
        --light-gray: #f8f9fa;
        --medium-gray: #e9ecef;
        --dark-gray: #6c757d;
        --white: #ffffff;
        --border-radius: 8px;
        --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    body {
        background-color: var(--light-gray);
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        color: var(--text-color);
    }
    
    .login-container {
        width: 100%;
        max-width: 420px;
        padding: 20px;
    }
    
    .login-card {
        background: var(--white);
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        padding: 2rem;
    }
    
    .login-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        text-align: center;
    }
    
    .login-subtitle {
        color: var(--dark-gray);
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
        position: relative;
    }
    
    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
    }
    
    .form-input {
        width: 100%;
        padding: 0.75rem 1rem 0.75rem 2.5rem;
        border: 1px solid var(--medium-gray);
        border-radius: var(--border-radius);
        font-size: 1rem;
        transition: border-color 0.3s;
    }
    
    .form-input:focus {
        outline: none;
        border-color: var(--primary-color);
    }

    .input-icon {
        position: absolute;
        left: 1rem;
        top: 3.1rem;
        color: var(--dark-gray);
        font-size: 1rem;
    }
    
    .login-button {
        width: 100%;
        padding: 0.75rem;
        background-color: var(--primary-color);
        color: white;
        border: none;
        border-radius: var(--border-radius);
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    
    .login-button:hover {
        background-color: var(--primary-hover);
    }
    
    .signup-link {
        text-align: center;
        margin-top: 1.5rem;
        color: var(--dark-gray);
    }
    
    .signup-link a {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 500;
    }
    
    .signup-link a:hover {
        text-decoration: underline;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
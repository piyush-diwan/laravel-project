<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel By Piyush</title>
</head>

<div class="auth-container">
    <div class="auth-card">
        <h2 class="auth-title">Create Your Account</h2>
        
        <form method="POST" action="{{ route('register') }}" class="auth-form">
            @csrf
            
            <div class="form-group">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" name="name" id="name" class="form-input" placeholder="Enter your full name" value="{{ old('name') }}">
                <i class="fas fa-user input-icon"></i>
                 @error('name')<div class="error">{{ $message }}</div>@enderror
            </div>
            
            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input type="text" name="email" id="email" class="form-input" placeholder="Enter your email address" value="{{ old('email') }}">
                <i class="fas fa-envelope input-icon"></i>
                 @error('email')<div class="error">{{ $message }}</div>@enderror
            </div>
            
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-input" placeholder="">
                <i class="fas fa-lock input-icon"></i>
                @error('password')<div class="error">{{ $message }}</div>@enderror
            </div>
            
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-input" placeholder="">
                <i class="fas fa-lock input-icon"></i>
                 @error('password')<div class="error">{{ $message }}</div>@enderror
            </div>
            
            <button type="submit" class="auth-button">Register</button>
            
            <p class="auth-footer">Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
        </form>
    </div>
</div>

<style>
    :root {
        --primary-color: #4361ee;
        --primary-hover: #3a56d4;
        --secondary-color: #7209b7;
        --text-color: #2b2d42;
        --light-gray: #f8f9fa;
        --medium-gray: #e9ecef;
        --dark-gray: #6c757d;
        --white: #ffffff;
        --error-color: #e63946;
        --success-color: #2a9d8f;
        --border-radius: 10px;
        --box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        --transition: all 0.3s ease;
    }
    
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }
    
    body {
        /* background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); */
        display: flex;
        justify-content: center;
        align-items: center;
        color: var(--text-color);
        line-height: 1.6;
    }
    
    .auth-container {
        width: 100%;
        max-width: 480px;
        padding: 20px;
        margin-top: 50px;
    }
    
    .auth-card {
        background: var(--white);
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        padding: 2.5rem;
        position: relative;
        overflow: hidden;
    }
    
    .auth-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        text-align: center;
        color: var(--text-color);
    }
    
    .auth-subtitle {
        color: var(--dark-gray);
        text-align: center;
        margin-bottom: 2rem;
        font-size: 0.95rem;
    }
    
    .auth-form {
        margin-top: 1.5rem;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
        position: relative;
    }
    
    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        font-size: 0.9rem;
    }
    
    .form-input {
        width: 100%;
        padding: 0.75rem 1rem 0.75rem 2.5rem;
        border: 1px solid var(--medium-gray);
        border-radius: var(--border-radius);
        font-size: 0.95rem;
        transition: var(--transition);
        background-color: var(--light-gray);
    }
    
    .form-input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        background-color: var(--white);
    }
    
    .input-icon {
        position: absolute;
        left: 1rem;
        top: 2.7rem;
        color: var(--dark-gray);
        font-size: 1rem;
    }
    
    .error {
        font-size: 0.75rem;
        color: var(--dark-gray);
        margin-top: 0.25rem;
    }
    
    .auth-button {
        width: 100%;
        padding: 0.85rem;
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        color: white;
        border: none;
        border-radius: var(--border-radius);
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        margin-bottom: 1rem;
    }
    
    .auth-button:hover {
        background: linear-gradient(90deg, var(--primary-hover), #6707a5);
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(67, 97, 238, 0.2);
    }
    
    .auth-footer {
        text-align: center;
        font-size: 0.9rem;
        color: var(--dark-gray);
    }
    
    .auth-footer a {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 500;
    }
    
    .auth-footer a:hover {
        text-decoration: underline;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
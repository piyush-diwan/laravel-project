@include('components.header');
<div class="dashboard-container">
    <div class="dashboard-card">
        <div class="dashboard-header">
            <h2 class="dashboard-title">Welcome, {{ Auth::user()->name }}</h2>
            <p class="dashboard-subtitle">Your account details</p>
        </div>
        
        <div class="dashboard-content">
            <div class="user-info-card">
                <div class="info-item">
                    <span class="info-label">Name</span>
                    <span class="info-value">{{ $name }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Email</span>
                    <span class="info-value">{{ $email }}</span>
                </div>
            </div>
            
            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                @csrf
                <button type="submit" class="logout-button">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
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
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        color: var(--text-color);
        line-height: 1.6;
    }
    
    .dashboard-container {
        width: 100%;
        max-width: 600px;
        padding: 20px;
    }
    
    .dashboard-card {
        background: var(--white);
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        padding: 2.5rem;
        position: relative;
        overflow: hidden;
    }
    
    .dashboard-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: var(--primary-color);
    }
    
    .dashboard-header {
        margin-bottom: 2rem;
        text-align: center;
    }
    
    .dashboard-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: var(--text-color);
    }
    
    .dashboard-subtitle {
        color: var(--dark-gray);
        font-size: 0.95rem;
    }
    
    .user-info-card {
        background-color: var(--light-gray);
        border-radius: var(--border-radius);
        padding: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .info-item {
        display: flex;
        justify-content: space-between;
        padding: 1rem 0;
        border-bottom: 1px solid var(--medium-gray);
    }
    
    .info-item:last-child {
        border-bottom: none;
    }
    
    .info-label {
        font-weight: 600;
        color: var(--text-color);
    }
    
    .info-value {
        color: var(--dark-gray);
    }
    
    .logout-form {
        text-align: center;
    }
    
    .logout-button {
        padding: 0.75rem 1.5rem;
        background-color: var(--primary-color);
        color: white;
        border: none;
        border-radius: var(--border-radius);
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .logout-button:hover {
        background-color: var(--primary-hover);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(67, 97, 238, 0.2);
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel By Piyush</title>
</head>

@auth
    <header class="main-header">
        <div class="header-container">
            <div class="logo">
                <a href="{{ route('dashboard') }}">
                    <i class="fas fa-shield-alt"></i>
                    <span>Admin Panel</span>
                </a>
            </div>

            <nav class="main-nav">
                <ul>
                    <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('employee.*') ? 'active' : '' }}">
                        <a href="{{ route('employee.index') }}">
                            <i class="fas fa-users"></i>
                            <span>Employees</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('department.*') ? 'active' : '' }}">
                        <a href="{{ route('department.index') }}">
                            <i class="fas fa-user-tie"></i>
                            <span>Departments</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="user-menu">
                <div class="user-greeting">Hello, {{ Auth::user()->name }}</div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>Logout
                    </button>
                </form>
            </div>
        </div>
    </header>
@endauth
<style>
    :root {
        --header-bg: #2c3e50;
        --header-text: #ecf0f1;
        --header-active: #3498db;
        --header-hover: #34495e;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }


    body {
        padding-top: 60px;
        min-height: 100vh;
    }

    .main-content {
        min-height: calc(100vh - 60px);
        position: relative;
        z-index: 1;
    }

    .main-header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background-color: var(--header-bg);
        color: var(--header-text);
        height: 60px;
        z-index: 1000;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .header-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 100%;
        padding: 0 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .logo {
        font-size: 1.2rem;
        font-weight: bold;
    }

    .logo a {
        color: var(--header-text);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .logo i {
        font-size: 1.5rem;
    }

    .main-nav ul {
        display: flex;
        list-style: none;
        gap: 15px;
        height: 100%;
    }

    .main-nav li {
        display: flex;
        align-items: center;
    }

    .main-nav a {
        color: var(--header-text);
        text-decoration: none;
        padding: 10px 15px;
        border-radius: 4px;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: background-color 0.3s;
    }

    .main-nav a:hover {
        background-color: var(--header-hover);
    }

    .main-nav .active a {
        background-color: var(--header-active);
    }

    .user-menu {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .user-greeting {
        font-size: 0.9rem;
    }

    .logout-btn {
        background: none;
        border: none;
        color: var(--header-text);
        cursor: pointer;
        font-size: 1rem;
        padding: 8px;
        border-radius: 50%;
        transition: background-color 0.3s;
    }

    .logout-btn:hover {
        background-color: var(--header-hover);
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
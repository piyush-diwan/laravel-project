@include('components.header')
<main class="main-content">
    <div class="employee-management-container">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-users"></i> Employee Management
            </h1>
            <div class="header-actions">
                <a href="{{ route('employee.create') }}" class="btn btn-add">
                    <i class="fas fa-plus"></i> Add Employee
                </a>
            </div>
        </div>

        <div class="search-filter-card">
            <form action="{{ route('employee.index') }}" method="GET" class="search-form">
                <div class="search-input-group">
                    <div class="search-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <input type="text" name="search" class="search-input" placeholder="Search employees..."
                        value="{{ request('search') }}">
                    <select name="department" class="department-select">
                        <option value="">All Departments</option>
                        @foreach($departments as $dept)
                        <option value="{{ $dept }}" {{ request('department') == $dept ? 'selected' : '' }}>{{ $dept }}
                        </option>
                        @endforeach
                    </select>
                    <button type="submit" class="filter-btn">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </div>
            </form>
        </div>

        <div class="employee-table-card">
            <div class="table-responsive">
                <table class="employee-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Join Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $index = 0
                        ?>
                        @forelse($employees as $employee)
                        <tr>
                            <td class="employee-id">{{ $index + 1 }}</td>
                            <td>
                                <div class="employee-photo">
                                    @if($employee->photo)
                                    <img src="{{ asset('storage/' . $employee->photo) }}" alt="{{ $employee->name }}">
                                    @else
                                    <div class="photo-placeholder">
                                        {{ substr($employee->name, 0, 1) }}
                                    </div>
                                    @endif
                                </div>
                            </td>
                            <td class="employee-name">{{ $employee->name }}</td>
                            <td class="employee-email">{{ $employee->email }}</td>
                            <td class="employee-department">
                                <span class="department-tag department-{{ strtolower($employee->department) }}">
                                    {{ $employee->department }}
                                </span>
                            </td>
                            <td class="employee-position">{{ $employee->position }}</td>
                            <td class="join-date">{{ $employee->join_date }}</td>
                            <td>
                                <span class="status-badge status-{{ $employee->status }}">
                                    {{ ucfirst($employee->status) }}
                                </span>
                            </td>
                            <td class="action-buttons">
                                <a href="{{ route('employee.show', $employee->id) }}" class="btn-view" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('employee.edit', $employee->id) }}" class="btn-edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('employee.destroy', $employee->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" title="Delete"
                                        onclick="return confirm('Are you sure you want to delete the employee -> {{ $employee->name }} ?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php
                        $index++;
                        ?>
                        @empty
                        <tr>
                            <td colspan="9" class="no-data">
                                <div class="no-data-content">
                                    <i class="fas fa-user-slash"></i>
                                    <p>No employees found</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination-wrapper mt-4">
                {{ $employees->links('pagination::bootstrap-5') }}
            </div>
        </div>

    </div>

</main>

<style>
    :root {
        --primary-color: #4361ee;
        --primary-light: #eef2ff;
        --secondary-color: #3f37c9;
        --success-color: #4cc9f0;
        --danger-color: #f72585;
        --warning-color: #f8961e;
        --info-color: #4895ef;
        --dark-color: #2b2d42;
        --light-color: #f8f9fa;
        --gray-color: #6c757d;
        --border-radius: 8px;
        --box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        --transition: all 0.3s ease;
    }

    .employee-management-container {
        padding: 2rem;
        max-width: 1400px;
        margin: 0 auto;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .page-title {
        font-size: 1.8rem;
        color: var(--dark-color);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .page-title i {
        color: var(--primary-color);
    }

    .btn-add {
        background-color: var(--primary-color);
        color: white;
        padding: 0.6rem 1.2rem;
        border-radius: var(--border-radius);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: var(--transition);
        border: none;
        font-weight: 500;
    }

    .btn-add:hover {
        background-color: var(--secondary-color);
        transform: translateY(-2px);
        box-shadow: var(--box-shadow);
        color: white;
    }

    .search-filter-card {
        background-color: white;
        border-radius: var(--border-radius);
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: var(--box-shadow);
    }

    .search-form {
        width: 100%;
    }

    .search-input-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .search-icon {
        color: var(--gray-color);
        padding: 0 1rem;
    }

    .search-input {
        flex: 1;
        padding: 0.75rem 1rem;
        border: 1px solid #e0e0e0;
        border-radius: var(--border-radius);
        font-size: 1rem;
        transition: var(--transition);
    }

    .search-input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
    }

    .department-select {
        padding: 0.75rem 1rem;
        border: 1px solid #e0e0e0;
        border-radius: var(--border-radius);
        font-size: 1rem;
        background-color: white;
        min-width: 180px;
    }

    .filter-btn {
        background-color: var(--primary-color);
        color: white;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: var(--border-radius);
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: var(--transition);
    }

    .filter-btn:hover {
        background-color: var(--secondary-color);
    }

    .employee-table-card {
        background-color: white;
        border-radius: var(--border-radius);
        padding: 1.5rem;
        box-shadow: var(--box-shadow);
    }

    .employee-table {
        width: 100%;
        border-collapse: collapse;
    }

    .employee-table thead {
        background-color: var(--primary-light);
    }

    .employee-table th {
        padding: 1rem;
        text-align: left;
        color: var(--dark-color);
        font-weight: 600;
        border-bottom: 2px solid #f0f0f0;
    }

    .employee-table td {
        padding: 1rem;
        border-bottom: 1px solid #f0f0f0;
        vertical-align: middle;
    }

    .employee-table tr:hover {
        background-color: rgba(67, 97, 238, 0.05);
    }

    .employee-photo {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        overflow: hidden;
    }

    .employee-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .photo-placeholder {
        width: 100%;
        height: 100%;
        background-color: var(--primary-color);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.2rem;
    }

    .department-tag {
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .department-it {
        background-color: #e3f2fd;
        color: #1976d2;
    }

    .department-hr {
        background-color: #f3e5f5;
        color: #8e24aa;
    }

    .department-finance {
        background-color: #e8f5e9;
        color: #388e3c;
    }

    .department-marketing {
        background-color: #fff3e0;
        color: #fb8c00;
    }

    .status-badge {
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
        display: inline-block;
    }

    .status-active {
        background-color: #e8f5e9;
        color: #388e3c;
    }

    .status-inactive {
        background-color: #ffebee;
        color: #d32f2f;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .btn-view,
    .btn-edit,
    .btn-delete {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition);
        border: none;
    }

    .btn-view {
        background-color: rgba(72, 149, 239, 0.1);
        color: var(--info-color);
    }

    .btn-view:hover {
        background-color: var(--info-color);
        color: white;
    }

    .btn-edit {
        background-color: rgba(248, 150, 30, 0.1);
        color: var(--warning-color);
    }

    .btn-edit:hover {
        background-color: var(--warning-color);
        color: white;
    }

    .btn-delete {
        background-color: rgba(247, 37, 133, 0.1);
        color: var(--danger-color);
    }

    .btn-delete:hover {
        background-color: var(--danger-color);
        color: white;
    }

    .no-data {
        text-align: center;
        padding: 3rem 0;
    }

    .no-data-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
        color: var(--gray-color);
    }

    .no-data-content i {
        font-size: 2.5rem;
    }

    .pagination-wrapper {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
    }


    /* Pagination styling */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
    }

    .pagination {
        display: flex;
        gap: 0.5rem;
        padding-left: 0;
    }

    .page-item {
        list-style: none;
    }

    .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        text-decoration: none;
        color: var(--dark-color);
        font-weight: 500;
        transition: var(--transition);
        border: 1px solid #dee2e6;
    }

    .page-link:hover {
        background-color: var(--primary-light);
        color: var(--primary-color);
        border-color: #dee2e6;
    }

    .page-item.active .page-link {
        background-color: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        background-color: #fff;
        border-color: #dee2e6;
    }

    .w-5.h-5 {
        width: 20px;
        height: 20px;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
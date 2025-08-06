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
                <i class="fas fa-building"></i> Departments
            </h1>
            <div class="header-actions">
                <a href="{{ route('department.create') }}" class="btn btn-add">
                    <i class="fas fa-plus"></i> Add Department
                </a>
            </div>
        </div>

        <div class="search-filter-card">
            <form action="{{ route('department.index') }}" method="GET" class="search-form">
                <div class="search-input-group">
                    <div class="search-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <input type="text" name="search" class="search-input" placeholder="Search departments..."
                        value="{{ request('search') }}">
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
                            <th>Department Code</th>
                            <th>Department Name</th>
                            <th>Description</th>
                            <th>Created On</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($departments as $department)
                            <tr>
                                <td class="employee-id">{{ $department->dept_code }}</td>
                                <td class="employee-name">{{ $department->dept_name }}</td>
                                <td class="employee-email">{{ $department->description }}</td>
                                <td class="join-date" style="width: 150px;">{{ $department->created_at->format('Y-m-d') }}</td>
                                <td class="action-buttons">
                                    <a href="{{ route('department.edit', $department->id) }}" class="btn-edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('department.destroy', $department->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" title="Delete"
                                            onclick="return confirm('Are you sure you want to delete this department?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="no-data">
                                    <div class="no-data-content">
                                        <i class="fas fa-building-circle-xmark"></i>
                                        <p>No departments found</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination-wrapper mt-4">
                {{ $departments->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</main>

<style>
    /* Use the same CSS as your employee page */
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
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
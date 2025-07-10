@include('components.header')

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
        --border-radius: 12px;
        --box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        --transition: all 0.3s ease;
    }

    body {
        background-color: #f5f7fa;
        padding-top: 60px; /* Match header height */
    }

    .employee-details-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1rem;
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

    .employee-card {
        background-color: white;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        overflow: hidden;
    }

    .employee-profile {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 2rem;
        background: linear-gradient(135deg, var(--primary-light) 0%, #ffffff 100%);
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }

    .employee-avatar {
        width: 160px;
        height: 160px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid white;
        box-shadow: var(--box-shadow);
        margin-bottom: 1.5rem;
    }

    .avatar-placeholder {
        width: 160px;
        height: 160px;
        border-radius: 50%;
        background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 4rem;
        font-weight: bold;
        margin-bottom: 1.5rem;
        border: 5px solid white;
        box-shadow: var(--box-shadow);
    }

    .employee-name {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--dark-color);
    }

    .employee-position {
        color: var(--gray-color);
        margin-bottom: 1rem;
    }

    .status-badge {
        padding: 0.5rem 1.25rem;
        border-radius: 20px;
        font-weight: 500;
        font-size: 0.9rem;
        display: inline-block;
    }

    .status-active {
        background-color: rgba(76, 201, 240, 0.1);
        color: var(--success-color);
    }

    .status-inactive {
        background-color: rgba(247, 37, 133, 0.1);
        color: var(--danger-color);
    }

    .employee-details {
        padding: 2rem;
    }

    .detail-table {
        width: 100%;
    }

    .detail-table tr {
        border-bottom: 1px solid #f0f0f0;
    }

    .detail-table tr:last-child {
        border-bottom: none;
    }

    .detail-table th {
        padding: 1rem;
        text-align: left;
        width: 30%;
        color: var(--gray-color);
        font-weight: 500;
    }

    .detail-table td {
        padding: 1rem;
        font-weight: 500;
        color: var(--dark-color);
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        flex-wrap: wrap;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: var(--border-radius);
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        border: none;
    }

    .btn-edit {
        background-color: var(--warning-color);
        color: white;
    }

    .btn-edit:hover {
        background-color: #e07e0c;
        transform: translateY(-2px);
        box-shadow: var(--box-shadow);
    }

    .btn-delete {
        background-color: var(--danger-color);
        color: white;
    }

    .btn-delete:hover {
        background-color: #e5157a;
        transform: translateY(-2px);
        box-shadow: var(--box-shadow);
    }

    .btn-back {
        background-color: var(--gray-color);
        color: white;
    }

    .btn-back:hover {
        background-color: #5a6268;
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .employee-profile {
            padding: 1.5rem;
        }
        
        .employee-avatar, 
        .avatar-placeholder {
            width: 120px;
            height: 120px;
            font-size: 2.5rem;
        }
        
        .detail-table th {
            width: 40%;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="employee-details-container">
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-id-card"></i> Employee Details
        </h1>
        <a href="{{ route('employee.index') }}" class="btn btn-back">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="employee-card">
        <div class="employee-profile">
            @if($employee->photo)
                <img src="{{ asset('storage/'.$employee->photo) }}" alt="{{ $employee->name }}" class="employee-avatar">
            @else
                <div class="avatar-placeholder">
                    {{ substr($employee->name, 0, 1) }}
                </div>
            @endif
            
            <h2 class="employee-name">{{ $employee->name }}</h2>
            <p class="employee-position">{{ $employee->position }}</p>
            
            <span class="status-badge status-{{ $employee->status }}">
                {{ ucfirst($employee->status) }}
            </span>
        </div>

        <div class="employee-details">
            <table class="detail-table">
                <tr>
                    <th>Employee ID</th>
                    <td>#{{ $employee->id }}</td>
                </tr>
                <tr>
                    <th>Email Address</th>
                    <td>{{ $employee->email }}</td>
                </tr>
                <tr>
                    <th>Department</th>
                    <td>
                        <span class="department-badge">
                            {{ $employee->department }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Join Date</th>
                    <td>{{ $employee->join_date }}</td>
                </tr>
            </table>

            <div class="action-buttons">
                <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-edit">
                    <i class="fas fa-edit"></i> Edit Profile
                </a>
                <form action="{{ route('employee.destroy', $employee->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this employee?')">
                        <i class="fas fa-trash"></i> Delete Employee
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
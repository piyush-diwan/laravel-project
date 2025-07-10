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
        --border-radius: 8px;
        --box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        --transition: all 0.3s ease;
    }

    body {
        background-color: #f5f7fa;
        padding-top: 60px;
    }

    .department-form-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    .form-header {
        margin-bottom: 2rem;
        text-align: center;
    }

    .form-header h2 {
        color: var(--dark-color);
        font-size: 2rem;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .form-header h2 i {
        color: var(--primary-color);
    }

    .form-card {
        background-color: white;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: var(--dark-color);
    }

    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #e0e0e0;
        border-radius: var(--border-radius);
        font-size: 1rem;
        transition: var(--transition);
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
    }

    .invalid-feedback {
        color: var(--danger-color);
        font-size: 0.85rem;
        margin-top: 0.25rem;
    }

    .is-invalid {
        border-color: var(--danger-color) !important;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: var(--border-radius);
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-primary {
        background-color: var(--primary-color);
        color: white;
    }

    .btn-primary:hover {
        background-color: var(--secondary-color);
        transform: translateY(-2px);
        box-shadow: var(--box-shadow);
    }

    .btn-secondary {
        background-color: var(--gray-color);
        color: white;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        transform: translateY(-2px);
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 2rem;
    }
</style>

<div class="department-form-container">
    <div class="form-header">
        <h2><i class="fas fa-edit"></i> Edit Department</h2>
        <p class="text-muted">Update the department details</p>
    </div>

    <div class="form-card">
        <form action="{{ route('department.update', $department->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $department->id }}">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="dept_code">Department Code</label>
                        <input type="text" name="dept_code" id="dept_code" 
                               class="form-control @error('dept_code') is-invalid @enderror"
                               value="{{ old('dept_code', $department->dept_code) }}" 
                               placeholder="Enter department code">
                        @error('dept_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="dept_name">Department Name</label>
                        <input type="text" name="dept_name" id="dept_name" 
                               class="form-control @error('dept_name') is-invalid @enderror"
                               value="{{ old('dept_name', $department->dept_name) }}" 
                               placeholder="Enter department name">
                        @error('dept_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" 
                          class="form-control @error('description') is-invalid @enderror"
                          rows="3">{{ old('description', $department->description) }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <a href="{{ route('department.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Department
                </button>
            </div>
        </form>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
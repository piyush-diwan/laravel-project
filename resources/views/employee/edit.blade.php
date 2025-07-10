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

    .edit-employee-container {
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

    .edit-form-card {
        background-color: white;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        padding: 2rem;
    }

    .form-section {
        margin-bottom: 2rem;
    }

    .section-title {
        font-size: 1.2rem;
        color: var(--dark-color);
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -1rem;
    }

    .form-col {
        flex: 0 0 50%;
        padding: 0 1rem;
        margin-bottom: 1.5rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
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

    .form-select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 16px 12px;
    }

    .invalid-feedback {
        color: var(--danger-color);
        font-size: 0.85rem;
        margin-top: 0.25rem;
    }

    .is-invalid {
        border-color: var(--danger-color) !important;
    }

    .photo-preview {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-top: 1rem;
    }

    .current-photo {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #f0f0f0;
    }

    .remove-photo-checkbox {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 1rem;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 2rem;
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

    /* Custom file input */
    .file-input-container {
        position: relative;
        margin-top: 1rem;
    }

    .file-input-label {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0.75rem 1rem;
        background-color: var(--primary-light);
        color: var(--primary-color);
        border-radius: var(--border-radius);
        cursor: pointer;
        transition: var(--transition);
        border: 1px dashed var(--primary-color);
        text-align: center;
    }

    .file-input-label:hover {
        background-color: #e0e7ff;
    }

    .file-input-label i {
        margin-right: 8px;
    }

    .file-input {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        border: 0;
    }

    .file-name {
        margin-top: 0.5rem;
        font-size: 0.85rem;
        color: var(--gray-color);
    }

    @media (max-width: 768px) {
        .form-col {
            flex: 0 0 100%;
        }
        
        .form-actions {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="edit-employee-container">
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-user-edit"></i> Edit Employee
        </h1>
        <a href="{{ route('employee.show', $employee->id) }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Profile
        </a>
    </div>

    <div class="edit-form-card">
        <form action="{{ route('employee.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-section">
                <h3 class="section-title">
                    <i class="fas fa-info-circle"></i> Basic Information
                </h3>
                
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name', $employee->name) }}" required placeholder="Enter full name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-col">
                        <div class="form-group">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" 
                                   value="{{ old('email', $employee->email) }}" required placeholder="Enter email address">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="department" class="form-label">Department</label>
                            <select name="department" id="department" class="form-control form-select @error('department') is-invalid @enderror" required>
                                <option value="" disabled selected>Select Department</option>
                                @foreach($departments as $dept)
                                    <option value="{{ $dept }}" {{ old('department', $employee->department) == $dept ? 'selected' : '' }}>{{ $dept }}</option>
                                @endforeach
                            </select>
                            @error('department')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-col">
                        <div class="form-group">
                            <label for="position" class="form-label">Position</label>
                            <input type="text" name="position" id="position" class="form-control @error('position') is-invalid @enderror" 
                                   value="{{ old('position', $employee->position) }}" required placeholder="Enter position">
                            @error('position')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h3 class="section-title">
                    <i class="fas fa-calendar-alt"></i> Employment Details
                </h3>
                
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="join_date" class="form-label">Join Date</label>
                            <input type="date" name="join_date" id="join_date" class="form-control @error('join_date') is-invalid @enderror" 
                                   value="{{ old('join_date', $employee->join_date) }}" required>
                            @error('join_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-col">
                        <div class="form-group">
                            <label for="status" class="form-label">Employment Status</label>
                            <select name="status" id="status" class="form-control form-select @error('status') is-invalid @enderror" required>
                                <option value="active" {{ old('status', $employee->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $employee->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h3 class="section-title">
                    <i class="fas fa-camera"></i> Profile Photo
                </h3>
                
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Update Photo</label>
                            <div class="file-input-container">
                                <label for="photo" class="file-input-label">
                                    <i class="fas fa-cloud-upload-alt"></i> Choose New Photo
                                </label>
                                <input type="file" name="photo" id="photo" class="file-input @error('photo') is-invalid @enderror">
                                <div class="file-name" id="file-name">No file chosen</div>
                                @error('photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            @if($employee->photo)
                                <div class="photo-preview">
                                    <img src="{{ asset('storage/'.$employee->photo) }}" alt="Current Photo" class="current-photo">
                                    <div class="remove-photo-checkbox">
                                        <input type="checkbox" name="remove_photo" id="remove_photo" class="form-check-input">
                                        <label for="remove_photo" class="form-check-label">Remove current photo</label>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('employee.show', $employee->id) }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Employee
                </button>
            </div>
        </form>
    </div>
</div>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script>
    document.getElementById('photo').addEventListener('change', function(e) {
        var fileName = e.target.files[0] ? e.target.files[0].name : 'No file chosen';
        document.getElementById('file-name').textContent = fileName;
    });
</script>
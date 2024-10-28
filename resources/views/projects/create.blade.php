@extends('layout.master')
@section('content')
<div>
    <form method="POST" action="{{ route('projects.store') }}" enctype="multipart/form-data">
        @csrf
        <!-- Name, Description, Staff Dropdown -->
        <div class="container">
            <h2>Create Project</h2>
            <div class="row justify-content-center">
                <div class="mb-3">
                    <label for="name" class="form-label">Project Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter Project Name" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Project Description</label>
                    <textarea type="text" name="description" cols="30" rows="10"  class="form-control" placeholder="Enter Project Description" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="staff" class="form-label">Staff</label>
                    <select class="form-select" aria-label="Default select example" name="staff_id" required>
                        <option value="" disabled selected>Select Staff</option>
                        @foreach ($staffs as $staff)
                        <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">File Upload</label>
                    <input class="form-control" type="file" name="file">
                </div>
                {{-- <div class="mb-3">
                    <label for="formFile" class="form-label">File Upload</label>
                    <div id="file-dropzone" class="dropzone"></div>
                    <input class="form-control" type="hidden" id="file" name="file">
                </div> --}}
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" aria-label="Default select example" name="status" required>
                        <option value="" disabled selected>Select Status</option>
                        <option value="active" class="text-success">Active</option>
                        <option value="inactive" class="text-secondary">Inactive</option>
                        <option value="hold" class="text-warning">Hold</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Create Project</button>
            </div>
        </div>
    </form>
</div>

<!-- Include Dropzone.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>
<script>
  // Configure Dropzone
  Dropzone.options.fileDropzone = {
      url: "{{ route('file.upload') }}", // Ensure this route is defined in your routes
      maxFiles: 1,
      acceptedFiles: ".jpg,.jpeg,.png,.pdf,.doc,.docx",
      init: function() {
          // Add CSRF token to each request
          this.on("sending", function(file, xhr, formData) {
              formData.append('_token', '{{ csrf_token() }}'); // Append the CSRF token
          });
          this.on("success", function(file, response) {
              // Assuming the response contains the file path
              document.getElementById('file').value = response.file_path; // Set the hidden input to the file path
          });
          this.on("error", function(file, response) {
              console.error(response); // Log the full response for debugging
              alert('File upload failed: ' + (response.message || 'Please try again.'));
          });
      }
  };
</script>

@endsection

{{-- @extends('layout.master')
@section('content')
<div>
    <form method="POST" action="{{ route('projects.store') }}" enctype="multipart/form-data">
      @csrf
      <!-- Name, Description, Staff Dropdown -->
      <div class="container">
        <h2>Create project</h2>
        <div class="row justify-content-center">
          <div class="mb-3">
            <label for="name" class="form-label">Project Name</label>
              <input type="text" name="name" class="form-control" placeholder="Enter Project Name">
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Project Description</label>
              <input type="text" name="description" class="form-control" placeholder="Enter Project description">
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Staff</label>
              <select class="form-select" aria-label="Default select example" name="staff_id">
                <option selected>Select staff</option>
                  @foreach ($staffs as $staff)
                  <option value="{{$staff->id}}">{{$staff->name}}</option>
                  @endforeach
              </select>
          </div>
          <div class="mb-3">
            <label for="formFile" class="form-label">File upload</label>
            <div id="file-dropzone" class="dropzone"></div>
            <input class="form-control" type="hidden" id="formFile" name="file">
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Status</label>
            <select class="form-select" aria-label="Default select example" name="status">
              <option selected>Select status</option>
              <option value="active" class="text-success">Active</option>
              <option value="inactive" class="text-secondary">Inactive</option>
              <option value="hold" class="text-warning">Hold</option>
            </select>
          </div>
          <div class="mb-3">
            
          </div>
          <button type="submit" class="btn btn-primary">Create Project</button>
        </div>
      </div>
  </form>
  
</div>
<script>
  <script>
    Dropzone.options.fileDropzone = {
        url: "{{ route('file.upload') }}", // Ensure this route is defined in your routes
        maxFiles: 1,
        acceptedFiles: ".jpg,.jpeg,.png,.pdf,.doc,.docx",
        success: function(file, response) {
            document.getElementById('file').value = response.file_path; // Set the hidden input to the file path
        }
    };
</script>
</script>
@endsection --}}
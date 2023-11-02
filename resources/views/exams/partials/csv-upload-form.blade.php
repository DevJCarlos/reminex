<form method="post" action="{{ route('upload.csv') }}" enctype="multipart/form-data">
    @csrf
    @if (session('message') === 'File Upload Successfully')
        <script>
            alert('File Uploaded Successfully');
        </script>
    @endif
    <div class="mb-3 form-group">
        <label for="matrix" class="form-label">Upload Matrix</label>
        <input type="file" class="form-control-file" id="matrix" name="matrix" accept=".csv">
    </div>
    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
</form>

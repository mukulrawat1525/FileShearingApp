<!DOCTYPE html>
<html>

<head>
  <title>File Preview - {{ $file->original_name }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .preview-container {
      max-width: 800px;
      margin: 2rem auto;
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 8px;
    }

    .file-preview {
      max-height: 70vh;
      margin: 20px 0;
    }

    .download-btn {
      margin-top: 20px;
      padding: 12px 30px;
      font-size: 1.1rem;
    }
  </style>
</head>

<body>
  <div class="preview-container">
    <h3 class="mb-4">{{ $file->original_name }}</h3>

    @if(str_starts_with($mimeType, 'image/'))
    <img src="{{ asset('uploads/' . $file->filename) }}" alt="File Preview" class="img-fluid file-preview">

    @elseif(str_starts_with($mimeType, 'video/'))
    <video controls class="file-preview" width="100%">
      <source src="{{ asset('uploads/' . $file->filename) }}" type="{{ $mimeType }}">
      Your browser does not support the video tag.
    </video>

    @elseif(str_starts_with($mimeType, 'audio/'))
    <audio controls class="file-preview" width="100%">
      <source src="{{ asset('uploads/' . $file->filename) }}" type="{{ $mimeType }}">
      Your browser does not support the audio element.
    </audio>

    @elseif($mimeType === 'application/pdf')
    <embed src="{{ asset('uploads/' . $file->filename) }}" type="application/pdf" width="100%" height="600px"
      class="file-preview">

    @else
    <div class="card file-preview">
      <div class="card-body text-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-file-earmark"
          viewBox="0 0 16 16">
          <path
            d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z" />
        </svg>
        <h5 class="mt-3">File Preview Not Available</h5>
        <p class="text-muted">This file type cannot be previewed</p>
      </div>
    </div>
    @endif

    <div class="text-center">
      <a href="{{ route('download', $file->uuid) }}" class="btn btn-primary download-btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download"
          viewBox="0 0 16 16">
          <path
            d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
          <path
            d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
        </svg>
        Download File
      </a>

      <div class="mt-3 text-muted">
        <small>
          File size: {{ $file->size }} •
          Uploaded: {{ $file->created_at->diffForHumans() }}
        </small>
      </div>
    </div>
  </div>
</body>

</html>
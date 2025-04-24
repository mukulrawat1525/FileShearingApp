<!DOCTYPE html>
<html>

<head>
  <title>Share Your Files Seamlessly</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>


    body {
      background-image: linear-gradient(-225deg, #69EACB 0%, #EACCF8 48%, #6654F1 100%);
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .container {
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      max-width: 600px;
      width: 100%;
    }

    h2 {
      color: #343a40;
    }

    .form-control:focus {
      box-shadow: none;
      border-color: #007bff;
    }

    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }

    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #0056b3;
    }

    .alert {
      border-radius: 5px;
    }

    .copy-link {
      cursor: pointer;
      position: relative;
    }

    .copy-link::after {
      content: "Click to copy";
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      color: #666;
      font-size: 0.8rem;
    }

    .copy-link.copied::after {
      content: "Copied!";
      color: green;
    }
     h1 {
    	text-transform: uppercase;
    	background: linear-gradient(to right, #30CFD0 0%, #330867 100%);
    	-webkit-background-clip: text;
    	-webkit-text-fill-color: transparent;
    	font: {
    		size: 15vw;
    		family: 'Poppins', sans-serif;
    	};
    }
  </style>
</head>

<body>
  <div class="container">
    <h1 class="mb-4 text-center">Send. Share. Simplify</h1>

    @if(session('success'))
    <div class="alert alert-success" id="success-message">
      {{ session('success') }}
    </div>
    @endif


    @if(session('preview_link'))
    <div class="alert alert-info" id="preview-link">
      Shareable Link:
      <input type="text" class="form-control" value="{{ session('preview_link') }}" onclick="copyToClipboard(this)"
        readonly>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0" style="list-style-type: none;">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <div id="upload-form-container" @if(session('success')) style="display: none;" @endif>
      <form id="upload-form" action="{{ route('upload.submit') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <input type="file" class="form-control" name="file" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Upload File</button>
      </form>
    </div>

    <button id="upload-new-btn" class="btn btn-secondary mt-3 w-100" style="display: none;"
      onclick="showUploadForm()">Upload New</button>
  </div>

  <script>
    function copyToClipboard(element) {
      element.select();
      element.setSelectionRange(0, 99999);

      try {
        navigator.clipboard.writeText(element.value);
        element.classList.add('copied');
        setTimeout(() => {
          element.classList.remove('copied');
        }, 2000);
      } catch (err) {
        document.execCommand('copy');
      }
    }

    function showUploadForm() {
      document.getElementById('upload-form-container').style.display = 'block';
      document.getElementById('upload-new-btn').style.display = 'none';
      document.getElementById('success-message').style.display = 'none';
      document.getElementById('preview-link').style.display = 'none';
      document.getElementById('upload-form').reset();
    }

    @if(session('success'))
    document.getElementById('upload-new-btn').style.display = 'block';
    document.getElementById('upload-form').reset();
    @endif
  </script>
</body>

</html>
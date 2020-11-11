<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Laravel Ajax Image Upload With Preview</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body>
 
  <nav class="navbar navbar-expand-sm bg-primary navbar-dark">
    <a class="navbar-brand" href="{{ url('/') }}">Omar Image</a>
  </nav>
    <div class="container mt-5">

        <div class="row">
            <div class="col-sm-12">
                <h4>Image Add & Update</h4>
            </div>
        </div>
      
        <form method="POST" enctype="multipart/form-data" id="ajax-image-upload-form" action="javascript:void(0)" >
                  
            <div class="row">
                <div class="col-md-12 mb-2">
                    <img id="display-image-preview" src=""
                        alt="" style="max-height: 150px;">
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="file" name="image" placeholder="Choose image" id="image">
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    </div>
                </div>
                  
                  
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>     
        </form>
    </div>
    <script type="text/javascript">
     
    $(document).ready(function (e) {
  
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
 
        $('#image').change(function(){
          
            let reader = new FileReader();
            reader.onload = (e) => { 
              $('#display-image-preview').attr('src', e.target.result); 
            }
            reader.readAsDataURL(this.files[0]); 
 
        });
 
        $('#ajax-image-upload-form').submit(function(e) {
            e.preventDefault();
 
            var formData = new FormData(this);
 
            $.ajax({
                type:'POST',
                url: "{{ url('ajax-image-upload')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success: (data) => {
                    this.reset();
                    alert('Image has been uploaded!');
                },
                error: function(data){
                    console.log(data);
                }
            });
        });
    });
 
</script>
</body>
</html>
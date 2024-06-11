<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <style>
        .imageThumb {
            max-width: 117px;
            max-height: 113px;
            border: 2px solid;
            cursor: pointer;
        }

        input[type="file"] {
             display: block;               /* it is used to make an element render as a block-level element. */
        }


        .pip {
            display: inline-block;
            margin: 10px 10px 0 0;
        }

        .remove {
            display: block;
            background: #444;
            border: 1px solid black;
            color: white;
            text-align: center;
            cursor: pointer;
        }

        .remove:hover {
            background: white;
            color: black;
        }
    </style>

</head>
<body>
    <div class="bg-dark py-3 mb-5">
        <h3 class="text-white text-center">LARAVEL CRUD OPERATION </h3>
    </div>
   <div class="row">
        <!-- [ form-element ] start -->
        <div class="col-sm-12">
            <form  id="myForm" action="{{ route('user.update', $product->id) }}" method="post" enctype="multipart/form-data" class="container mt-4  p-3 bg-white">
                @csrf
                @method('PATCH')
                    <div class="card mb-5">
                        <div class="card-header mb-3 text-center">
                            <h1> Edit User  Form</h1>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">Name:</label>
                                    <input value="{{ old('name', $product->name) }}" type="text" name="name" id="name" class="form-control">
                                    {{-- <p class="text-danger error name"></p>    --}}
                                    <span class="text-danger kt-form__help error name"></span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="phone">Phone:</label>
                                    <input value="{{ old('phone', $product->phone) }}" type="tel" name="phone" id="phone" class="form-control">
                                    <span class="text-danger error phone"></span>
                                    
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="age">Age:</label>
                                    <input value="{{ old('age', $product->age) }}" type="number" name="age" id="age" class="form-control">
                                    <span class="text-danger error age"></span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="address">Address:</label>
                                    <textarea name="address" id="address" rows="1" class="form-control">{{ old('address', $product->address) }}</textarea>
                                    <span class="text-danger error address"></span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Gender:</label><br>
                                    <label><input type="radio" name="gender" value="male" {{ $product->gender == 'male' ? 'checked' : '' }}> Male</label>
                                    <label><input type="radio" name="gender" value="female" {{ $product->gender == 'female' ? 'checked' : '' }}> Female</label>
                                    <label><input type="radio" name="gender" value="other" {{ $product->gender == 'other' ? 'checked' : '' }}> Other</label>
                                </div>

                                <div class="form-group col-md-6">
                                    @php
                                        $hobbies = explode(',', $product->hobby);
                                    @endphp
                                    <label for="hobby">Hobby:</label><br>
                                    <label><input type="checkbox" name="hobby[]" value="sports" {{ in_array('sports', $hobbies) ? 'checked' : '' }}> Sports</label>
                                    <label><input type="checkbox" name="hobby[]" value="reading" {{ in_array('reading', $hobbies) ? 'checked' : '' }}> Reading</label>
                                    <label><input type="checkbox" name="hobby[]" value="music" {{ in_array('music', $hobbies) ? 'checked' : '' }}> Music</label>
                                    <label><input type="checkbox" name="hobby[]" value="traveling" {{ in_array('traveling', $hobbies) ? 'checked' : '' }}> Traveling</label>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="city"> City: </label>
                                    <select id="city" name="city" class="form-control">
                                        <option value="">Select City</option>
                                        <option value="New York" {{ $product->city == 'New York' ? 'selected' : '' }}>New York</option>
                                        <option value="Los Angeles" {{ $product->city == 'Los Angeles' ? 'selected' : '' }}>Los Angeles</option>
                                        <option value="Chicago" {{ $product->city == 'Chicago' ? 'selected' : '' }}>Chicago</option>
                                        <option value="Houston" {{ $product->city == 'Houston' ? 'selected' : '' }}>Houston</option>
                                        <option value="Philadelphia" {{ $product->city == 'Philadelphia' ? 'selected' : '' }}>Philadelphia</option>
                                        <option value="Phoenix" {{ $product->city == 'Phoenix' ? 'selected' : '' }}>Phoenix</option>
                                        <option value="San Diego" {{ $product->city == 'San Diego' ? 'selected' : '' }}>San Diego</option>
                                        <option value="Dallas" {{ $product->city == 'Dallas' ? 'selected' : '' }}>Dallas</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="img">Image:</label>
                                    <input type="file" id="img" name="img" accept="image/*" class="form-control">
                                
                                    
                                    @if ($product->img != "")
                                        <img width="100" src="{{ asset('uploads/products/' . $product->img) }}" alt="">
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- second form for Education details --}}
                    <div class="card mb-5">
                        <div class="card-header mb-3 text-center">
                            <h2>Edit Education details</h2>
                        </div>
                        <div class="card-body addfild">
                            @if(isset($education) && $education !== null && !$education->isEmpty())
                                @foreach($education as $edu)
                                    <div class="education-details">
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label for="college">College/School Name :</label>
                                                <input value="{{ old('college', $edu->college) }}" type="text" name="college[]" class="form-control college">
                                                <span class="text-danger error-college"></span>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="year">Passing Year :</label>
                                                <input value="{{ old('year', $edu->year) }}" type="text" name="year[]" class="form-control year">
                                                <span class="text-danger error-year"></span>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label for="percentage">Percentage :</label>
                                                <input value="{{ old('percentage', $edu->percentage) }}" type="text" name="percentage[]" class="form-control percentage">
                                                <span class="text-danger error-percentage"></span>
                                            </div>
                                            <div class="form-group col-md-1 align-self-end">
                                                @if(!$loop->first)
                                                    <button type="button" class="btn btn-danger remove-education"><i class="fa fa-minus"></i></button>
                                                @else
                                                    <button type="button" class="btn btn-primary add-education"><i class="fa fa-plus"></i></button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="education-details">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="college">College/School Name :</label>
                                            <input type="text" name="college[]" class="form-control college">
                                            <span class="text-danger error-college"></span>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="year">Passing Year :</label>
                                            <input type="text" name="year[]" class="form-control year">
                                            <span class="text-danger error-year"></span>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="percentage">Percentage :</label>
                                            <input type="text" name="percentage[]" class="form-control percentage">
                                            <span class="text-danger error-percentage"></span>
                                        </div>
                                        <div class="form-group col-md-1 align-self-end">
                                            <button type="button" class="btn btn-primary add-education"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                   

                    {{--  varitation for add multipal imges --}}
                    <div class="card">
                        <div class="card-header mb-3 text-center">
                            <h2>Media Gallery</h2>
                        </div>
                        <div class="card-body">
                            <div class="multiple-img">
                                <div class="row">
                                    <div class="form-group">
                                        <label class="form-label">Images*</label>
                                        <div>
                                            <input type="file" id="files" name="files[]" multiple accept=".jpg, .jpeg, .png"/>
                                            @foreach($media as $media_item)
                                                <span class="pip">
                                                    <img class="imageThumb" src="{{ asset('media/uploads/products/'.$media_item->img) }}" title="">
                                                    <br/><span class="remove" onclick="deleteImage({{ $media_item->media_id }})">Remove image</span>
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- buttons  --}}
                    <div class="card-footer">
                        <button type="submit"  class="btn btn-success ">Update</button>
                        <a href="{{ route('index') }}" class="btn btn-secondary">Cancel</a>
                    </div> 

            </form>
        </div>
    </div>
</body>
</html>


{{-- validation for edit user --}}
<script>
    $(document).ready(function () {

        //form validation js
        var form = $('#myForm');  
        form.submit(function(e) {           
            $.ajax({
                url     : form.attr('action'),
                type    : form.attr('method'),
                data    : form.serialize(),
                dataType: 'json',
                async:false,
                success : function ( json )
                {         
                    return true; 
                },
                error: function( json )
                {           
                    if(json.status === 422) {
                        e.preventDefault();
                        var errors_ = json.responseJSON;
                        $.each(errors_.errors, function (key, value) {
                            //$('.'.key).prev().addClass('error-border');
                            $('.'+key).html("<i class='feather icon-info'></i> " +value);                       
                        });
                    } 
                }

            });

        });

    });
</script>



{{-- this is use for  variation and append education details --}}
<script>
    $(document).ready(function() {
        
        // Add Education
        $(".add-education").click(function() {
            validateFields();                    // Validate fields before adding new education field
            if ($('.is-invalid').length === 0) {                // Proceed if no validation errors
                appendEducationField();
            }
        });

        // Form submission
        $('#myForm').submit(function(e) {
            if (!validateFields()) {
                e.preventDefault();                      // Prevent form submission if there are validation errors
            }
        });

        // validation msg 
        function validateFields() {
            var isValid = true;

            $(".education-details").each(function() {
                var college = $(this).find('.college').val().trim();
                var year = $(this).find('.year').val().trim();
                var percentage = $(this).find('.percentage').val().trim();

                $(this).find('.college, .year, .percentage').removeClass('is-invalid').siblings('.error').text('');

                // Validate college field
                if (college === '') {
                    $(this).find('.college').addClass('is-invalid').siblings('.error').text('The college field is required.');
                    isValid = false;
                } else if (!/^[a-zA-Z\s]+$/.test(college)) {
                    $(this).find('.college').addClass('is-invalid').siblings('.error').text('The college field must be a string.');
                    isValid = false;
                } else if (college.length > 255) {
                    $(this).find('.college').addClass('is-invalid').siblings('.error').text('The college field must not exceed 255 characters.');
                    isValid = false;
                }

                // Validate year field
                if (year === '') {
                    $(this).find('.year').addClass('is-invalid').siblings('.error').text('The year field is required.');
                    isValid = false;
                } else if (isNaN(year) || year.length !== 4) {
                    $(this).find('.year').addClass('is-invalid').siblings('.error').text('The year field must be exactly 4 digits.');
                    isValid = false;
                }

                // Validate percentage field
                if (percentage === '') {
                    $(this).find('.percentage').addClass('is-invalid').siblings('.error').text('The percentage field is required.');
                    isValid = false;
                } else if (isNaN(percentage) || percentage < 0 || percentage > 100) {
                    $(this).find('.percentage').addClass('is-invalid').siblings('.error').text('The percentage field must be between 0 and 100.');
                    isValid = false;
                }
            });

            return isValid;
        }


        // Append education field
        function appendEducationField() {
            var educationField = `
                <div class="education-details">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="college">College/School Name :</label>
                            <input type="text" name="college[]" class="form-control college">
                            <span class="text-danger error college"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="year">Passing Year :</label>
                            <input type="text" name="year[]" class="form-control year">
                            <span class="text-danger error year"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="percentage">Percentage :</label>
                            <input type="text" name="percentage[]" class="form-control percentage">
                            <span class="text-danger error percentage"></span>
                        </div>
                        <div class="form-group col-md-1 align-self-end">
                            <button type="button" class="btn btn-danger remove-education"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                </div>
            `;
            $(".addfild").append(educationField);
        }

        // Remove Education details
        $(".addfild").on('click', '.remove-education', function() {
            $(this).closest('.education-details').remove();
        });
    });
</script>


<script>

    $(".removeImg").click(function() {
        $(this).parent(".pip").remove();
    });
    
    function deleteimage(id) {
        var url = $('#url').val();

        if (id != '') {
            if (confirm('Are you sure ?')) {

                $.ajax({
                    type: "post",
                    url: url + '/product/delete_image/' + id,
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        location.reload();
                    }
                });
            }
        }
    }


    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image-preview').attr('src', e.target.result);
                $('#image-preview').hide();
                $('#image-preview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#main_image").change(function() {
        readURL(this);
    });


    if (window.File && window.FileList && window.FileReader) {
    $("#files").on("change", function(e) {
        var files = e.target.files,
            filesLength = files.length;
        for (var i = 0; i < filesLength; i++) {
            var f = files[i];
            // Check file type
            if (f.type.match('image/jpeg') || f.type.match('image/jpg') || f.type.match('image/png')) {
                var fileReader = new FileReader();
                fileReader.onload = (function(e) {
                    var file = e.target;
                    $("<span class=\"pip\">" +
                        "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                        "<br/><span class=\"remove\">Remove image</span>" +
                        "</span>").insertAfter("#files");
                    $(".remove").click(function() {
                        $(this).parent(".pip").remove();
                    });
                });
                fileReader.readAsDataURL(f);
            } else {
                // Remove the file from the input
                $(this).val('');
                alert("File type not supported. Please select a JPG, JPEG, or PNG file.");
                return false; // Stop further processing
            }
        }
        console.log(files);
    });
    } else {
        alert("Your browser doesn't support the File API.");
    }

</script>

<script>
  $(document).ready(function() {
            $(".remove").click(function() {
                $(this).parent(".pip").remove();
            });
        });
</script>



{{-- <script>
      
    
    if (window.File && window.FileList && window.FileReader) {
        $("#files").on("change", function(e) {
            var files = e.target.files,
                filesLength = files.length;
            for (var i = 0; i < filesLength; i++) {
                var f = files[i];
                if (f.type.match('image/jpeg') || f.type.match('image/jpg') || f.type.match('image/png')) {
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        var file = e.target;
                        $("<span class=\"pip\">" +
                            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                            "<br/><span class=\"remove\" onclick=\"$(this).parent('.pip').remove();\">Remove image</span>" +
                            "</span>").insertAfter("#files");
                    });
                    fileReader.readAsDataURL(f);
                } else {
                    $(this).val('');
                    alert("File type not supported. Please select a JPG, JPEG, or PNG file.");
                    return false;
                }
            }
        });
    } else {
        alert("Your browser doesn't support the File API.");
    }
</script> --}}

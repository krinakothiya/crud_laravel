<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <div class="bg-dark py-3 mb-5">
        <h3 class="text-white text-center">LARAVEL CRUD OPERATION</h3>
    </div>
    <div class="row">
        <!-- [ form-element ] start -->
        <div class="col-sm-12">
            <form id="myForm" action="{{ route('user.store') }}" method="post" enctype="multipart/form-data" class=" container mt-4 p-3 bg-white">
                @csrf
                <div class="card mb-5">
                    <div class="card-header mb-3 text-center">
                        <h1> Create User Form</h1>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">Name:</label>
                                <input value="{{ old('name') }}" type="text" name="name" id="name" class="form-control">
                                <span class="text-danger error name"></span> <!-- This will display the error message for the 'name' field -->
                            </div>

                            <div class="form-group col-md-6">
                                <label for="phone">Phone:</label>
                                <input value="{{ old('phone') }}" type="tel" name="phone" id="phone" class="form-control">
                                <span class="text-danger error phone"></span>

                            </div>

                            <div class="form-group col-md-6">
                                <label for="age">Age:</label>
                                <input value="{{ old('age') }}" type="number" name="age" id="age" class="form-control">
                                <span class="text-danger error age"></span>

                            </div>

                            <div class="form-group col-md-6">
                                <label for="address">Address:</label>
                                <textarea value="{{ old('address') }}" name="address" id="address" rows="1" class="form-control"></textarea>
                                <span class="text-danger error address"></span>

                            </div>

                            <div class="form-group col-md-6">
                                <label>Gender:</label><br>
                                <div class="form-control">
                                    <label><input type="radio" name="gender" value="male"> Male</label>
                                    <label><input type="radio" name="gender" value="female"> Female</label>
                                    <label><input type="radio" name="gender" value="other"> Other</label>
                                </div>
                                <span class="text-danger error gender"></span>

                            </div>

                            <div class="form-group col-md-6">
                                <label for="hobby">Hobby:</label><br>
                                <div class="form-control">
                                    <label><input type="checkbox" name="hobby[]" value="sports"> Sports</label>
                                    <label><input type="checkbox" name="hobby[]" value="reading"> Reading</label>
                                    <label><input type="checkbox" name="hobby[]" value="music"> Music</label>
                                    <label><input type="checkbox" name="hobby[]" value="traveling"> Traveling</label>
                                </div>
                                <span class="text-danger error hobby"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="city">City:</label>
                                <select id="city" name="city" class="form-control">
                                    <option value="">Select City</option>
                                    <option value="New York">New York</option>
                                    <option value="Los Angeles">Los Angeles</option>
                                    <option value="Chicago">Chicago</option>
                                    <option value="Houston">Houston</option>
                                    <option value="Philadelphia">Philadelphia</option>
                                    <option value="Phoenix">Phoenix</option>
                                    <option value="San Diego">San Diego</option>
                                    <option value="Dallas">Dallas</option>
                                </select>
                                <span class="text-danger error city"></span>

                            </div>

                            <div class="form-group">
                                <label for="img">Image:</label>
                                <input value="{{ old('img') }}" type="file" name="img" id="img" accept="image/*" onchange="previewImage(event)">
                                <img id="img-preview" src="#" alt="Image Preview" style="display: none; max-width: 100px; max-height: 100px;">
                                <br>
                                <span class="text-danger kt-form__help error img"></span>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="checkbox">
                                    <input type="checkbox" name="checkbox" id="checkbox">
                                    <span class="checkmark text-dark"> Agree to terms and conditions</span>
                                </label>
                                <br>
                                <span class="text-danger error checkbox"></span>
                            </div>


                        </div>
                    </div>
                </div>

                {{-- second form for Education details --}}
                <div class="card">
                    <div class="card-header mb-3 text-center">
                        <h2>Education details</h2>
                    </div>
                    <div class="card-body">
                        <div class="education-details">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="college">College/School Name :</label>
                                    <input value="{{ old('college') }}" type="text" name="college[]" class="form-control college">
                                    <span class="text-danger error college"></span>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="year">Passing Year :</label>
                                    <input value="{{ old('year') }}" type="text" name="year[]" class="form-control year">
                                    <span class="text-danger error year"></span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="percentage">Percentage :</label>
                                    <input value="{{ old('percentage') }}" type="text" name="percentage[]" class="form-control percentage">
                                    <span class="text-danger error percentage"></span>
                                </div>
                                <div class="form-group col-md-1 align-self-end">
                                    <button id="addEducation" type="button" class="btn btn-primary add-education"><i class="fa fa-plus"></i></button>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                {{-- buttons  --}}
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <a href="{{ route('index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>




</body>

</html>

{{-- this use for img preview --}}
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var imgPreview = document.getElementById('img-preview');
            imgPreview.src = reader.result;
            imgPreview.style.display = 'block';
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

{{-- this validation for first form --}}
<script>
    $(document).ready(function() {

        //form validation js
        var form = $('#myForm');
        form.submit(function(e) {
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                dataType: 'json',
                async: false,
                success: function(json) {
                    // Handle success response, if needed     
                    return true;
                },
                error: function(json) {
                    if (json.status === 422) {
                        e.preventDefault();
                        var errors_ = json.responseJSON;

                        // Reset error messages
                        form.find('.text-danger.error').text('');

                        // Display error messages
                        $.each(errors_.errors, function(key, value) {
                            $('.' + key).html(value);
                            // "<i class='feather icon-info'></i> " +                    
                        });
                    }
                }

            });

        });

    });
</script>


{{-- this is use for second variation and append education details --}}
<script>
    $(document).ready(function() {
        // Add Education
        $("#addEducation").click(function() {
            validateFields(); // Validate fields before adding new education field
            if ($('.is-invalid').length === 0) { // Proceed if no validation errors
                appendEducationField();
            }
        });


        // Form submission
        $('#myForm').submit(function(e) {

            validateFields(); // Validate fields before form submission

            if ($('.is-invalid').length === 0) {
                var form = $(this);
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: form.serialize(),
                    dataType: 'json',
                    async: false,
                    success: function(json) {
                        // Handle success response, if needed     
                        return true;
                    },
                    error: function(json) {
                        if (json.status === 422) {
                            e.preventDefault();
                            var errors_ = json.responseJSON;

                            // Reset error messages
                            form.find('.text-danger.error').text('');

                            // Display error messages
                            $.each(errors_.errors, function(key, value) {
                                $('.' + key).html(value);
                                // "<i class='feather icon-info'></i> " +                    
                            });
                        }
                    }

                });
            }
        });
    });

    // validation msg 
    function validateFields() {
        $(".education-details input[type='text']").each(function() {
            var fieldName = $(this).attr('name');
            var fieldValue = $(this).val().trim();
            var errorMessage = '';

            switch (fieldName) {
                case 'college[]':
                    if (fieldValue === '') {
                        errorMessage = 'The college field is required.';
                    } else if (!/^[a-zA-Z\s]+$/.test(fieldValue)) {
                        errorMessage = 'The college field must be a string.';
                    } else if (fieldValue.length > 255) {
                        errorMessage = 'The college field must not exceed 255 characters.';
                    }
                    break;
                case 'year[]':
                    if (fieldValue === '') {
                        errorMessage = 'The year field is required.';
                    } else if (isNaN(fieldValue)) {
                        errorMessage = 'The year field must be a number.';
                    } else if (fieldValue.length !== 4) {
                        errorMessage = 'The year field must be exactly 4 digits.';
                    }
                    break;
                case 'percentage[]':
                    if (fieldValue === '') {
                        errorMessage = 'The percentage field is required.';
                    } else if (isNaN(fieldValue)) {
                        errorMessage = 'The percentage field must be a number.';
                    } else if (fieldValue < 0 || fieldValue > 100) {
                        errorMessage = 'The percentage field must be between 0 and 100.';
                    }
                    break;
                default:
                    break;
            }

            if (errorMessage !== '') {
                $(this).addClass('is-invalid');
                $(this).siblings('.error').text(errorMessage);
            } else {
                $(this).removeClass('is-invalid');
                $(this).siblings('.error').text('');
            }
        });
    }

    // append education field
    function appendEducationField() {
        var educationField = `
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
        `;
        $(".education-details").append(educationField);


        // Remove Education details
        $(".education-details").on('click', '.remove-education', function() {
            $(this).closest('.row').remove();
        });

    }
</script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LARAVEL</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="bg-dark py-3">
        <h3 class="text-white text-center">LARAVEL CRUD OPERATION</h3>
    </div>

    <div class="container my-5">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="{{ route('create') }}" class="btn btn-primary me-5 mt-4" role="button" style="text-decoration: none;">Add New</a>
        </div>
        @if (Session::has('success'))
        <div class="col-md-10">
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Age</th>
                    <th>Address</th>
                    <th>Gender</th>
                    <th>Hobby</th>
                    <th>City</th>
                    <th>Img</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($products->isNotEmpty())
                    @foreach ($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->phone}}</td>
                        <td>{{$product->age}}</td>
                        <td>{{$product->address}}</td>
                        <td>{{$product->gender}}</td>
                        <td>{{$product->hobby}}</td>
                        <td>{{$product->city}}</td>
                        {{-- <td>{{$product->img}}</td> --}}
                        <td>
                            @if ($product->img != "")
                              <img width="75" src="{{ asset('uploads/products/'.$product->img) }}" alt="">
                            @endif
                        </td>
                        <td>
                            <a class='btn btn-success' href='{{route('edit',$product->id)}}'>Edit</a>
                            <a href="#" onclick="deleteProduct({{ $product->id }});" class="btn btn-danger">Delete</a>
                            <form id="delete-product-from-{{ $product->id }}" action="{{ route('user.delete', $product->id) }}" method="post">
                                @csrf
                                @method('delete')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function deleteProduct(id){
            if (confirm("Are you sure you want to delete this product?")) {
                document.getElementById("delete-product-from-"+id).submit();
            }
        }
    </script>
</body>

</html>

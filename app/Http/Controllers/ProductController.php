<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserForm;
use App\Models\Education;
use App\Models\Media;

class ProductController extends Controller
{
    // 1) Show all users data in index page
    public function index()
    {
        $products = Product::all();
        return view('index', ['products' => $products]);
    }

    // 2) Show the form to create a new user
    public function create()
    {
        return view('create');
    }

    // Store a newly created user in the database
    public function store(UserForm $request)
    {

        if ($request->ajax()) {
            return true;
        }

        // Create a new user instance and save it to the database
        $product = new Product();
        $product->name = $request->input('name');
        $product->phone = $request->input('phone');
        $product->age = $request->input('age');
        $product->address = $request->input('address');
        $product->gender = $request->input('gender');
        $product->hobby = implode(',', $request->input('hobby'));
        $product->city = $request->input('city');

        // Handle image upload
        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $extension = $img->getClientOriginalExtension();                  // Get the original extension of the uploaded file
            $imgName = rand() . '.' . $extension;
            $img->move('uploads/products', $imgName);
        } else {
            $imgName = null; // Or set a default image name
        }

        $product->img = $imgName;              // Assign the image name
        $product->save();



        //  *********** Education Datails variation  *********** 

        // Create a user education details instance and save it to the database :
        $college = $request->college;          // Retrieve data from the request
        $year = $request->year;
        $percentage = $request->percentage;

        // Loop through the data and save each entry to the database
        foreach ($college as $index => $col) {
            $education = new Education();
            $education->id = $product->id;
            $education->college = $col;
            $education->year = $year[$index];
            $education->percentage = $percentage[$index];
            $education->save();
        }


        // ************ Add Multipal Imges ********** 
        if ($request->has('files')) {

            foreach ($request->file('files') as $file) {
                // dd($file);
                $extension = $file->getClientOriginalExtension();
                $filename1 = rand() . '.' . $extension;
                $file->move('media/uploads/products', $filename1);

                $media = new Media();
                $media->img = $filename1;
                $media->id =  $product->id;
                $media->save();
            }
        }


        // This line of code redirects the user to the index page
        return redirect()->route('index')->with('success', 'create User successfully');
    }



    // 3) Show the form to edit a user :
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $education = Education::where('id', $product->id)->get();  // Fetch education records related to the product's ID
        $media_img = Media::where('id', $product->id)->get(); // Fetch education records related to the product's ID

        return view('edit', [
            'product' => $product,              // it is use to fatch data from database
            'education' => $education,
            'media' => $media_img,
        ]);
    }

    public function deleteImage($id)
    {
        $media = Media::find($id);
        if ($media) {
            // Delete image from storage
            Storage::delete('media/uploads/products/' . $media->img);

            // Delete image record from the database
            $media->delete();

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Image not found.']);
        }
    }


    // Update the specified product in the database
    public function update(UserForm $request, $id)
    {
        // dd($request);
        if ($request->ajax()) {
            return true;
        }
        // Find the product by its ID
        $product = Product::findOrFail($id);

        // Update the user data from the request
        $product->name = $request->input('name');
        $product->phone = $request->input('phone');
        $product->age = $request->input('age');
        $product->address = $request->input('address');
        $product->gender = $request->input('gender');
        $product->hobby = implode(',', $request->input('hobby'));
        $product->city = $request->input('city');

        // Handle image upload
        if ($request->hasFile('img')) {
            // Delete the previous image if it exists
            File::delete(public_path('uploads/products/' . $product->img));

            // Upload the new image
            $img = $request->file('img');
            $extension = $img->getClientOriginalExtension();
            $imgName = rand() . '.' . $extension;
            $img->move('uploads/products', $imgName);

            // Assign the new image name to the product
            $product->img = $imgName;
        }
        //   dd($product);                    // it displays the contents of the variable $product and then stops further execution of the script

        // Save the updated product
        $product->save();


        // Update the user education details instance and save it to the database :
        $college = $request->college;          // Retrieve data from the request
        $year = $request->year;
        $percentage = $request->percentage;

        if ($college != "") {
            education::where('id', $id)->delete();
            // Loop through the data and save each entry to the database
            foreach ($college as $index => $col) {
                $education = new Education();
                $education->id = $product->id;
                $education->college = $col;
                $education->year = $year[$index];
                $education->percentage = $percentage[$index];
                $education->save();
            }
        }


        // ************ Update Multipal Imges ********** 
        if ($request->has('files')) {
            foreach ($request->file('files') as $file) {
                // dd($file);
                $extension = $file->getClientOriginalExtension();
                $filename1 = rand() . '.' . $extension;
                $file->move('media/uploads/products', $filename1);

                $media = new Media();
                $media->id =  $product->id;
                $media->img = $filename1;
                $media->save();
            }
        }

        // Redirect to the index page with a success message
        return redirect()->route('index')->with('success', 'User details updated successfully');
    }



    // 4) delete the specified user from the database : 
    public function delete($id)
    {
        $product = Product::findOrFail($id);                       //findOrFail is a method in Laravel's Eloquent ORM (Object-Relational Mapping) that is used to retrieve a model by its primary key.

        // Check if the image exists before attempting to delete it
        if (file_exists(public_path('uploads/products/' . $product->img))) {
            // delete image
            File::delete(public_path('uploads/products/' . $product->img));
        }

        // delete user from database
        $product->delete();
        return redirect()->route('index')->with('success', 'User deleted successfully.');
    }
}

<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\log;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\UserTbl;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $this->create($request->all());

        return redirect(RouteServiceProvider::HOME);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'image' => ['nullable', 'image', 'max:2048'], // Max file size: 2MB
        ]);
    }

    protected function create(array $data)
    { log::info($data);
        $photoPath = null;

        if ($data['photo_name']) {
            $photoPath = $data['photo_name']->store('profile_photos', 'public');
        }

            //     $request->validate([
            //         'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the allowed file types and maximum size as needed.
            //     ]);

            //     if ($request->hasFile('image')) {
            //         $imageData = file_get_contents($request->file('image')->getRealPath());
            //         $photo = new Photo([
            //             'name' => $request->file('image')->getClientOriginalName(),
            //             'image_data' => $imageData,
            //         ]);
            //         $photo->save();

            //         return redirect()->back()->with('success', 'Image uploaded successfully.');
            //     }

            //     return redirect()->back()->with('error', 'Failed to upload image.');
            // }

        return UserTbl::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'photo' => $photoPath,
        ]);
    }

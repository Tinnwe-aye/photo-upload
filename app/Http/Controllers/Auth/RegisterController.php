<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\log;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\user_tbl;
use Exception;
use GuzzleHttp\Psr7\Message;
use Illuminate\Database\QueryException;

class RegisterController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // $this->validator($request->all())->validate();
        // $this->create($request->all());
        // return redirect(RouteServiceProvider::HOME);
        $filename = '';
        if($request->image_name){
            if ($request->hasFile('photo')) {
                $imageData = file_get_contents($request->file('photo')->getRealPath());
                $file = $request->file('photo');
                $filename = $file->getClientOriginalName();
                $file->storeAs('images/',$filename);
                # store image 
                $storage_file = file(storage_path().'/app/images/'.$filename);
                $path = public_path().'/images';
                #move image
                $file->move($path,$filename);
            } else {
                $path = public_path().'/images';
                $filename = basename($request->image_name);
                $imageData = file_get_contents(storage_path().'/app/images/'.$filename);
            }
        }

        try{
            $rules = [
                'name' => ['required', 'string', 'max:255'],
                 //'email' => ['required', 'string', 'email', 'max:255', 'unique:user_tbls'],
                'username' => ['required', 'string', 'max:255', 'unique:user_tbls'],
                'password' => ['required', 'string', 'min:8'],
                'password_confirmation' => 'required',
                'image_name' => 'required',
                // 'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:50', // Adjust the allowed file types and maximum size as needed.
            ];

            $rules1 = [
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'password_confirmation' => 'required',];

            // validation
            $validator = Validator::make($request->all(), $rules);       
            if ($validator->fails()) {
                 return redirect()->back()->withInput()->with('old_image',$filename)->with('error', json_encode($validator->errors()->all()));
            }

             // validation
             $validator = Validator::make($request->all(), $rules1);       
             if ($validator->fails()) {
                 return redirect()->back()->withInput()->with('old_image',$filename)->with('error', json_encode($validator->errors()->all()));
             }

            //Save data
            if ($request->image_name) {
                $photo = new user_tbl([
                    'photo_name' => $filename,
                    'photo_data' => $imageData,
                    'name' => $request->name,
                    'email' => $request->email,
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                ]);
                $photo->save();

                log::info($path.'/'.$filename);
                if(file_exists($path.'/'.$filename)){
                    unlink($path.'/'.$filename);
                  }
                return redirect()->back()->with('success', 'Insert Data successfully.');
            }
            return redirect()->back()->withInput()->with('error', 'Failed to Save Data.');

        }catch(QueryException $e){
            if ($e->errorInfo[1] === 1406) {
                // Error code 1406 corresponds to "Data too long for column"
                return redirect()->back()->withInput()->with('error' ,"Data is too long for the column."); // Example JSON response
            } else {
                // Handle other database-related errors
                return redirect()->back()->withInput()->with('error' ,"A database error occurred: " . $e->getMessage()); // Example JSON response
            }            
        }
    }

    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:user_tbls'],
    //         'username' => ['required', 'string', 'max:255', 'unique:user_tbls'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //         'image' => ['nullable', 'image', 'max:2048'], // Max file size: 2MB
    //     ]);
    // }

    // protected function create(array $data)
    // { log::info($data);
        
    //     # Save only path
    //     $photoPath = null;
    //     if ($data['image']) {
    //         $photoPath = $data['image']->store('profile_photos', 'public');
    //         log::info($photoPath);
    //     }
    //     return user_tbl::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'username' => $data['username'],
    //         'password' => Hash::make($data['password']),
    //         'photo_name' => $photoPath,
    //     ]);
    //}
}

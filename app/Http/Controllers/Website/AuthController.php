<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\User\UpdateUserRequest;
use App\Http\Requests\Website\Auth\UserLoginRequest;
use App\Http\Requests\Website\User\ChangePasswordRequest;
use App\Http\Requests\Website\User\StoreUserRequest;
use App\Http\Requests\Website\User\UpdateProfileImageRequest;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    protected $_config;
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->_config = request('_config');
        $this->userRepository = $userRepository;
        $this->middleware('auth')->only(['logout', 'changePassword', 'updateProfile', 'showProfile', 'updateProfileImage', 'deleteProfileImage']);
    }

    // Display registration form
    public function register()
    {
        $pageConfigs = ['myLayout' => 'blank', 'myRTLSupport' => false];
        return view($this->_config['view'], ['pageConfigs' => $pageConfigs]);
    }

    // Handle user registration
    public function checkRegister(StoreUserRequest $request)
    {
        $data = $request->validated();
        $user = $this->userRepository->createOne($data);

        if (!$user) {
            $request->session()->put('error', 'Something Went Wrong');
            return redirect()->back();
        }

        // Automatically log in the newly registered user
        Auth::login($user);

        return redirect("/user")->with('success', trans("global.success_register"));
    }
    public function login()
    {
        $pageConfigs = ['myLayout' => 'blank', 'myRTLSupport' => false];
        return view($this->_config['view'], ['pageConfigs' => $pageConfigs]);
    }

    public function checkLogin(UserLoginRequest $request)
    {
        $remember_token = $request->remember_token == "on" ? 1 : false;
        $credentials = ['email' => $request->email, 'password' => $request->password];

        if (auth()->attempt($credentials, $remember_token)) {
            $user = auth()->user();
            Auth::logoutOtherDevices($request->get('password'));
            return redirect( "/user")->with('success', trans("global.success_login"));
        } else {
            $request->flash();
            return redirect()->route("user.login")->withInput()->withErrors([
                'email' => 'Error Email or Password',
                'password' => 'Error Email or Password',
            ]);
        }
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->put('success', trans("global.success_logout"));
        return redirect()->route('user.login');
    }
    public function changePassword(ChangePasswordRequest $request)
    {
        $user = Auth::user();
        if (!Hash::check($request->current_password, $user->password)) {
            $request->session()->put('error', 'current password is incorrect');
            return redirect()->back();
        }
        $data = $request->validated();
        $updated = $this->userRepository->changePassword($data['new_password'], $user->id);
        if ($updated) {
            return redirect()->route($this->_config['redirect'])->with('success', "user is updated successfully");
        } {
            $request->session()->put('error', 'Something Went Wrong');
            return redirect()->back();
        }
    }
    // Show user profile
    public function showProfile()
    {
        $userId = Auth::id();
        $item = $this->userRepository->withCount(['tasks', 'categories'])->where('id', $userId)->first();

        // Get the count of tasks grouped by status
        $taskCounts = DB::table('tasks')
            ->select('status', DB::raw('count(*) as count'))
            ->where('user_id', $userId)
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $pageConfigs = ['myLayout' => 'default', 'myRTLSupport' => false];

        return view($this->_config['view'], ['item' => $item, 'taskCounts' => $taskCounts, 'pageConfigs' => $pageConfigs]);
    }

    // Update user profile
    public function updateProfile(UpdateUserRequest $request)
    {
        $data = $request->validated();
        $userId = Auth::id();

        $updated = $this->userRepository->updateOne($data, $userId);

        if ($updated) {
            return redirect()->route($this->_config['redirect'])->with('success', "Profile updated successfully");
        } else {
            $request->session()->put('error', 'Something went wrong');
            return redirect()->back();
        }
    }
    // Update User Profile Image
    public function updateProfileImage(UpdateProfileImageRequest $request)
    {
        // Logic for updating the profile image
        $data = $request->validated();
        $userId = Auth::id();
        $updated = $this->userRepository->updateProfileImage($userId);

        if ($updated) {
            return redirect()->route($this->_config['redirect'])->with('success', 'Profile image updated successfully');
        } else {
            $request->session()->put('error', 'Something went wrong');
            return redirect()->back();
        }
    }

    // Delete User Profile Image
    public function deleteProfileImage()
    {
        $userId = Auth::id();
        $deleted = $this->userRepository->deleteProfileImage($userId);
        if ($deleted) {
            return redirect()->route($this->_config['redirect'])->with('success', 'Profile image deleted successfully');
        } {
            session()->put('error', 'Something went wrong');
            return redirect()->back();
        }
    }
}

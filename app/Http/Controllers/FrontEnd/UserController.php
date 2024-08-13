<?php

namespace App\Http\Controllers\FrontEnd;

use App\Consts;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Services\UserService;
use App\Models\AffiliateHistory;
use App\Models\AffiliatePayment;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function index()
    {
        if (!Auth::guard('web')->check()) {
            return redirect()->route('frontend.login');
        }

        $user = Auth::guard('web');
        $detail = UserService::getUsers(['id' => $user->id()])->first();

        $this->responseData['detail'] = $detail;

        return $this->responseView('frontend.pages.user.index');
    }

    public function loginForm()
    {

        if (Auth::guard('web')->check()) {
            return redirect()->back()->with('successMessage', __('Login successfully!'));
        }

        return view('frontend.pages.login');
    }

    public function signup(UserRegisterRequest $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]);
            $params = $request->all();
            $params['email_verification_code'] = Str::random(12);
            $user = UserService::createUser($params);
            DB::commit();
            session()->flash('successMessage', 'Signup successfully!');
            Mail::send(
                'frontend.emails.signup',compact('user'),
                function ($email) use ($user) {
                    $email->subject('Kích hoạt tài khoản của bạn');
                    $email->to($user->email,$user->name);
                }
            );
            return redirect()->back()->with('successMessage', __('Đăng ký thành công, truy cập Email để xác thực!'));
        }
        catch (Exception $ex) {
            DB::rollBack();
            abort(422, __($ex->getMessage()));
        }
    }

    public function verifyAccount($id="",$code ="")
    {
        if($id !="" && $code!=""){
            $params['status'] = Consts::USER_STATUS['active'];
            User::where('id',$id)->where('email_verification_code',$code)->update($params);
            return redirect()->route('frontend.home')->with('successMessage', __('Kích hoạt tài khoản thành công'));
        }
    }
    public function login(LoginRequest $request)
    {
        if (Auth::guard('web')->check()) {
            return redirect()->back()->with('successMessage', __('Login successfully!'));
        }
        try {
            $email = $request->email;
            $password = $request->password;
            $attempt = Auth::guard('web')->attempt([
                'email' => $email,
                'password' => $password,
                'status' => Consts::USER_STATUS['active']
            ]);
            if (!$attempt) {
                abort(401, __('Sai thông tin hoặc tài khoản chưa được xác nhận'));
            }
            return redirect()->back()->with('successMessage', __('Login successfully!'));
        } catch (Exception $ex) {
            return redirect()->back()->with('errorMessage', __('Sai thông tin hoặc tài khoản chưa được xác nhận'));
            // abort(422, __($ex->getMessage()));
        }
    }

    public function logout()
    {

        Auth::guard('web')->logout();
        // Cookie::queue(Cookie::forget('detail_users'));
        return redirect()->back()->with('successMessage', __('Logout successfully!'));
    }

}

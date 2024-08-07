<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;
use mysql_xdevapi\Exception;
use Twilio\Rest\Client;

//use Vonage\Client;
//use Vonage\Client\Credentials\Basic;
//use Vonage\SMS\Message\SMS;
class AuthController extends Controller
{
    public function loginIndex()
    {
        if (Auth::guard('web')->check()) {
            Session::flush();
            Auth::guard('web')->logout();
            return redirect()->route('user.login.index');
        }
        return view('user.auth.login');
    }

    public function login(Request $request)
    {
        $lang = $request->header('Accept-Language') ?? 'en';
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|exists:users,email',
            'password' => 'required|max:300',
        ]);
        if($validator->fails()){
            return response()->json([
                "status" => false,
                "errors" => $validator->errors(),
            ]);
        }

        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = User::where('email',$request->email)->first();
//            if ($user->is_verified){
                auth()->login($user);
                $user['token'] =  $user->createToken('MyApp')->plainTextToken;
                return response()->json([
                    "status" => 200,
                    "message" => $lang == 'ar' ? "تم الدخول بنجاح" : "Login Successfully",
                    'data' => $user
                ]);
//            }else{
//                $verify_code = rand(10000, 99999);
//                $verify_code = 12345;
//                $user->verify_code = $verify_code;
//                $basic  = new Basic(config('app.NEXMO_API_KEY'), config('app.NEXMO_API_SECRET'));
//                $client = new Client($basic);
//                $message = new SMS($user->phone, config('app.NEXMO_SMS_FROM'), "Confirm your mobile number: $verify_code\n");
//                $response = $client->sms()->send($message);
//                $ress = $response->current();
//                if ($ress->getStatus() == 0) {
//                    return response()->json([
//                        "status" => 200,
//                        'success' => true,
//                        "message" => $lang == 'ar' ? " برجى تأكيد رقم الهاتف" : "Please verify phone number",
//                    ]);
//                } else {
//                    return response()->json([
//                        "status" => $ress->getStatus(),
//                        'success' => false,
//                        "message" => "The message failed with status",
//                    ]);
//                }
//            }

        } else {
            $errors = new MessageBag();
            $errors->add('Error', $lang == 'ar' ? "عذراً ، خطأ في البيانات" : "The data is wrong");
            return response()->json([
                "status" => false,
                "message" => $errors,
            ]);
        }
    }

    public function register(Request $request)
    {
        $lang = $request->header('Accept-Language') ?? 'en';
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:1',
            'phone' => 'nullable|numeric|unique:users,phone',
            'image' => 'nullable|image'
        ]);
        if ($validation->fails()) {
            return response()->json([
                "status" => 403,
                'success' => false,
                "errors" => $validation->errors(),
            ]);
        }
        $input = $request->all();

        if (isset($input['image'])) {
            $file = $input['image'];
            $input['image'] = $file->store('images', 'public');
        }

        $input['password'] = Hash::make($input['password']);
        $input['num_system'] = 1;

//        $verify_code = rand(10000, 99999);
        $verify_code = 12345;
        $input['verify_code'] = $verify_code;
        $input['is_verified'] = true;
        $user = User::create($input);
        auth()->login($user);
        $user['token'] =  $user->createToken('MyApp')->plainTextToken;
        return response()->json([
            "status" => 200,
            "message" => $lang == 'ar' ? "تم الدخول بنجاح" : "Login Successfully",
            'user' => $user
        ]);
//      geterate code and send save code
//
//        $basic  = new Basic(config('app.NEXMO_API_KEY'), config('app.NEXMO_API_SECRET'));
//        $client = new Client($basic);
//        $message = new SMS($user->phone, config('app.NEXMO_SMS_FROM'), "Confirm your mobile number: $verify_code\n");
//        $response = $client->sms()->send($message);
//        $ress = $response->current();
//        if ($ress->getStatus() == 0) {
//            return response()->json([
//                "status" => 200,
//                'success' => true,
//                "message" => "تم تسجيل المستخدم بنجاح ، برجى تأكيد رقم الهاتف",
//                'user' => $user,
//            ]);
//        } else {
//            return response()->json([
//                "status" => $ress->getStatus(),
//                'success' => false,
//                "message" => "The message failed with status",
//            ]);
//        }

//        $twilio = new Client(config('app.TWILIO_SID'), config('app.TWILIO_AUTH_TOKEN'));
//
//        try {
//            $twilio->messages->create(
//                "whatsapp:" . $user->phone,
//                [
//                    "from" => "whatsapp:" . config('app.TWILIO_WHATSAPP_SENDER'),
//                    "body" => 'Confirm your mobile number: '.$verify_code
//                ]
//            );
//            return response()->json([
//                "status" => 200,
//                'success' => true,
//                "message" => " برجى تأكيد رقم الهاتف",
//                "user" => $user
//            ]);
//        }catch (\Exception $e){
//            return response()->json([
//                "status" => 500,
//                'success' => false,
//                "message" => $e->getMessage(),
//            ]);
//        }

    }
    public function loginRegister(Request $request)
    {
        $lang = $request->header('Accept-Language') ?? 'en';
        $email = $request->input('email');
        $user = User::where('email',$email)->first();
        if ($user){
            auth()->login($user);
            $user['token'] =  $user->createToken('MyApp')->plainTextToken;
            return response()->json([
                "status" => 200,
                "message" => $lang == 'ar' ? "تم الدخول بنجاح" : "Login Successfully",
                'user' => $user
            ]);
        }else{
            $validation = Validator::make($request->all(), [
                'name' => 'required|string|min:3|max:200',
                'email' => 'required|email|unique:users,email',
                'image' => 'nullable|url'
            ]);
            if ($validation->fails()) {
                return response()->json([
                    "status" => 403,
                    'success' => false,
                    "errors" => $validation->errors(),
                ]);
            }
            $input = $request->all();
//
//            if (isset($input['image'])) {
//                $file = $input['image'];
//                $input['image'] = $input['image'];
//            }
            $input['num_system'] = 1;
            $input['is_verified'] = 1;
            $input['password'] = Hash::make(Str::random(25));
            $user = User::create($input);
            auth()->login($user);
            $user['token'] =  $user->createToken('MyApp')->plainTextToken;

            return response()->json([
                "status" => 200,
                'success' => true,
                "user" => $user,
                "message" => $lang == 'ar' ? "تم الدخول بنجاح" : "Login Successfully",
            ]);

        }


    }
//    public function verifyCode(Request $request){
//        $validator = Validator::make($request->all(),[
//            'code_number' => 'required|numeric|digits:5',
//        ]);
//        if($validator->fails()){
//            return response()->json([
//                "status" => false,
//                "errors" => $validator->errors(),
//            ]);
//        }
//        $user = auth()->user();
//        if ($request->code_number == auth()->user()->verify_code && !auth()->user()->is_verified){
//            $user->is_verified = true;
//            $user->save();
//            return response()->json([
//                "status" => 200,
//                'success' => true,
//                "message" => "تم تسجيل المستخدم بنجاح",
//            ]);
//        }else{
//            return response()->json([
//                "status" => 500,
//                'success' => false,
//                "message" => "خطأ في الكود",
//            ]);
//        }
//    }

    public function logout(Request $request)
    {
        $lang = $request->header('Accept-Language') ?? 'en';
        Session::flush();
        Auth::guard('web')->logout();
        return response()->json([
            "status" => 200,
            'success' => true,
            "message" => $lang == 'ar' ? "تم تسجيل خروج مستخدم بنجاح" : "Logout Successfully",
        ]);
    }
}

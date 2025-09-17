<?php
namespace App\Http\Controllers;

use App\Models\CategoryDefault;
use App\Models\CategoryUser;
use App\Models\User;
use App\Models\UserActivity;
use App\Models\UserSessionApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AppEndpointsController extends Controller
{
    /**
     * Handle the incoming request to app login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {

            $user_session_app = UserSessionApp::create([
                'user_id' => Auth::user()->id,
                'uuid'    => Str::uuid(),
                'start'   => time(),
                'expire'  => time() + 31536000,       // Expira em um ano
                'os_name' => $request->os_name ?? '', // Nome do sistema operacional do dispositivo
            ]);

            UserActivity::create([
                'user_id'     => Auth::user()->id,
                'route'       => $request->path(),
                'ip'          => $request->ip(),
                'is_ajax'     => $request->ajax(),
                'method'      => $request->method(),
                'accessed_at' => now(),
            ]);
            $cliente_id = Auth::user()->cliente_id;
            $user_id    = Auth::user()->id;

            $user = User::selectRaw("
                    users.id,
                    users.uuid,
                    users.email_verified_at,
                    users.email,
                    CONCAT('" . env('APP_URL') . "','/user/profile/image/', users.uuid)
                        AS photoUrl,
                    users.name,
                    users.created_at,
                    users.updated_at")
                ->where('users.id', $user_id)
                ->first();
            $user->first_name   = remove_first_name($user->name);
            $categorias_padroes = CategoryDefault::all();
            foreach ($categorias_padroes as $value) {
                $category_user                      = new CategoryUser();
                $category_user->user_id             = $user->id;
                $category_user->category_default_id = $value->id;
                $category_user->name                = $value->name;
                $category_user->type                = $value->type;
                $category_user->icon                = $value->icon;
                $category_user->color               = $value->color;
                $category_user->save();
            }
            return response()->json([
                'status'  => 'success',
                'message' => 'App login successfully',
                'data'    => [
                    'token' => base64_encode(Auth::user()->uuid . ':' . $user_session_app->uuid),
                    'user'  => $user,
                ],
            ], 200);
        }
        return response()->json([
            'status'  => 'error',
            'message' => 'Invalid credentials',
        ], 401);
    }
    /**
     * Handle the incoming request to app logout.
     *
     * @param Request $request
     *
     * @return [type]
     *
     */
    public function logout(Request $request)
    {
        $uuid_session = UserSessionApp::parser_authorization($request->header('Authorization'));
        if (empty($uuid_session)) {
            return response()->json(['status' => 'error', 'message' => __('User not authenticated or session expired, logout registred')], 200);
        }
        $user = UserSessionApp::check($uuid_session);
        if (! $user) {
            return response()->json(['status' => 'error', 'message' => __('User not authenticated or session expired, logout registred')], 200);
        }

        $user_session_app = UserSessionApp::where('uuid', $uuid_session)->first();
        if (! $user_session_app) {
            return response()->json(['status' => 'error', 'message' => __('User not authenticated or session expired, logout registred')], 200);
        }

        $user_session_app->exit_session = time();
        $user_session_app->save();

        return response()->json(['message' => 'App logout successfully'], 200);
    }
    /**
     * Handle the incoming request to app forgot password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function forgot_password(Request $request)
    {
        return response()->json(['message' => 'Password reset link sent successfully'], 200);
    }

    /**
     * Handle the incoming request to get user details.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function user_me(Request $request)
    {
        $uuid_session = UserSessionApp::parser_authorization($request->header('Authorization'));
        if (empty($uuid_session)) {
            return response()->json(['status' => 'error', 'message' => __('User not authenticated')], 401);
        }
        $user = UserSessionApp::check($uuid_session);

        if ($user) {
            return response()->json([
                'status' => 'success',
                'data'   => [
                    'id'              => $user->id,
                    'uuid'            => $user->uuid,
                    'name'            => $user->name,
                    'email'           => $user->email,
                    'emailVerifiedAt' => $user->email_verified_at,
                    'photoUrl'        => env('APP_URL') . '/user/profile/image/' . $user->uuid,
                    'createdAt'       => $user->created_at,
                    'updatedAt'       => $user->updated_at,
                ],
            ], 200);
        }
        return response()->json(['status' => 'error', 'message' => __('User not authenticated')], 401);
    }

    /**
     * Registra um novo usuario
     *
     * @param Request $request
     *
     * @return [type]
     *
     */
    public function register(Request $request)
    {
        DB::beginTransaction();

        try {
            User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => bcrypt($request->password),
            ]);

            if (Auth::attempt($request->only('email', 'password'))) {

                $user_session_app = UserSessionApp::create([
                    'user_id' => Auth::user()->id,
                    'uuid'    => Str::uuid(),
                    'start'   => time(),
                    'expire'  => time() + 31536000,       // Expira em um ano
                    'os_name' => $request->os_name ?? '', // Nome do sistema operacional do dispositivo
                ]);

                UserActivity::create([
                    'user_id'     => Auth::user()->id,
                    'route'       => $request->path(),
                    'ip'          => $request->ip(),
                    'is_ajax'     => $request->ajax(),
                    'method'      => $request->method(),
                    'accessed_at' => now(),
                ]);
                $cliente_id = Auth::user()->cliente_id;
                $user_id    = Auth::user()->id;

                $user = User::selectRaw("
                    users.id,
                    users.uuid,
                    users.email_verified_at,
                    users.email,
                    CONCAT('" . env('APP_URL') . "','/user/profile/image/', users.uuid)
                        AS photoUrl,
                    users.name,
                    users.created_at,
                    users.updated_at")
                    ->where('id', $user_id)
                    ->first();
                $user->first_name = explode(' ', $user->name)[0];

                DB::commit();
                return response()->json([
                    'status'  => 'success',
                    'message' => 'App login successfully',
                    'data'    => [
                        'token' => base64_encode(Auth::user()->uuid . ':' . $user_session_app->uuid),
                        'user'  => $user,

                    ],
                ], 200);
            }
            DB::rollback();
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'status'  => 'error',
                'message' => 'App register fail',
                'data'    => [],
            ], 400);

        }

    }
    /**
     * Retorna a lista de categorias do usuario
     *
     * @param Request $request
     *
     * @return [type]
     *
     */
    public function user_categories(Request $request)
    {
        $uuid_session = UserSessionApp::parser_authorization($request->header('Authorization'));
        if (empty($uuid_session)) {
            return response()->json(['status' => 'error', 'message' => __('User not authenticated')], 401);
        }

        $user = UserSessionApp::check($uuid_session);

        if (! $user) {
            return response()->json(['status' => 'error', 'message' => __('User not authenticated')], 401);
        }

        $categorias = CategoryUser::where('user_id',$user->id)->get();

        return response()->json([
            'status' => 'success',
            'data'   => $categorias,
        ], 200);
    }
}

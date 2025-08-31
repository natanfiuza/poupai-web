<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Projeto;
use App\Models\Reuniao;
use App\Classes\TObject;
use App\Models\Colaborador;
use App\Models\ConfigGeral;
use Illuminate\Support\Str;
use App\Models\ReuniaoLocal;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Models\UserSessionApp;
use Illuminate\Support\Facades\DB;
use App\Models\ReuniaoParticipante;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

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
                    colaboradors.id AS colaborador_id,
                    colaboradors.cliente_id,
                    colaboradors.pais_id,
                    users.uuid,
                    users.email_verified_at,
                    users.email,
                    CONCAT('" . env('APP_URL') . "','/user/profile/image/', users.uuid)
                        AS photoUrl,
                    colaboradors.uuid
                        AS colaborador_uuid,
                    colaborador_dados_extras.matricula,
                    users.name,
                    colaboradors.nome_social,
                    colaboradors.cpf,
                    colaboradors.sexo,
                    colaboradors.cep,
                    colaboradors.endereco,
                    colaboradors.numero,
                    colaboradors.complemento,
                    colaboradors.bairro,
                    colaboradors.cidade,
                    colaboradors.estado,
                    colaboradors.nascimento_data,
                    colaboradors.is_user,
                    colaboradors.user_id,
                    colaborador_nivel_academicos.nome
                        AS nivel_academico_nome,
                    setors.id
                        AS setor_id,
                    setors.nome
                        AS setor_nome,
                    funcaos.id
                        AS funcao_id,
                    funcaos.nome
                        AS funcao_nome,
                    colaborador_ano_bases.admissao_data,
                    colaboradors.created_at,
                    colaboradors.updated_at")
                ->leftjoin('colaboradors', 'colaboradors.cpf', 'users.cpf')
                ->leftjoin('colaborador_ano_bases', 'colaborador_ano_bases.colaborador_id', 'colaboradors.id')
                ->leftjoin('colaborador_dados_extras', 'colaborador_dados_extras.colaborador_id', 'colaboradors.id')
                ->leftJoin('colaborador_nivel_academicos', 'colaborador_nivel_academicos.id', '=', 'colaborador_ano_bases.nivel_academico_id')
                ->leftJoin('funcaos', 'funcaos.id', '=', 'colaborador_dados_extras.funcao_id')
                ->leftJoin('setors', 'setors.id', '=', 'colaborador_dados_extras.setor_id')
                ->where('users.id', $user_id)
                ->groupBy('colaboradors.id')
                ->orderBy('colaboradors.name')
                ->first();
            File::put(storage_path('app/user_do_login_app.json'), $user->toJson());

            return response()->json([
                'status'  => 'success',
                'message' => 'App login successfully',
                'data'    => [
                    'token' => base64_encode(Auth::user()->uuid . ':' . $user_session_app->uuid),
                    'user'  => $user,
                    // 'user'  => [
                    //     'id'              => Auth::user()->id,
                    //     'uuid'            => Auth::user()->uuid,
                    //     'name'            => Auth::user()->name,
                    //     'email'           => Auth::user()->email,
                    //     'emailVerifiedAt' => Auth::user()->email_verified_at,
                    //     'photoUrl'        => env('APP_URL') . '/user/profile/image/' . Auth::user()->uuid,
                    //     'createdAt'       => Auth::user()->created_at,
                    //     'updatedAt'       => Auth::user()->updated_at,
                    // ]
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

   

}

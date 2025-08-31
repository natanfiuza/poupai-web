<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserSession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
     /**
     * Exibe a imagem de perfil do usuario a partir do uuid
     *
     * @param Request $request
     * @param mixed $uuid
     *
     * @return ImageFile
     *
     */
    public function profile_image(Request $request, $uuid)
    {
        $user = User::where('uuid', $uuid)->first();

        if (! $user) {
            $path     = public_path("/assets/img/nouser.jpg");
            $mimeType = File::mimeType($path);
            return response()->file($path, ['Content-Type' => $mimeType]);
        }

        ! File::exists(public_path(DIRECTORY_SEPARATOR . env('PATH_PUBLIC_STORAGE', 'storage') . DIRECTORY_SEPARATOR . env('PATH_USERS_DOCUMENTS_PROFILE_IMAGE', 'user_profile_photos') . DIRECTORY_SEPARATOR . $user->uuid))
        ? User::create_initials_profile_image($user->name,$user->uuid)
        : null;

        $path = File::exists(public_path(DIRECTORY_SEPARATOR . env('PATH_PUBLIC_STORAGE', 'storage') . DIRECTORY_SEPARATOR . env('PATH_USERS_DOCUMENTS_PROFILE_IMAGE', 'user_profile_photos') . DIRECTORY_SEPARATOR . $user->uuid))
        ? public_path(DIRECTORY_SEPARATOR . env('PATH_PUBLIC_STORAGE', 'storage') . DIRECTORY_SEPARATOR . env('PATH_USERS_DOCUMENTS_PROFILE_IMAGE', 'user_profile_photos') . DIRECTORY_SEPARATOR . $user->uuid)
        : public_path("/assets/img/nouser.jpg");

        // Verifica se o arquivo existe no caminho construído
        if (! File::exists($path)) {
            $path     = public_path("/assets/img/nouser.jpg");
            $mimeType = File::mimeType($path);
            return response()->file($path, ['Content-Type' => $mimeType]);
        }

        // Determina o tipo MIME da imagem para o cabeçalho Content-Type
        $mimeType  = File::mimeType($path);
        $image_url = asset(env('PATH_PUBLIC_STORAGE', 'storage') . '/' . env('PATH_USERS_DOCUMENTS_PROFILE_IMAGE', 'user_profile_photos') . '/' . $user->uuid);

        return Redirect::to($image_url);

        // return response()->json([
        //     'status'  => 'ok',
        //     'message' => __('Imagem de perfil carregada com sucesso.'),
        //     'data'    => [
        //         'path'      => $path,
        //         'mimeType'  => $mimeType,
        //         'uuid'      => $user->uuid,
        //         'image_url' => asset(env('PATH_PUBLIC_STORAGE', 'storage') . '/' . env('PATH_USERS_DOCUMENTS_PROFILE_IMAGE', 'user_profile_photos') . '/' . $user->uuid),
        //     ],
        // ], 200);
        // return response()->file($path, ['Content-Type' => $mimeType]);

    }
    /**
     * Recebe o arquivo da imagem de perfil do usuario e atualiza
     *
     * @param Request $request
     *
     * @return [type]
     *
     */
    public function upload_image_profile(Request $request)
    {
        $uuid_session = explode(' ', $request->header('Authorization'))[1];

        $user = UserSession::check_user($uuid_session);

        $validator = Validator::make($request->all(), [
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Valida o arquivo
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        if ($request->hasFile('profile_image')) {

            create_storage_directories(env('PATH_STORAGE_PUBLIC_DOCUMENTS', 'public'), env('PATH_USERS_DOCUMENTS_PROFILE_IMAGE', 'user_profile_photos'));

            $file = $request->file('profile_image');
            $file->move(storage_path('app/' . env('PATH_STORAGE_PUBLIC_DOCUMENTS', 'public') . '/' . env('PATH_USERS_DOCUMENTS_PROFILE_IMAGE', 'user_profile_photos')), $user->uuid);

            $user->save();

            return response()->json(['status' => 'ok', 'message' => 'Imagem de perfil atualizada com sucesso!', 'uuid' => $user->uuid]);
        }

        return response()->json(['status' => 'error', 'message' => 'Nenhum arquivo de imagem foi enviado.'], 400);
    }

}

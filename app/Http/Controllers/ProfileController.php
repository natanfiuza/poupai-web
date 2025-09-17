<?php
namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\CategoryDefault;
use App\Models\CategoryUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status'          => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        
        $categorias_padroes = CategoryDefault::all();
        foreach ($categorias_padroes as $value) {
            $category_user                      = new CategoryUser();
            $category_user->user_id             = 1;
            $category_user->category_default_id = $value->id;
            $category_user->name                = $value->name;
            $category_user->type                = $value->type;
            $category_user->icon                = $value->icon;
            $category_user->color               = $value->color;
            $category_user->save();
        }

        $categorias = CategoryUser::where('user_id', 1)->get();

        File::put(storage_path('logs/categorias.json'), json_encode(
            [
                'status' => 'success',
                'data'   => $categorias,
            ]));

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

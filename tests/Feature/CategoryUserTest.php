<?php
namespace Tests\Feature;

use App\Models\CategoryDefault;
use App\Models\CategoryUser;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class CategoryUserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
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

    }
}

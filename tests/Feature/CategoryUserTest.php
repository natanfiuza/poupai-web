<?php
namespace Tests\Feature;

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

        $categorias = CategoryUser::where('user_id',1)->get();

        File::put(storage_path('logs/categorias.json'), json_encode(
            [
                'status' => 'success',
                'data'   => $categorias,
            ]));

    }
}

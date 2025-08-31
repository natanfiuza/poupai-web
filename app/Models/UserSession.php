<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSession extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "user_id",
        "uuid",
        "start",
        "expire",
        "last_activity",
        "exit_session",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    /**
     * Valida se o uuid passado da sessao esta valido e não expirou
     *
     * @param string $uuid_session
     *
     * @return bool
     *
     */
    public static function is_valid($uuid_session)
    {
        return self::whereRaw("uuid = '$uuid_session'")
            ->whereNull('exit_session')
            ->whereRaw("'" . time() . "' < expire")
            ->exists();

    }
    public static function check_user($uuid_session)
    {

        return User::whereRaw("id = '" .
            self::whereRaw("uuid = '$uuid_session'")
                ->whereNull('exit_session')
                ->whereRaw("'" . time() . "' < expire")
                ->get()[0]->user_id . "'"
        )->get()[0];

    }
}

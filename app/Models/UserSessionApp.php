<?php
namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Registra as seções ativas dos usuarios pelo aplicativo
 */
class UserSessionApp extends Model
{


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
        'os_name',
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
    /**
     * Retorna o registro de  session corrente do uuid passado
     *
     * @param mixed $uuid_session
     *
     * @return UserSessionApp
     *
     */
    public static function current($uuid_session)
    {
        return self::whereRaw("uuid = '$uuid_session'")
            ->whereNull('exit_session')
            ->whereRaw("'" . time() . "' < expire")
            ->first();
    }
    /**
     * Verifica se a session esta ativa e nao expirou
     *
     * @param mixed $uuid_session
     *
     * @return [type]
     *
     */
    public static function check($uuid_session)
    {

        if (! self::is_valid($uuid_session)) {
            return null;
        }
        return User::whereRaw("id = '" .
            self::whereRaw("uuid = '$uuid_session'")
                ->whereNull('exit_session')
                ->whereRaw("'" . time() . "' < expire")
                ->get()[0]->user_id . "'"
        )->first();

    }

    /**
     * Recebe um token authorazion no formato base64 e retornar o uuid de UserSessionApp->uuid
     *
     * @param mixed $token
     *
     * @return [type]
     *
     */
    public static function parser_authorization($authorizarion_token)
    {
        if (empty(trim($authorizarion_token))) {
            return '';
        }
        try {
            return explode(':', base64_decode(explode(' ', $authorizarion_token)[1]))[1];
        } catch (Exception $e) {
            return '';
        }
    }
}

<?php

namespace App\Http\Middleware;

use App\Http\Controllers\FriendsController;
use App\User;
use Closure;

class CheckPrivateChatRules
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $companionId = intval($request->route()->parameter('id'));
        $exist = User::findOrFail($companionId);
        if(!FriendsController::isFriend($companionId))
            return redirect()->back()->withErrors(['error' => 'Данный пользователь не является вашим другом']);
        return $next($request);
    }
}

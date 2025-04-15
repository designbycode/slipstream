<?php

    namespace App\Http\Middleware;

    use Closure;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Session;
    use Symfony\Component\HttpFoundation\Response;

    class InvalidateOtherSessions
    {
        /**
         * Handle an incoming request.
         *
         * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
         */
        public function handle(Request $request, Closure $next): Response
        {
            // Only process for authenticated users
            if (!Auth::check()) {
                return $next($request);
            }

            // Only process if using database sessions
            if (config('session.driver') !== 'database') {
                return $next($request);
            }

            $user = $request->user();
            $currentSessionId = Session::getId();

            // 1. Check if current session is still valid
            $session = DB::connection(config('session.connection'))
                ->table(config('session.table', 'sessions'))
                ->where('id', $currentSessionId)
                ->where('user_id', $user->getAuthIdentifier())
                ->first();

            // If session doesn't exist or is expired, log out
            if (!$session || $this->isSessionExpired($session)) {
                Auth::logout();
                Session::flush();
                return redirect()->route('login');
            }

            // 2. Clean up any other expired sessions for this user
            DB::connection(config('session.connection'))
                ->table(config('session.table', 'sessions'))
                ->where('user_id', $user->getAuthIdentifier())
                ->where('id', '!=', $currentSessionId)
                ->where('last_activity', '<', now()->subMinutes(config('session.lifetime'))->getTimestamp())
                ->delete();

            return $next($request);
        }

        protected function isSessionExpired($session): bool
        {
            return $session->last_activity < now()->subMinutes(config('session.lifetime'))->getTimestamp();
        }
    }

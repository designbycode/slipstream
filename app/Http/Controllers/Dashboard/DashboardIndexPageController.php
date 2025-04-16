<?php

    namespace App\Http\Controllers\Dashboard;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controllers\HasMiddleware;
    use Illuminate\View\View;

    class DashboardIndexPageController extends Controller implements HasMiddleware
    {
        /**
         * @return string[]
         */
        public static function middleware(): array
        {
            return ['auth', 'auth.session', 'verified'];
        }

        /**
         * Handle the incoming request.
         */
        public function __invoke(Request $request): View
        {
            return view("dashboard.index");
        }
    }

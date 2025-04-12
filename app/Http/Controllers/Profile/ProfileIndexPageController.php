<?php

    namespace App\Http\Controllers\Profile;

    use App\Http\Controllers\Controller;
    use Illuminate\Routing\Controllers\HasMiddleware;
    use Illuminate\View\View;

    class ProfileIndexPageController extends Controller implements HasMiddleware
    {

        /**
         * @return string[]
         */
        public static function middleware(): array
        {
            return ['auth', 'verified'];
        }

        /**
         * @return \Illuminate\View\View
         */
        public function __invoke(): View
        {
            return view("profile.index");
        }
    }

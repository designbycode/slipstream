<?php

    namespace App\Livewire\Profile;

    use App\Helpers\Agent;
    use Carbon\Carbon;
    use Illuminate\Support\Collection;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
    use Illuminate\View\View;
    use Livewire\Attributes\On;
    use Livewire\Component;

    class LogoutOtherBrowserSessionsForm extends Component
    {
        public bool $confirmingLogout = false;
        public string $password = '';

        public function confirmLogout(): void
        {
            $this->password = '';
            $this->dispatch('openModal', 'profile.modals.confirm-password', data: [
                'title' => 'Logout other browser sessions',
                'description' => 'Please provide your password to confirm you would like to log out of all other browser sessions across all devices.']);
            $this->confirmingLogout = true;
        }

        #[On('password-confirmed')]
        public function confirmPassword($password): void
        {
            $this->password = $password;
            if (config('session.driver') !== 'database') {
                return;
            }
            $this->resetErrorBag();

            // 1. Get current session ID before any changes
            $currentSessionId = session()->getId();

            // 2. Invalidate other sessions FIRST
            $this->deleteOtherSessionRecords($currentSessionId);

            // 3. Force logout other devices
            Auth::logoutOtherDevices($this->password);

            // 4. Completely regenerate current session
            session()->invalidate();
            session()->regenerateToken();

            // 5. Manually set auth cookie for current session
            Auth::login(Auth::user());

            $this->confirmingLogout = false;
            $this->dispatch('loggedOut');

        }

        protected function deleteOtherSessionRecords(string $currentSessionId): void
        {
            DB::connection(config('session.connection'))
                ->table(config('session.table', 'sessions'))
                ->where('user_id', Auth::id())
                ->where('id', '!=', $currentSessionId)
                ->delete();
        }
        

        public function getSessionsProperty(): Collection
        {
            if (config('session.driver') !== 'database') {
                return collect();
            }

            return collect(
                DB::connection(config('session.connection'))
                    ->table(config('session.table', 'sessions'))
                    ->where('user_id', Auth::id())
                    ->orderBy('last_activity', 'desc')
                    ->get()
            )->map(function ($session) {
                return (object)[
                    'agent' => $this->createAgent($session),
                    'ip_address' => $session->ip_address,
                    'is_current_device' => $session->id === session()->getId(),
                    'last_active' => Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
                ];
            });
        }

        protected function createAgent($session): Agent
        {
            return tap(new Agent(), fn ($agent) => $agent->setUserAgent($session->user_agent));
        }


        public function render(): View
        {
            return view('livewire.profile.logout-other-browser-sessions-form');
        }
    }

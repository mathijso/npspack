<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use LemonSqueezy\Laravel\Subscription;

new class extends Component {
    public string $name = '';
    public string $email = '';
    public ?Subscription $subscription = null;
    public bool $isAdmin = false;
    public string $customerPortalUrl = '';
    public string $packageType = 'none';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->isAdmin = $user->isAdmin();
        $this->packageType = $user->package_type;

        if (!$this->isAdmin) {
            $this->subscription = $user->subscription();
            if ($this->subscription) {
                try {
                    $this->customerPortalUrl = $user->customerPortalUrl();
                } catch (\Exception $e) {
                    logger()->error('Could not generate customer portal URL for user: ' . $user->id, ['error' => $e->getMessage()]);
                }
            }
        }
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id)
            ],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section class="w-full space-y-8">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your name and email address')">
        <form wire:submit="updateProfileInformation" class="w-full my-6 space-y-6">
            <flux:input wire:model="name" :label="__('Name')" type="text" required autofocus autocomplete="name" />

            <div>
                <flux:input wire:model="email" :label="__('Email')" type="email" required autocomplete="email" />

                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
                    <div>
                        <flux:text class="mt-4">
                            {{ __('Your email address is unverified.') }}

                            <flux:link class="text-sm cursor-pointer" wire:click.prevent="resendVerificationNotification">
                                {{ __('Click here to re-send the verification email.') }}
                            </flux:link>
                        </flux:text>

                        @if (session('status') === 'verification-link-sent')
                            <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </flux:text>
                        @endif
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}</flux:button>
                </div>

                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>
    
         <div class="w-full my-6 space-y-4">
            @if ($isAdmin)
                 <div class="p-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-900 dark:text-blue-300">
                    You have administrator access (Pro Plan).
                 </div>
             @elseif ($subscription)
                 <div>
                     <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Current Plan:</p>
                     <p class="text-sm text-gray-600 dark:text-gray-400">{{ $subscription->variant->name ?? 'N/A' }}</p>
                 </div>
                 <div>
                     <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Status:</p>
                     <p class="text-sm text-gray-600 capitalize dark:text-gray-400">{{ $subscription->status() ?? 'N/A' }}</p>
                 </div>
                 @if($subscription->onGracePeriod())
                    <div>
                         <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Ends on:</p>
                         <p class="text-sm text-gray-600 dark:text-gray-400">{{ $subscription->ends_at?->isoFormat('LL') ?? 'N/A' }}</p>
                     </div>
                 @elseif($subscription->renews_at)
                     <div>
                         <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Renews on:</p>
                         <p class="text-sm text-gray-600 dark:text-gray-400">{{ $subscription->renews_at?->isoFormat('LL') ?? 'N/A' }}</p>
                     </div>
                 @endif
                 
                 @if($customerPortalUrl)
                     <div class="pt-4">
                        <a href="{{ $customerPortalUrl }}" target="_blank"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                            Manage Subscription
                        </a>
                    </div>
                 @endif
             @else 
                <div class="p-4 text-sm text-gray-700 bg-gray-100 rounded-lg dark:bg-gray-700 dark:text-gray-300">
                    You do not have an active subscription.
                 </div>
                 <div class="pt-2">
                     <a href="{{ route('subscribe') }}"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                        Choose a Plan
                    </a>
                 </div>
             @endif
        </div>
        <livewire:settings.delete-user-form />
        
    </x-settings.layout>

    
</section>

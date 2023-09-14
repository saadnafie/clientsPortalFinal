<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Phone') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's Phone Number") }}
        </p>
    </header>

    <form method="post" action="#" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <p class="mt-1 text-sm text-gray-600">
            Current Phone Number: <{{auth()->user()->country_code}}{{auth()->user()->phone}}>
        </p>

        <div>
            <x-input-label for="new_phone" :value="__('New Phone Number')" />
            <x-text-input id="new_phone" name="new_phone" type="text" class="mt-1 block w-full" autocomplete="new-phone" required/>
            <x-input-error :messages="$errors->updatePhone->get('new_pahone')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button disabled>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'new-phone')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

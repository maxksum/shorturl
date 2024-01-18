<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New link') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <form method="post" action="{{ route('forms.create') }}" class="mt-6 space-y-6">
                                @csrf
                                @method('post')

                                <div>
                                    <x-input-label for="original_url" :value="__('Original url')" />
                                    <x-text-input id="original_url" name="original_url" type="text" class="mt-1 block w-full" required autofocus autocomplete="original_url" />
                                    <x-input-error class="mt-2" :messages="$errors->get('link')" />
                                </div>

                                <div>
                                    <x-input-label for="short_url" :value="__('Short url')" />
                                    <x-text-input id="short_url" name="short_url" type="text" class="mt-1 block w-full" required autofocus autocomplete="short_url" />
                                    <x-input-error class="mt-2" :messages="$errors->get('short_link')" />
                                </div>

                                <div>
                                    <x-input-label for="comment" :value="__('Comment')" />
                                    <x-text-input id="comment" name="comment" type="text" class="mt-1 block w-full" autofocus autocomplete="comment" />
                                    <x-input-error class="mt-2" :messages="$errors->get('comment')" />
                                </div>

                                <div class="flex items-center gap-4">
                                    <x-primary-button>{{ __('Save') }}</x-primary-button>

                                    @if (session('status') === 'link-created')
                                        <p
                                            x-data="{ show: true }"
                                            x-show="show"
                                            x-transition
                                            x-init="setTimeout(() => show = false, 2000)"
                                            class="text-sm text-gray-600"
                                        >{{ __('Saved.') }}</p>
                                    @elseif (session('status') === 'link-failed')
                                        <p
                                            x-data="{ show: true }"
                                            x-show="show"
                                            x-transition
                                            x-init="setTimeout(() => show = false, 2000)"
                                            class="text-sm text-red-600"
                                        >{{ __('Not saved.') }}</p>
                                    @endif
                                </div>
                            </form>
                        </header>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

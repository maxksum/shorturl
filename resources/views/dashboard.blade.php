<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Original url
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Short url
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Clicks
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Unique users
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Comment
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($links as $link)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="{{ $link->original_url }}">{{ $link->original_url }}</a>
                            </th>
                            <td class="px-6 py-4">
                                {{ url('') . '/' . $link->short_url }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $link->getStatsCount() }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $link->getUniqueStatsCount() }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $link->comment }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center bg-zinc-100">
        <div>
            <table class=" divide-y divide-x divide-gray-300 m-10 pl-12 shadow-2xl">
                <thead>
                <tr class="py-5">
                    <td class="whitespace-nowrap pl-12 py-6 text-center font-semibold">Date</td>
                    <td class="whitespace-nowrap pl-12 pr-20 py-6 text-center font-semibold">Nr of rates</td>
                </tr>
                </thead>
                <tbody>
                    @foreach($days as $day)
                        <tr class="hover:scale-105 hover:shadow-sm">
                            <td class="whitespace-nowrap pl-12 py-6">{{ $day->date }}</td>
                            <td>
                                <div class="flex justify-center">
                                    <a href="/bank/{{ $bankId }}/date/?date={{ $day->date }}">
                                        <button class="text-white bg-zinc-600 hover:bg-yellow-400 font-medium rounded-lg text-sm
                                            px-5 py-2.5 text-center">
                                                {{ $day->count }}
                                        </button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

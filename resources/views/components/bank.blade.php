@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center flex-row m-10 pb-10">
        @foreach($rates as $date=>$rate)
            <table class="ml-20 shadow-2xl">
                <thead class="bg-gray-50">
                <tr>
                    <th colspan="3" class="px-3 pt-3 pb-1 pr-3 text-center font-semibold">{{ $bank["name"] }}</th>
                </tr>
                <tr>
                    <th colspan="3" class="px-3 pb-1 pr-3 text-center font-semibold">{{ $bank["abbreviation"] }}</th>
                </tr>
                <tr>
                    <th colspan="3" class="px-3 py-0 pr-3 text-center font-semibold">{{ $data }}</th>
                </tr>
                <tr>
                    <th class="whitespace-nowrap px-10 py-2">Currency</th>
                    <th class="whitespace-nowrap px-10 py-2">Currency</th>
                    <th class="whitespace-nowrap px-10 py-2">Value</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                @foreach($rate as $actualRate)
                    <tr>
                        <td class="whitespace-nowrap px-10 py-4 text-sm">{{ $actualRate['currency1'] }}</td>
                        <td class="whitespace-nowrap px-10 py-4 text-sm">{{ $actualRate['currency2'] }}</td>
                        <td class="whitespace-nowrap px-10 py-4 text-sm">{{ $actualRate['value'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endforeach
    </div>
@endsection

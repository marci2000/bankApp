@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center bg-zinc-100">
        <div>
            <table class=" divide-y divide-x divide-gray-300 m-10 pl-12 shadow-2xl">
                <thead>
                <tr class="py-5">
                    <td class="whitespace-nowrap pl-12 py-6 text-center font-semibold">User's Name</td>
                    <td class="whitespace-nowrap pl-12 py-6 text-center font-semibold">Bank's Name</td>
                    <td class="whitespace-nowrap pl-12 py-6 text-center font-semibold">From</td>
                    <td class="whitespace-nowrap pl-12 py-6 text-center font-semibold">To</td>
                    <td class="whitespace-nowrap pl-12 py-6 text-center font-semibold">Value</td>
                    <td class="whitespace-nowrap pl-12 py-6 text-center font-semibold">Under/Above</td>
                    <td class="whitespace-nowrap pl-12 py-6 text-center font-semibold">Sent</td>
                    <td class="whitespace-nowrap pl-12 pr-12 py-6 text-center font-semibold">Date of sending</td>
                </tr>
                </thead>
                <tbody>
                @foreach($subscriptions as $subscription)
                    <tr class="hover:scale-105 hover:shadow-sm"  href="/user/{{$user["id"]}}">
                        <td class="whitespace-nowrap pl-12 py-6">{{ $subscription->user->name }}</td>
                        <td class="whitespace-nowrap pl-12 py-6">{{ $subscription->bank->name }}</td>
                        <td class="whitespace-nowrap pl-12 py-6">{{ $subscription->currency1 }}</td>
                        <td class="whitespace-nowrap pl-12 py-6">{{ $subscription->currency2 }}</td>
                        <td class="whitespace-nowrap pl-12 py-6">{{ $subscription->currency1 }}</td>
                        <td class="whitespace-nowrap pl-12 py-6">
                            @if($subscription->under == 1)
                                Yes
                            @else
                                No
                            @endif
                        </td>
                        <td class="whitespace-nowrap pl-12 py-6">
                            @if($subscription->sent == 1)
                                Yes
                            @else
                                No
                            @endif
                        </td>
                        <td class="whitespace-nowrap pl-12 py-6 pr-12">
                            @if($subscription->sent == 1)
                                {{ $subscription->date_sent }}
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

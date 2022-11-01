@extends('layouts.app')

@section('content')
    <div class="bg-zinc-100">
    <div class="grid grid-cols-3 gap-5 bg-zinc-200 py-20 shadow-2xl">
        @foreach($banks as $bank)
            <a href="/bank/{{$bank["id"]}}">
            <div class="p-10 bg-white m-10 shadow-2xl hover:scale-110">
                <p class="pb-3 text-center"> <span class="font-bold text-lg text-left"> {{ $bank["name"] }} </span></p>

                <table>
                    <tr>
                        <td>Bank name:</td>
                        <td class="px-3 py-2"><span class="font-bold text-lg">{{ $bank["abbreviation"] }}</span></td>
                    </tr>
                    <tr>
                        <td>Last updated:</td>
                        <td class="px-3 py-2">
                            <span class="font-bold text-lg">
                            @php
                                echo date("F j, Y, g:i a",strtotime($bank["updated"]));
                            @endphp
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Active: </td>
                        <td class="px-3 py-2">
                            @if ($bank["is_active"])
                                <span class="font-bold text-lg"> yes </span>
                            @else
                                <span class="font-bold text-lg"> no </span>
                            @endif
                        </td>
                    </tr>
                </table>

                @admin
                    <form method="POST" action="/activate">
                        @csrf
                        <div class="flex justify-center">
                            <input type="hidden" id="bank" name="bank" value="{{ $bank['id'] }}" />
                            <div class="flex justify-center">
                                <button type="submit" class="text-white bg-zinc-600 hover:bg-yellow-400 font-medium rounded-lg text-sm w-full
                                    px-5 py-2.5 text-center mt-5">
                                    @if($bank['is_active'])
                                        Deactivate
                                    @else
                                        Activate
                                    @endif
                                </button>
                            </div>
                        </div>
                    </form>
                @endadmin
            </div>
            </a>
        @endforeach
    </div>
    </div>
@endsection

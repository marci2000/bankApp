@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center bg-zinc-100 bg-zinc-100">
        <div >
        <table class="divide-y divide-x divide-gray-300 m-10 pl-12 shadow-2xl ">
            <thead>
                <tr class="py-5">
                    <td class="whitespace-nowrap pl-12 py-6 text-center font-semibold">Name</td>
                    <td class="whitespace-nowrap pl-12 py-6 text-center font-semibold">E-mail</td>
                    <td class="whitespace-nowrap pl-12 pr-12 py-6 text-center font-semibold">Role</td>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="hover:scale-105 hover:shadow-sm" href="/user/{{$user["id"]}}">
                        <td class="whitespace-nowrap pl-12 py-6"><a href="user/{{ $user["id"] }}">{{ $user["name"] }}</a></td>
                        <td class="whitespace-nowrap pl-12 py-6"><a href="user/{{ $user["id"] }}">{{ $user["email"] }}</a></td>
                        <td class="whitespace-nowrap pl-12 pr-12  py-6">
                            <a href="user/{{ $user["id"] }}">
                                @if ( $user["is_admin"] == 0 )
                                    User
                                @else
                                    Admin
                                @endif
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    <div class="mx-10 pb-10">
        {{ $users->links() }}
    </div>
@endsection

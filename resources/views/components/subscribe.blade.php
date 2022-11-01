@extends('layouts.app')

@section('content')
        <div class="flex min-h-full items-center justify-center py-12 px-4">
            <div class="w-full max-w-md space-y-8 bg-gray-50 rounded-lg shadow-lg">
                <div class="text-center pt-8 text-xl font-bold">Subscription for notification</div>

                <form method="POST" action="/subscribe">
                    @csrf

                    <div class="row mb-3">
                        <label for="bank-dropdown" class="col-md-4 col-form-label text-md-end pl-10">Bank</label>

                        <div class="col-md-6">
                            <select id="bank-dropdown" name="bankName" class="ml-8 mb-5 border border-1 border-gray-200 hover:border-gray-400 bg-white shadow-lg w-4/5 rounded-md p-3 hover:bg-zinc-100">
                                <option value="" id="" class="text-center">-- Select The Bank --</option>
                                @foreach($banks as $bank)
                                    <option value="{{ $bank["name"] }}" id="{{ $bank["id"] }}" class="text-center">{{ $bank["abbreviation"] }} ({{ $bank["name"] }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="currency1-dropdown" class="col-md-4 col-form-label text-md-end pl-10">From</label>

                        <div class="col-md-6">
                            <select id="currency1-dropdown" name="currency1" class="ml-8 mb-5 border border-1 border-gray-200 hover:border-gray-400 bg-white shadow-lg w-4/5 rounded-md p-3 hover:bg-zinc-100">
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="currency2-dropdown" class="col-md-4 col-form-label text-md-end pl-10">To</label>

                        <div class="col-md-6">
                            <select id="currency2-dropdown" name="currency2" class="ml-8 mb-5 border border-1 border-gray-200 hover:border-gray-400 bg-white shadow-lg w-4/5 rounded-md p-3 hover:bg-zinc-100">
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="limit" class="col-md-4 col-form-label text-md-end pl-10">Limit</label>

                        <div class="col-md-6">
                            <input id="limit" type="number" step="any"
                                   class="ml-8 mb-5 border border-1 border-gray-200 hover:border-gray-400 hover:bg-zinc-100 shadow-lg h-10 w-4/5 rounded-md p-3 form-control"
                                   name="value" value="{{ old('value') }}" required autocomplete=0 autofocus>
                        </div>

                        @error('limit')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <label for="under" class="col-md-4 col-form-label text-md-end pl-10">Under/Above the limit</label>

                        <div class="col-md-6">
                            <select id="under" name="under" class="ml-8 mb-5 border border-1 border-gray-200 hover:border-gray-400 bg-white shadow-lg w-4/5 rounded-md p-3 hover:bg-zinc-100">
                                <option value="{{ 1 }}" class="text-center">Under</option>
                                <option value="{{ 0 }}" class="text-center">Above</option>
                            </select>

                            @error('under')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4 flex justify-center mb-10">
                            <button type="submit" class="text-white bg-zinc-600 hover:bg-yellow-400 font-medium rounded-lg text-sm w-full
                                sm:w-auto px-5 py-2.5 text-center">
                                Subscribe
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(document).ready(function () {

                $('#bank-dropdown').on('change', function () {
                    const bankName = this.value;
                    $("#currency1-dropdown").html('');
                    $.ajax({
                        url: "{{url('/currency1')}}",
                        type: "GET",
                        data: {
                            bankName: bankName
                        },
                        dataType: 'json',
                        success: function (result) {
                            $('#currency1-dropdown').html('<option value="" class="text-center">-- Select Currency1 --</option>');
                            $.each(result, function (key,value) {
                                $("#currency1-dropdown").append('<option value="' + value
                                    .currency1 + '" class="text-center" >' + value.currency1 + '</option>');
                            });
                            $('#currency2-dropdown').html('<option value="" class="text-center">-- Select Currency2 --</option>');
                        }
                    });

                    $("#currency2-dropdown").html('');
                    $.ajax({
                        url: "{{url('/currency2')}}",
                        type: "GET",
                        data: {
                            bankName: bankName,
                        },
                        dataType: 'json',
                        success: function (res) {
                            $.each(res, function (key, value) {
                                $("#currency2-dropdown").append('<option value="' + value
                                    .currency2 + '" class="text-center" >' + value.currency2 + '</option>');
                            });
                        }
                    });
                });
            });
        </script>
@endsection

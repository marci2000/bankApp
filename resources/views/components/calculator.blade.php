@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-full py-12 px-10">
        <div class="w-full max-w-md space-y-8 bg-gray-50 rounded-lg shadow-lg">
            <div class="text-center pt-8 text-xl font-bold">Calculator</div>

            <form method="POST" action="/calculate">
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
                    <label for="date-dropdown" class="col-md-4 col-form-label text-md-end pl-10">Date</label>

                    <div class="col-md-6">
                        <select id="date-dropdown" name="date" class="ml-8 mb-5 border border-1 border-gray-200 hover:border-gray-400 bg-white shadow-lg w-4/5 rounded-md p-3 hover:bg-zinc-100">
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="currency2-dropdown" class="col-md-4 col-form-label text-md-end pl-10">From</label>

                    <div class="col-md-6">
                        <select id="currency2-dropdown" name="currency2" class="ml-8 mb-5 border border-1 border-gray-200 hover:border-gray-400 bg-white shadow-lg w-4/5 rounded-md p-3 hover:bg-zinc-100">
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="currency1-dropdown" class="col-md-4 col-form-label text-md-end pl-10">To</label>

                    <div class="col-md-6">
                        <select id="currency1-dropdown" name="currency1" class="ml-8 mb-5 border border-1 border-gray-200 hover:border-gray-400 bg-white shadow-lg w-4/5 rounded-md p-3 hover:bg-zinc-100">
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="value" class="col-md-4 col-form-label text-md-end pl-10">Amount of money</label>
                    <div class="col-md-6">
                        <input id="value" type="number" step="any"
                               class="ml-8 mb-5 border border-1 border-gray-200 hover:border-gray-400 shadow-lg h-10 w-4/5 rounded-md p-3 form-control hover:bg-zinc-100"
                               name="value" value="{{ old('value') }}" required autocomplete=0 autofocus>
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4 flex justify-center mb-10">
                        <button type="submit" class="text-white bg-zinc-600 hover:bg-yellow-400 font-medium rounded-lg text-sm w-full
                                sm:w-auto px-5 py-2.5 text-center ">
                            Calculate
                        </button>
                    </div>
                </div>
            </form>
        </div>

        @if($result !=null)
        <div class="p-10 bg-white ml-20 shadow-2xl hover:scale-110">
            <table>
                <tr>
                    <td>
                        <form method="POST" action="/activate">
                            @csrf
                            <div class="flex justify-center">
                                <input type="hidden" id="bank" name="bank" value="{{ $bank['id'] }}" />
                                <div class="flex justify-center">
                                    <div class="h-30 w-100">
                                        <div class="text-center pt-8 text-xl font-bold">Result</div>
                                        <div class="text-center pt-8 text-xl font-bold">{{ $result }}</div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </td>
            </table>
        </div>
        @endif

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#bank-dropdown').on('change', function () {
                const bankName = this.value;
                $("#date-dropdown").html('');
                $.ajax({
                    url: "{{url('/dates')}}",
                    type: "GET",
                    data: {
                        bankName: bankName
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#date-dropdown').html('<option value="" class="text-center">-- Select Date --</option>');
                        $.each(result, function (key,value) {
                            $("#date-dropdown").append('<option value="' + value.date +
                                '" class="text-center" >' + value.date + '</option>');
                        });
                    }
                });
            });

            $('#date-dropdown').on('change', function () {
                const date = this.value;
                let bankName = document.getElementById("bank-dropdown").value;
                $("#currency1-dropdown").html('');
                $.ajax({
                    url: "{{url('/currency1')}}",
                    type: "GET",
                    data: {
                        bankName: bankName,
                        date: date,
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#currency1-dropdown').html('<option value="" class="text-center">-- Select Currency2 --</option>');
                        $.each(res, function (key, value) {
                            $("#currency1-dropdown").append('<option value="' + value
                                .currency1 + '" class="text-center" >' + value.currency1 + '</option>');
                        });
                    }
                });

                $("#currency2-dropdown").html('');
                $.ajax({
                    url: "{{url('/currency2')}}",
                    type: "GET",
                    data: {
                        bankName: bankName,
                        date: date,
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#currency2-dropdown').html('<option value="" class="text-center">-- Select Currency1 --</option>');
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

@extends('app')
@section('title', 'تایید  و ورود به سیستم')
@section('css')@endsection
@section('content')

    @if(Session::has('status'))
        <div>
            {{Session::get('status')}}
            @php
            Session::forget('status');
            @endphp
        </div>
    @endif
    
    <form method="post">
        @csrf
        <div class="form-floating">
            <input type="text" id="code" name="code" class="form-control" minlength="6" maxlength="6" required>
            <label for="code">Confirm Code</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary mt-5" type="submit">Confirm</button>
    </form>
@endsection
@section('js')@endsection

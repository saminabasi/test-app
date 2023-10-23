@extends('app')
@section('title', 'ورود یا ثبت نام')
@section('css')@endsection
@section('content')
    <form method="post">
        @csrf
        <div class="form-floating">
            <input type="text" id="mobile" name="mobile" class="form-control" minlength="11" maxlength="11" required>
            <label for="mobile">Mobile</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary mt-5" type="submit">Login Or Register</button>
    </form>
@endsection
@section('js')@endsection

@extends('layouts.admin')
@section('content')
<p class="eyebrow">Administrator account</p><h1>Change your password.</h1><section class="panel" style="max-width:650px"><p>Choose at least 12 characters with uppercase, lowercase and numbers.</p><form method="post" action="/admin/account">@csrf @method('PUT')<label>Current password<input type="password" name="current_password" autocomplete="current-password" required></label><label>New password<input type="password" name="password" autocomplete="new-password" minlength="12" required></label><label>Confirm new password<input type="password" name="password_confirmation" autocomplete="new-password" minlength="12" required></label><button class="primary" data-save>Change password</button></form></section>
@endsection

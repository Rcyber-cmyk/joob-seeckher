<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div>
        <label for="email">Email</label>
        <input id="email" type="email" name="email" :value="old('email')" required autofocus />
    </div>

    <div>
        <button type="submit">
            Email Password Reset Link
        </button>
    </div>
</form>
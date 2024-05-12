@extends('app')
<div class="main_container">
    <form>
        <h5 class="text-center">Login</h5>
        <input id="username" type="text" placeholder="Login Id" class="form-control mt-3">
        <input id="password" type="password" placeholder="Password"  class="form-control">
        <button id="btn_login" type="submit" class="btn btn-primary mt-3">Login</button>
        <a href="/register" class="text-center">Create Account</a>
        <a href="/" class="text-center">Back to Homepage</a>
    </form>
</div>
@extends('app')
<div class="user">
    <form class="user __register">
        <h5>Create your Account</h5>
        <input id="name" type="text" placeholder="Name"  class="form-control mt-3">
        <input id="username" type="text" placeholder="Login Id" class="form-control">
        <input id="password" type="password" placeholder="Password"  class="form-control">
        <button id="btn_register" type="submit" class="btn btn-primary mt-3">Register</button>
        <a href="/signin" class="text-center">Back to Login</a>
    </form>
</div>
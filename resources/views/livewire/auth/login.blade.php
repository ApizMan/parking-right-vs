<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <img src="{{ asset('images/logo_ccp.png') }}" alt="logo">
                                <h3 class="text-center font-weight-light my-4">Parking Right</h3>
                            </div>
                            <div class="card-body">
                                <form wire:submit='save'>
                                    <div class="form-floating mb-3">
                                        <input class="form-control @error('username') is-invalid @enderror"
                                            id="inputEmail" type="email" placeholder="name@example.com"
                                            wire:model='username' />
                                        <label for="inputEmail">Username</label>
                                        <div class="text-danger">
                                            @error('username')
                                            {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control @error('password') is-invalid @enderror"
                                            id="inputPassword" type="password" wire:model='password'
                                            placeholder="Password" />
                                        <label for="inputPassword">Password</label>
                                        <div class="text-danger">
                                            @error('password')
                                            {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 text-center">
                                        <a class="small" style="text-decoration: none;" href="password.html">Forgot
                                            Password?</a>
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-primary" type="submit">Login</button>
                                    </div>
                                </form>
                            </div>
                            {{-- <div class="card-footer text-center py-3">
                                <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
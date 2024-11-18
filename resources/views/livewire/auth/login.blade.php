<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <center>
                                    <img src="{{ asset('assets/images/logo_ccp.png') }}" alt="logo" width="200">
                                </center>
                                <h3 class="text-center font-weight-light my-4"><b>Parking Right</b></h3>
                            </div>
                            <div class="card-body">
                                @if (session()->has('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif
                                <form wire:submit='save'>
                                    <div class="form-floating mb-3">
                                        <input class="form-control @error('email') is-invalid @enderror" id="inputEmail"
                                            type="email" placeholder="name@example.com" wire:model='email' />
                                        <label for="inputEmail">Email</label>
                                        <div class="text-danger">
                                            @error('email')
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
                                    <div class="form-check mb-3">
                                        <input type="checkbox" wire:model="remember" id="remember"
                                            class="form-check-input">
                                        <label for="remember" class="form-check-label">Remember Me</label>
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-primary" type="submit">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
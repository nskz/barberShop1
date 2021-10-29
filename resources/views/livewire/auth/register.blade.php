<main class="main container">

    <div class="row justify-content-center align-items-center">
        <form action="" class="bg_blur_light p-4 col-12 col-md-6 my-5 shadow ">
            <i class="fas fa-user-lock fa-3x d-block text-center my-3"></i>
            <h5 class="text-center">Register</h5>
            <div class="form-group row justify-content-center">
                <input type="text" class="form-control rounded_5 col-10 col-md-8  shadow" placeholder="first name" wire:model="data.firstName">
                @error('data.firstName')
                <small>{{$message}}</small>
                @enderror
            </div>
            <div class="form-group row justify-content-center">
                <input type="text" class="form-control rounded_5 col-10 col-md-8  shadow" placeholder="last name" wire:model="data.lastName">
                @error('data.lastName')
                <small>{{$message}}</small>
                @enderror
            </div>
            <div class="form-group row justify-content-center">
                <input type="text" class="form-control rounded_5 col-10 col-md-8  shadow" placeholder="email" wire:model="data.email">
                @error('data.email')
                <small>{{$message}}</small>
                @enderror
            </div>
            <div class="form-group row justify-content-center">
                <input type="text" class="form-control rounded_5 col-10 col-md-8  shadow" placeholder="phone number" wire:model="data.phoneNumber">
                @error('data.phoneNumber')
                <small>{{$message}}</small>
                @enderror
            </div>
            <div class="form-group row justify-content-center">
                <input type="password" class="form-control rounded_5 col-10 col-md-8  shadow" placeholder="password" wire:model="data.password">
                @error('data.password')
                <small>{{$message}}</small>
                @enderror
            </div>
            <div class="form-group row justify-content-center">
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control rounded_5 col-10 col-md-8  shadow" placeholder="confirm password" wire:model="data.password_confirmation">
                @error('data.password_confirmation')
                <small>{{$message}}</small>
                @enderror
            </div>
            <div class="form-group row justify-content-center">
                <input type="checkbox" class="form-control outline_0 box_shadow_0 border-0 h-auto" wire:model="data.policy">
                <a href="#" class="text-info mx-2">I accept the terms of use</a>
                @error('data.policy')
                <small>{{$message}}</small>
                @enderror
            </div>
            <div class="form-group row justify-content-center">
                <button type="button" class="btn btn-success rounded_5 px-5 shadow-sm" wire:click="handleRegister">Register</button>
            </div>
        </form>

    </div>

</main>


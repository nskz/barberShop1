<main class="main container">

    <div class="row justify-content-center align-items-center">
        <form action="" class="bg_blur_light p-4 col-12 col-md-6 my-5 shadow ">
            <i class="fas fa-user-check fa-3x d-block text-center my-3"></i>
            <h5 class="text-center">Login</h5>
            <div class="form-group row justify-content-center">
                <input type="text" wire:model="data.email" class="form-control rounded_5 col-10 col-md-8 shadow" placeholder="email">
                @error('data.email')
                <small>{{$message}}</small>
                @enderror
            </div>
            <div class="form-group row justify-content-center">
                <input type="password" wire:model="data.password" class="form-control rounded_5 col-10 col-md-8 shadow" placeholder="password">
                @error('data.password')
                <small>{{$message}}</small>
                @enderror
            </div>
            <div class="form-group row justify-content-center">
                <input type="checkbox" wire:model="data.remember" class="form-control outline_0 box_shadow_0 h-auto">
                remember me
            </div>
            <div class="form-group row justify-content-center">
                <button class="btn btn-success rounded_5 px-5 shadow-sm" type="button" wire:click="login">login</button>
            </div>
            @if(Session::has('message'))
                <div class="row">
                    <div class="col-md-10 col-md-push-1 alert alert-danger" style="direction: rtl">
                        {{Session::get('message')}}
                    </div>
                </div>
            @endif
        </form>

    </div>

</main>

{{-- <section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="nama" :value="__('Nama')" />
            <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full" :value="old('nama', $user->nama)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('nama')" />
        </div>
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section> --}}

<div class="container-fluid">
    <div class="row">
        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>
        <div class="col-md-12">
             @if (session('status') === 'profile-updated')
                    <div class="alert alert-success">
                        <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">×</button>
                        <span><b>Success - </b></span>
                        {{ session('status') }}
                    </div>
               
                @endif
            <div class="card">
               
                <div class="card-header">
                    <h2 class="card-title">Informasi Profile</h2>
                    <br>
                    <p class="card-category">Update your account's profile information and email address.</p>
                    <legend>
                </div>
                <div class="card-content">
                    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                        <div class="form-group">
                            <label for="photo" :value="__('Photo')" >Photo Profile</label>
                            <input type="file" placeholder="photo" class="form-control" id="photo"  name="photo" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label for="nama" :value="__('Nama')" >Nama</label>
                            <input type="text" placeholder="nama" class="form-control" id="nama" name="nama" value="{{$user->nama}}" required>
                        </div>
                        <div class="form-group">
                            <label for="jabatan" :value="__('Jabatan')" >Jabatan</label>
                            <input type="text" placeholder="Jabatan Anda" class="form-control" id="jabatan" name="jabatan" value="{{$user->jabatan}}" required>
                        </div>
                        <div class="form-group">
                            <label for="email" :value="__('Email')" >Email</label>
                            <input type="email" placeholder="example@gmail.com" class="form-control" id="email" name="email" value="{{$user->email}}" >
                        </div>
                        
                        @if ($user->email_verified_at == null && $user->email != null)
                            <div class="form-group">
                                <p class="text-dager">Your email address is unverified
                                    <button form="send-verification" class="btn btn-fill btn-warning">
                                        {{ __('Click here to re-send the verification email.') }}
                                    </button>
                                </p>
                                @if (session('status') === 'verification-link-sent')
                                    {{ __('A new verification link has been sent to your email address.') }}
                                @endif
                            </div>
                        @endif
                        <button type="submit" class="btn btn-fill btn-info">{{ __('Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

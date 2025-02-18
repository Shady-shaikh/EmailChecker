@section('title', 'My Dashboard')
@extends('frontend.layout.inner')
@section('content')



    <div class="col-lg-12">
        <div class="card d-flex  justify-content-center shadow-lg my-sm-0 my-sm-6 mt-8 mb-5">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                <div class="bg-gradient-primary shadow-primary border-radius-lg p-3">
                    <h3 class="text-white text-primary mb-0">{{ __('Profile') }}</h3>
                </div>
            </div>

            <div class="card-body">
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Profile Information') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __("Update your account's profile information and email address.") }}
                    </p>
                </header>

                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                </form>

                <form id="contact-form" method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('patch')

                    <div class="card-body p-0 my-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-static mb-4">
                                    <x-input-label for="name" :value="__('Name')" />
                                    <input type="text" id="name" name="name" class="form-control"
                                        value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                </div>
                            </div>
                            <div class="col-md-6 ps-md-2">
                                <div class="input-group input-group-static mb-4">
                                    <x-input-label for="email" :value="__('Email')" />
                                    <input type="email" id="email" name="email" class="form-control"
                                        value="{{ old('email', $user->email) }}" required autofocus autocomplete="username">
                                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                        <div>
                                            <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                                                {{ __('Your email address is unverified.') }}

                                                <button form="send-verification"
                                                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                                    {{ __('Click here to re-send the verification email.') }}
                                                </button>
                                            </p>


                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn bg-gradient-primary mt-3 mb-0">
                                    {{ __('Save') }}</button>
                                @if (session('status') === 'profile-updated')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ __('Saved.') }}</p>
                                @endif

                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-body">
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Update Password') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Ensure your account is using a long, random password to stay secure.') }}
                    </p>
                </header>

                <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('put')

                    <div class="card-body p-0 my-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-static mb-4">
                                    <x-input-label for="update_password_current_password" :value="__('Current Password')" />
                                    <input type="password" id="update_password_current_password" name="current_password"
                                        class="form-control" autocomplete="current-password">
                                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />

                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="input-group input-group-static mb-4">
                                    <x-input-label for="update_password_password" :value="__('New Password')" />
                                    <input type="password" id="update_password_password" name="password"
                                        class="form-control" autocomplete="new-password">
                                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-md-6 ps-md-2">
                                <div class="input-group input-group-static mb-4">
                                    <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
                                    <input type="password" id="update_password_password_confirmation"
                                        name="password_confirmation" class="form-control" autocomplete="new-password">
                                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn bg-gradient-primary mt-3 mb-0">
                                    {{ __('Save') }}</button>
                                @if (session('status') === 'password-updated')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ __('Saved.') }}</p>
                                @endif

                            </div>
                        </div>
                    </div>
                </form>
            </div>


            <div class="card-body ">
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Delete Account') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                    </p>
                </header>

                <button type="button" class="btn bg-gradient-primary mt-3 mb-0" data-bs-toggle="modal"
                    data-bs-target="#deleteAccountModal">{{ __('Delete Account') }}</button>

                <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteAccountModalLabel">
                                    {{ __('Are you sure you want to delete your account?') }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                                <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                                    @csrf
                                    @method('delete')
                                    <div class="col-md-6">
                                        <div class="input-group input-group-static mb-4">
                                            <x-input-label for="password" value="{{ __('Password') }}" />
                                            <input type="password" id="password" name="password" class="form-control"
                                                placeholder="{{ __('Current Password') }}">
                                            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="mt-6 flex justify-end">
                                        <button type="button" class="btn bg-gradient-dark mb-0" data-bs-dismiss="modal">
                                            {{ __('Cancel') }}
                                        </button>
                                        <button type="submit" class="btn bg-gradient-primary mb-0">
                                            {{ __('Delete Account') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>


@endsection

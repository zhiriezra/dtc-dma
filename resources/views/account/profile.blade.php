@extends('layouts.' . (auth()->user()->role->id === 1 ? 'admin' : 'dsp'))

@section('content')
<div class="bg-white shadow rounded-lg">
    <div class="px-4 py-5 sm:p-6">
        <h3 class="text-lg font-medium leading-6 text-gray-900">Account Settings</h3>
        
        @if(session('success'))
            <div class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mt-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                {{ session('error') }}
            </div>
        @endif

        <div class="mt-6 space-y-6">
            <!-- Profile Information -->
            <div class="bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Profile Information</h3>
                    <div class="mt-2 max-w-xl text-sm text-gray-500">
                        <p>Update your account's profile information.</p>
                    </div>
                    <form method="POST" action="{{ route('profile.update') }}" class="mt-5 space-y-4">
                        @csrf
                        @method('PUT')
                        
                        <div class="max-w-2xl">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" 
                                class="mt-1 w-full border rounded p-2">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="max-w-2xl">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" 
                                class="mt-1 w-full border rounded p-2">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        @if(auth()->user()->role->id === 2)
                        <div class="max-w-2xl">
                            <label for="state" class="block text-sm font-medium text-gray-700">State</label>
                            <select name="state" id="state" class="mt-1 w-full border rounded p-2">
                                <option value="">Select State</option>
                                @foreach(['Abia', 'Adamawa', 'Akwa Ibom', 'Anambra', 'Bauchi', 'Bayelsa', 'Benue', 'Borno', 'Cross River', 'Delta', 'Ebonyi', 'Edo', 'Ekiti', 'Enugu', 'FCT', 'Gombe', 'Imo', 'Jigawa', 'Kaduna', 'Kano', 'Katsina', 'Kebbi', 'Kogi', 'Kwara', 'Lagos', 'Nasarawa', 'Niger', 'Ogun', 'Ondo', 'Osun', 'Oyo', 'Plateau', 'Rivers', 'Sokoto', 'Taraba', 'Yobe', 'Zamfara'] as $state)
                                    <option value="{{ $state }}" {{ old('state', auth()->user()->state) == $state ? 'selected' : '' }}>{{ $state }}</option>
                                @endforeach
                            </select>
                            @error('state')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        @endif

                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Update Password -->
            <div class="bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Update Password</h3>
                    <div class="mt-2 max-w-xl text-sm text-gray-500">
                        <p>Ensure your account is using a long, random password to stay secure.</p>
                    </div>
                    <form method="POST" action="{{ route('password.update') }}" class="mt-5 space-y-4">
                        @csrf
                        @method('PUT')
                        
                        <div class="max-w-2xl">
                            <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
                            <input type="password" name="current_password" id="current_password" 
                                class="mt-1 w-full border rounded p-2">
                            @error('current_password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="max-w-2xl">
                            <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                            <input type="password" name="password" id="password" 
                                class="mt-1 w-full border rounded p-2">
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="max-w-2xl">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" 
                                class="mt-1 w-full border rounded p-2">
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
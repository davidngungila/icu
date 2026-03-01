@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-semibold tracking-tight">Profile</h1>
            <div class="text-sm text-slate-500">Manage your personal information</div>
        </div>

        @if (session('success'))
            <div class="mb-4 p-4 rounded-xl bg-emerald-50 border border-emerald-200/70 text-emerald-700 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white border border-slate-200/80 rounded-2xl overflow-hidden">
            <div class="p-6">
                <form method="POST" action="{{ route('profile.update') }}" class="space-y-6" enctype="multipart/form-data">
                    @csrf
                    <div class="flex items-center gap-6">
                        @if ($user->profile_photo_path)
                            <img class="w-24 h-24 rounded-full object-cover border border-slate-200/80" src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Profile photo" />
                        @else
                            <div class="w-24 h-24 rounded-full bg-amber-100 text-amber-900 flex items-center justify-center text-3xl font-bold">
                                {{ mb_substr($user->name, 0, 1) }}
                            </div>
                        @endif
                        <div>
                            <div class="text-lg font-semibold">{{ $user->name }}</div>
                            <div class="text-sm text-slate-500">{{ $user->email }}</div>
                            <div class="text-xs text-slate-400 mt-1">Member since {{ $user->created_at->format('M j, Y') }}</div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">Profile Image</label>
                        <input type="file" name="profile_photo" accept="image/*"
                            class="w-full px-4 py-2 border border-slate-200/80 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-400 bg-white" />
                        <div class="mt-1 text-xs text-slate-500">PNG/JPG up to 2MB.</div>
                        @error('profile_photo')
                            <div class="mt-1 text-sm text-rose-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium mb-2">Full Name</label>
                            <input type="text" name="name" value="{{ $user->name }}" required
                                class="w-full px-4 py-2 border border-slate-200/80 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-400">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Email Address</label>
                            <input type="email" name="email" value="{{ $user->email }}" required
                                class="w-full px-4 py-2 border border-slate-200/80 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-400">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Phone Number</label>
                            <input type="tel" name="phone" value="{{ $user->phone ?? '' }}"
                                class="w-full px-4 py-2 border border-slate-200/80 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-400">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Department</label>
                            <input type="text" name="department" value="{{ $user->department ?? '' }}"
                                class="w-full px-4 py-2 border border-slate-200/80 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-400">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium mb-2">Job Title</label>
                            <input type="text" name="title" value="{{ $user->title ?? '' }}"
                                class="w-full px-4 py-2 border border-slate-200/80 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-400">
                        </div>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('icu.page', ['page' => 'dashboard']) }}" class="px-4 py-2 rounded-xl border border-slate-200/80 hover:bg-slate-50 text-sm font-medium">
                            Cancel
                        </a>
                        <button type="submit" class="px-4 py-2 rounded-xl bg-slate-900 text-white hover:bg-slate-800 text-sm font-medium">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

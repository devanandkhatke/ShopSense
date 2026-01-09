@extends('layouts.app')

@section('title', 'Notifications')

@section('content')

<h1 class="text-2xl font-bold mb-6">Notifications</h1>

@if($notifications->isEmpty())
<p class="text-gray-500">No notifications.</p>
@else
<div class="bg-white rounded shadow divide-y">

    @foreach($notifications as $notification)
    <div class="p-4 flex justify-between items-start
                {{ $notification->read_at ? 'bg-white' : 'bg-blue-50' }}">

        <div>
            <p class="text-sm text-gray-800">
                {{ $notification->data['message'] ?? 'New notification' }}
            </p>
            <p class="text-xs text-gray-500 mt-1">
                {{ $notification->created_at->diffForHumans() }}
            </p>
        </div>

        @if(!$notification->read_at)
        <form method="POST"
            action="{{ route('notifications.read', $notification->id) }}">
            @csrf
            <button class="text-xs text-blue-600">
                Mark as read
            </button>
        </form>
        @endif
    </div>
    @endforeach

</div>
@endif

@endsection
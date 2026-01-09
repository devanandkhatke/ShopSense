@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Pending Seller KYC Approvals</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Business Name</th>
                <th>Action</th>
                <th>Approve/Reject</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pendingSellers as $seller)
            <tr>
                <td>{{ $seller->business_name }}</td>
                <td>
                    <a href="{{ route('admin.seller.kyc.view', $seller->id) }}">View KYC</a>
                </td>
                <td>
                    <form method="POST" action="{{ route('admin.seller.kyc.approve', $seller->id) }}">
                        @csrf
                        <button type="submit">Approve</button>
                    </form>
                    <form method="POST" action="{{ route('admin.seller.kyc.reject', $seller->id) }}">
                        @csrf
                        <button type="submit">Reject</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@extends('layout.master')
@section('content')
<div>
    <form method="POST" action="{{ route('money.sent.store') }}" enctype="multipart/form-data">
        @csrf
        <!-- Name, Description, Staff Dropdown -->
        <div class="container">
            <h2>Money Sent</h2>
            <div class="row justify-content-center">
                <div class="mb-3">
                    <label for="name" class="form-label">Enter Amount</label>
                    <input type="number" name="money" class="form-control" placeholder="Enter Money" required>
                </div>
                <button type="submit" class="btn btn-primary">Money sent</button>
            </div>
        </div>
    </form>
</div>
@endsection

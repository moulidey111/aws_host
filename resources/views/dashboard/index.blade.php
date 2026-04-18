@extends('layouts.app')

@section('title', 'Dashboard | POS System')
@section('page-heading', 'Dashboard')

@section('content')
    @if(session('success'))
        <div class="alert-box success-alert">
            {{ session('success') }}
        </div>
    @endif

    <section class="dashboard-hero">
        <div class="hero-left">
            <h1>Welcome to POS System</h1>
            <p>Hello, <strong>{{ auth()->user()->name }}</strong> 👋</p>
            <p>Your role: <strong>{{ ucfirst(auth()->user()->role) }}</strong></p>
            <p class="hero-subtext">Manage products, customers, and billing-ready records from one place.</p>
        </div>
        <div class="hero-right">
            <div class="hero-badge">
                <span>POS</span>
                <small>Smart Billing Panel</small>
            </div>
        </div>
    </section>

    <section class="stats-grid">
        <div class="stat-card">
            <h3>Products</h3>
            <p>Manage your inventory items quickly.</p>
            <a href="{{ route('products.index') }}">View Products</a>
        </div>

        <div class="stat-card">
            <h3>Customers</h3>
            <p>Store customer details for fast billing.</p>
            <a href="{{ route('customers.index') }}">View Customers</a>
        </div>

        <div class="stat-card">
            <h3>Add Product</h3>
            <p>Create new products with barcode and pricing.</p>
            <a href="{{ route('products.create') }}">Add Now</a>
        </div>

        <div class="stat-card">
            <h3>Add Customer</h3>
            <p>Add customer name and phone for POS usage.</p>
            <a href="{{ route('customers.create') }}">Add Now</a>
        </div>
    </section>
@endsection
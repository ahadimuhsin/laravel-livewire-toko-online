<style>
    .list-group-item .active{
        z-index: 2;
        color: #fff;
        background-color: #171d26;
        border-color: #171d26;
    }
</style>

<div class="list-group">
    <a href="{{ route('customer.dashboard') }}"
    class="list-group-item list-group-item-action
    {{ setActive('customer/dashboard') }}">
        <i class="fa fa-tachometer-alt"></i> Dashboard
    </a>
    <a href="{{ route('customer.orders') }}"
    class="list-group-item list-group-item-action
    {{ setActive('customer/orders') }}">
        <i class="fa fa-shopping-cart"></i> My Orders
    </a>
    <a href="{{ route('customer.profile') }}" class="list-group-item list-group-item-action {{ setActive('customer/profile') }}">
        <i class="fa fa-user-circle"></i> My Profile
    </a>
</div>

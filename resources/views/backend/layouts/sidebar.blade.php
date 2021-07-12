<!-- Sidebar Menu -->
<nav class="mt-2">
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
  <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
  
  @if(Auth::user()->usertype == 'Admin')
  @if(Session::get('page')=="viewuser")
   <?php $active = "active"; $open = "menu-open"; ?>
  @else
   <?php $active = ""; $open = ""; ?>
  @endif
  <li class="nav-item has-treeview {{$open}}">

    <a href="#" class="nav-link {{ $active }}">
      <i class="nav-icon fas fa-copy"></i>
      <p>
        Manage User
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        @if(Session::get('page')=="viewuser")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('users.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>View User</p>
        </a>
      </li>
    </ul>
  </li>
  @endif
   @if(Session::get('page')=="profile" || Session::get('page')=="editpassword")
      <?php $active = "active"; $open = "menu-open";?>
     @else
      <?php $active = ""; $open = "";?>
    @endif
  <li class="nav-item has-treeview {{$open}}">
    <a href="#" class="nav-link {{ $active }}">
      <i class="nav-icon fas fa-copy"></i>
      <p>
        Manage Profile
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        @if(Session::get('page')=="profile")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('profiles.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Your Profile</p>
        </a>
      </li>
      <li class="nav-item">
        @if(Session::get('page')=="editpassword")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('profiles.password.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Change Password</p>
        </a>
      </li>
    </ul>
  </li>
   @if(Session::get('page')=="suppliers")
      <?php $active = "active"; $open = "menu-open";?>
     @else
      <?php $active = ""; $open = "";?>
    @endif
  <li class="nav-item has-treeview {{$open}}">
    <a href="#" class="nav-link {{ $active }}">
      <i class="nav-icon fas fa-copy"></i>
      <p>
        Manage Suppliers
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        @if(Session::get('page')=="suppliers")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('suppliers.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>View Suppliers</p>
        </a>
      </li>
    </ul>
  </li>
   @if(Session::get('page')=="customers"||Session::get('page')=="credit_customers"||Session::get('page')=="paid_customers"||Session::get('page')=="customer_wise_report")
      <?php $active = "active"; $open = "menu-open";?>
     @else
      <?php $active = ""; $open = "";?>
    @endif
  <li class="nav-item has-treeview {{$open}}">
    <a href="#" class="nav-link {{ $active }}">
      <i class="nav-icon fas fa-copy"></i>
      <p>
        Manage Customers
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        @if(Session::get('page')=="customers")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('customers.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>View Customers</p>
        </a>
      </li>
      <li class="nav-item">
        @if(Session::get('page')=="credit_customers")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('customers.credit') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Credit Customers</p>
        </a>
      </li>
      <li class="nav-item">
        @if(Session::get('page')=="paid_customers")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('customers.paid') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Paid Customers</p>
        </a>
      </li>
      <li class="nav-item">
        @if(Session::get('page')=="customer_wise_report")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('customers.wise.report') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Customers Wise Report</p>
        </a>
      </li>
    </ul>
  </li>
   @if(Session::get('page')=="units")
      <?php $active = "active"; $open = "menu-open";?>
     @else
      <?php $active = ""; $open = "";?>
    @endif
  <li class="nav-item has-treeview {{$open}}">
    <a href="#" class="nav-link {{ $active }}">
      <i class="nav-icon fas fa-copy"></i>
      <p>
        Manage Units
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        @if(Session::get('page')=="units")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('units.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>View Units</p>
        </a>
      </li>
    </ul>
  </li>
   @if(Session::get('page')=="categories")
      <?php $active = "active"; $open = "menu-open";?>
     @else
      <?php $active = ""; $open = "";?>
    @endif
  <li class="nav-item has-treeview {{$open}}">
    <a href="#" class="nav-link {{ $active }}">
      <i class="nav-icon fas fa-copy"></i>
      <p>
        Manage Category
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        @if(Session::get('page')=="categories")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('categories.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>View Category</p>
        </a>
      </li>
    </ul>
  </li>
   @if(Session::get('page')=="products")
      <?php $active = "active"; $open = "menu-open";?>
     @else
      <?php $active = ""; $open = "";?>
    @endif
  <li class="nav-item has-treeview {{$open}}">
    <a href="#" class="nav-link {{ $active }}">
      <i class="nav-icon fas fa-copy"></i>
      <p>
        Manage Products
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        @if(Session::get('page')=="products")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('products.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>View Products</p>
        </a>
      </li>
    </ul>
  </li>
   @if(Session::get('page')=="purchase"||Session::get('page')=="approve_purchase"||Session::get('page')=="daily_purchase")
      <?php $active = "active"; $open = "menu-open";?>
     @else
      <?php $active = ""; $open = "";?>
    @endif
  <li class="nav-item has-treeview {{$open}}">
    <a href="#" class="nav-link {{ $active }}">
      <i class="nav-icon fas fa-copy"></i>
      <p>
        Manage Purchase
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        @if(Session::get('page')=="purchase")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('purchase.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>View Purchase</p>
        </a>
      </li>
      <li class="nav-item">
        @if(Session::get('page')=="approve_purchase")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('purchase.pending.list') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Approval Purchase</p>
        </a>
      </li>
      <li class="nav-item">
        @if(Session::get('page')=="daily_purchase")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('purchase.report') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Daily Purchase Report</p>
        </a>
      </li>
    </ul>
  </li>
   @if(Session::get('page')=="invoice"||Session::get('page')=="approve_invoice"||Session::get('page')=="print_invoice"||Session::get('page')=="daily_invoice")
      <?php $active = "active"; $open = "menu-open";?>
     @else
      <?php $active = ""; $open = "";?>
    @endif
  <li class="nav-item has-treeview {{$open}}">
    <a href="#" class="nav-link {{ $active }}">
      <i class="nav-icon fas fa-copy"></i>
      <p>
        Manage Invoice
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        @if(Session::get('page')=="invoice")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('invoice.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>View Invoice</p>
        </a>
      </li>
      <li class="nav-item">
        @if(Session::get('page')=="approve_invoice")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('invoice.pending.list') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Approval Invoice</p>
        </a>
      </li>
      <li class="nav-item">
        @if(Session::get('page')=="print_invoice")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('invoice.print.list') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Print Invoice</p>
        </a>
      </li>
      <li class="nav-item">
        @if(Session::get('page')=="daily_invoice")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('invoice.daily.report') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Daily Invoice Report</p>
        </a>
      </li>
    </ul>
  </li>
   @if(Session::get('page')=="stock_report"||Session::get('page')=="stock_supplier_product")
      <?php $active = "active"; $open = "menu-open";?>
     @else
      <?php $active = ""; $open = "";?>
    @endif
  <li class="nav-item has-treeview {{$open}}">
    <a href="#" class="nav-link {{ $active }}">
      <i class="nav-icon fas fa-copy"></i>
      <p>
        Manage Stock
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">

      <li class="nav-item">
        @if(Session::get('page')=="stock_report")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('stock.report') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Stock Report</p>
        </a>
      </li>
      <li class="nav-item">
        @if(Session::get('page')=="stock_supplier_product")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('stock.supplier.product.wise') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Supplier/Product Wise</p>
        </a>
      </li>
      
    </ul>
  </li>

</ul>
</nav>
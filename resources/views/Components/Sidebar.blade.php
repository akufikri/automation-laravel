 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="index3.html" class="brand-link text-center">
         <img src="{{ asset('assets/imgs/icon-go-tax.png') }}" alt="GO TAX"
             class="brand-image-xl img-circle elevation-3">
         <h3 class="brand-text font-weight-bold text-success mt-1 mb-0">GO Tax</h3>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">

         <!-- SidebarSearch Form -->
         <div class="form-inline">
             <div class="input-group" data-widget="sidebar-search">
                 <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                     aria-label="Search">
                 <div class="input-group-append">
                     <button class="btn btn-sidebar">
                         <i class="fas fa-search fa-fw"></i>
                     </button>
                 </div>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                 data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                 <li class="nav-header">SPECIALIS</li>
                 <li class="nav-item">
                     <a href="/" class="nav-link">

                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <p>
                             Dashboard
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="/taxi" class="nav-link">
                         <i class="nav-icon fa-solid fa-taxi"></i>
                         <p>
                             Taxi
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="/riders" class="nav-link">
                         <i class="nav-icon  fa-solid fa-users"></i>
                         <p>
                             Riders
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="/transaction" class="nav-link">
                         <i class="nav-icon  fa-solid fa-hand-holding-dollar"></i>
                         <p>
                             Transactions
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="/mail" class="nav-link">
                         <i class="nav-icon  fa-solid fa-envelopes-bulk"></i>
                         <p>
                             Send Broadcast Mail
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="/comparizon" class="nav-link">
                         <i class=" nav-icon fa-solid fa-code-compare"></i>
                         <p>
                             Comparasion
                         </p>
                     </a>
                 </li>
                 <li class="nav-header">GENERAL</li>
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fa-solid fa-gears"></i>
                         <p>
                             Status
                             <i class="right fas fa-angle-left"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="/available" class="nav-link">
                                 <i class="fa-regular fa-thumbs-up  nav-icon"></i>
                                 <p>Available</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="/booked" class="nav-link">
                                 <i class="fa-solid fa-car-on nav-icon"></i>
                                 <p>Booked</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="/on_ride" class="nav-link">
                                 <i class="fa-solid fa-car-side nav-icon"></i>
                                 <p>On Ride</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="/under_maintence" class="nav-link">
                                 <i class="fa-solid fa-warehouse nav-icon"></i>
                                 <p>Under Maintence</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fa-solid fa-clock-rotate-left"></i>
                         <p>
                             History / LOG
                             <i class="right fas fa-angle-left"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="/history_login" class="nav-link">
                                 <i class="nav-icon  fa-solid fa-user-lock"></i>
                                 <p>Login History</p>
                             </a>
                             <a href="" class="nav-link">
                                 <i class="nav-icon  fa-solid fa-sack-dollar"></i>
                                 <p>Transaction History</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon  fa-solid fa-map"></i>
                         <p>
                             Map
                             <i class="right fas fa-angle-left"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="/map/fencing" class="nav-link">
                                 <i class="nav-icon   fa-solid fa-globe"></i>
                                 <p>Fencing</p>
                             </a>
                             <a href="/pin" class="nav-link">
                                 <i class="nav-icon  fa-solid fa-location-dot"></i>
                                 <p>Pin marker</p>
                             </a>
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="nav-icon  fa-solid fa-flag"></i>
                                 <p>
                                     identity place
                                     <i class="right fas fa-angle-left"></i>
                                 </p>
                             </a>
                             <ul class="nav nav-treeview">
                                 <li class="nav-item">
                                     <a href="/country" class="nav-link">
                                         <i class="nav-icon fa-solid fa-globe"></i>
                                         <p>Country</p>
                                     </a>
                                     <a href="/city" class="nav-link">
                                         <i class="nav-icon fa-solid fa-city"></i>
                                         <p>City</p>
                                     </a>
                                     <a href="/state" class="nav-link">
                                         <i class="nav-icon fa-solid fa-building"></i>
                                         <p>State</p>
                                     </a>
                                 </li>
                             </ul>
                         </li>
                     </ul>
                 </li>
             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>

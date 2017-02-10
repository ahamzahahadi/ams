<!-- **********************************************************************************************************************************************************
     MAIN SIDEBAR MENU
     *********************************************************************************************************************************************************** -->
     <!--sidebar start-->
     <aside>
         <div id="sidebar"  class="nav-collapse ">
             <!-- sidebar menu start-->
             <ul class="sidebar-menu" id="nav-accordion">

                 <p class="centered"><img src="{{ URL::asset('img/ui-sapura.jpg') }}" class="img-circle" width="60"></p>
                 <h5 class="centered">AMS Sapura</h5>

                 <li class="mt">
                     <a href="/"> <!-- <a class="active" href="/">  -->
                         <i class="fa fa-dashboard"></i>
                         <span>Home</span>
                     </a>
                 </li>

                 <li class="sub-menu">
                     <a href="javascript:;" >
                         <i class="fa fa-cogs"></i>
                         <span>Staff</span>
                     </a>
                     <ul class="sub">
                         <li><a  href="/staff">Staff List</a></li>
                         <li><a  href="/staff/create">Add Staff</a></li>
                     </ul>
                 </li>
                 <li class="sub-menu">
                     <a href="javascript:;" >
                         <i class="fa fa-desktop"></i>
                         <span>Asset</span>
                     </a>
                     <ul class="sub">
                         <li><a  href="/hwcategories">Hardware Categories</a></li>
                         <li><a  href="/hardware/create">Add Hardware</a></li>
                         <li><a  href="/swcategories">Software Categories</a></li>
                         <li><a  href="/software/create">Add Software</a></li>
                     </ul>
                 </li>
                 <li class="sub-menu">
                     <a href="javascript:;" >
                         <i class="fa fa-tasks"></i>
                         <span>Supplier</span>
                     </a>
                     <ul class="sub">
                         <li><a  href="/supplier">Supplier List</a></li>
                         <li><a  href="/supplier/create">Add Supplier</a></li>
                     </ul>
                 </li>
                 <li class="sub-menu">
                     <a href="javascript:;" >
                         <i class="fa fa-th"></i>
                         <span>Report</span>
                     </a>
                     <ul class="sub">
                         <li><a  href="/ageReport">Notebook Age</a></li>
                         <li><a  href="responsive_table.html">Responsive Table</a></li>
                     </ul>
                 </li>
                 <li class="sub-menu">
                     <a href="javascript:;" >
                         <i class=" fa fa-bar-chart-o"></i>
                         <span>Records</span>
                     </a>
                     <ul class="sub">
                         <li><a  href="morris.html">Morris</a></li>
                         <li><a  href="chartjs.html">Chartjs</a></li>
                     </ul>
                 </li>

             </ul>
             <!-- sidebar menu end-->
         </div>
     </aside>
     <!--sidebar end-->

<aside class="main-sidebar elevation-4 main-sidebar elevation-4 sidebar-primary-primary">
    <!-- Sidebar -->
    @php
        use Illuminate\Support\Facades\Route;
    @endphp

    <div class="sidebar pt-0 mt-0">

        <div class="user-panel">
            <a href="{{ route('admin.dashboard') }}" class="name text-dark">
                <img src="{{ asset($setting->logo) }}" class="logo logo-display" alt="Logo" width="200px">
            </a>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item {{ Route::currentRouteName() == 'admin.dashboard' ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }} @if (request()->path() == 'admin/dashboard') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('Dashboard') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item {{ Route::currentRouteName() == 'admin.profile.edit' ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.profile.edit') }}"
                        class="nav-link {{ Route::currentRouteName() == 'admin.profile.edit' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-circle"></i>
                        <p>
                            {{ __('Profile') }}
                        </p>
                    </a>
                </li>

                {{-- Slider --}}
                <li
                    class="nav-item {{ Route::currentRouteName() == 'admin.slider' || Route::currentRouteName() == 'admin.slider.add' ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.slider') }}" class="nav-link">
                        <i class="nav-icon fas fa-sliders-h"></i>
                        <p>
                            {{ __('Slider') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.slider') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.slider' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Slider list') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.slider.add') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.slider.add' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Add New Slide') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- end Slider --}}

                {{-- Slider --}}
                <li
                    class="nav-item {{ Route::currentRouteName() == 'admin.package.index' || Route::currentRouteName() == 'admin.package.add' || Route::currentRouteName() == 'admin.package-category.index' || Route::currentRouteName() == 'admin.package-category.add' ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.package.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-sliders-h"></i>
                        <p>
                            {{ __('Package') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.package.index') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.package.index' || Route::currentRouteName() == 'admin.package.add' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Package List') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.package-category.index') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.package-category.index' || Route::currentRouteName() == 'admin.package-category.add' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Package Cagegory List') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- end Slider --}}

                {{-- Service --}}
                <li
                    class="nav-item {{ Route::currentRouteName() == 'admin.service.index' || Route::currentRouteName() == 'admin.service.add' ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.service.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-sliders-h"></i>
                        <p>
                            {{ __('Service') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.service.index') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.service.index' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Service List') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.service.add') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.service.add' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Service Add') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- end Service --}}

                {{-- Users --}}
                <li
                    class="nav-item {{ Route::currentRouteName() == 'admin.user.index' || Route::currentRouteName() == 'admin.user.pendingUsers' || Route::currentRouteName() == 'admin.user.approvedUsers' || Route::currentRouteName() == 'admin.user.blockedUsers' ? 'menu-open' : '' }}">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            {{ __('Users') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.user.index') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.user.index' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('All Users') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.user.pendingUsers') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.user.pendingUsers' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Pending Users') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.user.approvedUsers') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.user.approvedUsers' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Approved Users') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.user.blockedUsers') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.user.blockedUsers' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Blocked Users') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- end Users --}}

                {{-- Booking --}}
                <li
                    class="nav-item {{ Route::currentRouteName() == 'admin.booking.index' || Route::currentRouteName() == 'admin.booking.add' ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.booking.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-calendar-check"></i>

                        <p>
                            {{ __('Booking') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.booking.index') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.booking.index' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Booking List') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.booking.add') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.booking.add' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Add Booking') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- End of Booking --}}
                
                {{-- start Info Block --}}


                <li
                    class="nav-item {{ Route::currentRouteName() == 'admin.info-block.index' || Route::currentRouteName() == 'admin.info-block.add' ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.info-block.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-concierge-bell"></i>
                        <p>
                            {{ __('Info Block') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.info-block.index') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.info-block.index' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Info Block List') }}</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.info-block.add') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.info-block.add' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Add New Info Block') }}</p>
                            </a>
                        </li>

                    </ul>
                </li>
                {{-- end Info Block --}}

                {{-- faq-section start --}}
                <li
                    class="nav-item {{ Route::currentRouteName() == 'admin.faq-section.index' || Route::currentRouteName() == 'admin.faq-section.add' ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.faq-section.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-question-circle"></i>
                        <p>
                            {{ __('Faq Section') }}
                            <i class="fa-people-group"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.faq-section.index') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.faq-section.index' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('All Faq Section') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.faq-section.add') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.faq-section.add' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Add Faq Section') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- faq section End --}}

                {{-- Enquiry --}}
                <li class="nav-item {{ Route::currentRouteName() == 'admin.enquiry.index' ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.enquiry.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-envelope-open-text"></i>
                        <p>
                            {{ __('Enquiry') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.enquiry.index') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.enquiry.index' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('All Enquiries') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li
                    class="nav-item {{ Route::currentRouteName() == 'admin.testimonial-section.index' || Route::currentRouteName() == 'admin.testimonial-section.add' ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.testimonial-section.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-star"></i>
                        <p>
                            {{ __('Testimonial') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.testimonial-section.index') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.testimonial-section.index' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('List') }}</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.testimonial-section.add') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.testimonial-section.index' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Add') }}</p>
                            </a>
                        </li>

                    </ul>
                </li>

                {{-- Enquiry End ==}}
                
                
                  {{-- why choose us Section --}}
                <li
                    class="nav-item {{ Route::currentRouteName() == 'admin.why.choose.us.section.index' || Route::currentRouteName() == 'admin.why.choose.us.section.add' ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.why.choose.us.section.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-star"></i>
                        <p>
                            {{ __('Why Choose Us') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.why.choose.us.section.index') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.why.choose.us.section.index' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __(' Section List') }}</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.why.choose.us.section.add') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.why.choose.us.section.add' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Add Section') }}</p>
                            </a>
                        </li>

                    </ul>
                </li>
                {{-- end why choose us section --}}


                {{-- Configurations End --}}

                {{-- Settings --}}

                <li class="nav-item">
                    <a href="{{ route('admin.setting.edit') }}"
                        class="nav-link {{ Route::currentRouteName() == 'admin.setting.edit' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            {{ __('Settings') }}
                        </p>
                    </a>
                </li>

                {{-- Settings End --}}

                {{-- Trash --}}

                <li class="nav-item {{ Route::currentRouteName() == 'menu-open' }}">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-trash"></i>

                        <p>
                            {{ __('Trash') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.enquiry.restore.page') }}"
                                class="nav-link {{ Route::currentRouteName() == 'admin.enquiry.restore.page' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>{{ __('Enquiries') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- End of Trash --}}




            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

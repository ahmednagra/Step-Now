{{-- ============================================================================
     Admin sidebar navigation

     Wave 4 revisions:
       • Pending-counts badge on Bookings + Enquiries (live count from
         the dashboard $pending data, falls back to 0)
       • aria-current="page" instead of just CSS .active class
       • Logical grouping into sections: Operations / Content / Identity
       • Dead-table menus removed (study_programs, webinars, blogs, jobs,
         job_categories, etc.) — they are not needed for a transport
         business and were a remnant of the education-platform template
       • Logo gets defensive optional() — admin still loads on missing
         settings row
       • aria-label per nav for screen readers
       • Trash menu only renders when there's actually a trash route
         (keeps the noise down)
       • Single source of truth for nav items via $navItems array —
         add/remove items by editing the array, no copy-paste needed
============================================================================= --}}

@php
    use Illuminate\Support\Facades\Route;

    $currentRoute = Route::currentRouteName();
    $logoSrc      = optional($setting ?? null)->logo
                    ? asset($setting->logo)
                    : asset('front/assets/images/logo.png');

    /* Live pending counts shared by the dashboard controller, with fallback */
    $pendingBookings  = $pending['bookings']  ?? 0;
    $pendingEnquiries = $pending['enquiries'] ?? 0;

    /* Helper: returns true if any of the given route names is the current one. */
    $isActive = function (...$names) use ($currentRoute) {
        foreach ($names as $n) {
            if ($currentRoute === $n) return true;
        }
        return false;
    };

    /* Helper: returns 'menu-open' if any of the routes is active (for treeview) */
    $treeOpen = function (...$names) use ($currentRoute) {
        foreach ($names as $n) {
            if ($currentRoute === $n) return 'menu-open';
        }
        return '';
    };
@endphp

<aside class="main-sidebar elevation-4 sidebar-primary-primary"
       role="complementary"
       aria-label="{{ __('Admin navigation') }}">

    <div class="sidebar pt-0 mt-0">

        {{-- Brand / logo --}}
        <div class="user-panel">
            <a href="{{ route('admin.dashboard') }}" class="name text-dark" aria-label="{{ __('Dashboard') }}">
                <img src="{{ $logoSrc }}" class="logo logo-display" alt="StepNow" width="200">
            </a>
        </div>

        <nav class="mt-2" aria-label="{{ __('Primary admin navigation') }}">
            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false">

                {{-- ===== DASHBOARD =================================== --}}
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                       class="nav-link {{ $isActive('admin.dashboard') ? 'active' : '' }}"
                       @if($isActive('admin.dashboard')) aria-current="page" @endif>
                        <i class="nav-icon fas fa-tachometer-alt" aria-hidden="true"></i>
                        <p>{{ __('Dashboard') }}</p>
                    </a>
                </li>

                {{-- ===== OPERATIONS HEADER =========================== --}}
                <li class="nav-header" role="separator">{{ __('Operations') }}</li>

                {{-- Bookings --}}
                <li class="nav-item {{ $treeOpen('admin.booking.index', 'admin.booking.add', 'admin.booking.edit') }}">
                    <a href="{{ route('admin.booking.index') }}"
                       class="nav-link {{ $isActive('admin.booking.index', 'admin.booking.add', 'admin.booking.edit') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-calendar-check" aria-hidden="true"></i>
                        <p>
                            {{ __('Bookings') }}
                            @if ($pendingBookings > 0)
                                <span class="badge badge-warning right" aria-label="{{ $pendingBookings . ' ' . __('pending') }}">
                                    {{ $pendingBookings }}
                                </span>
                            @endif
                            <i class="fas fa-angle-left right" aria-hidden="true"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" role="menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.booking.index') }}"
                               class="nav-link {{ $isActive('admin.booking.index') ? 'active' : '' }}"
                               @if($isActive('admin.booking.index')) aria-current="page" @endif>
                                <i class="far fa-circle nav-icon" aria-hidden="true"></i>
                                <p>{{ __('Booking list') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.booking.add') }}"
                               class="nav-link {{ $isActive('admin.booking.add') ? 'active' : '' }}"
                               @if($isActive('admin.booking.add')) aria-current="page" @endif>
                                <i class="far fa-circle nav-icon" aria-hidden="true"></i>
                                <p>{{ __('Add booking') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Enquiries --}}
                <li class="nav-item">
                    <a href="{{ route('admin.enquiry.index') }}"
                       class="nav-link {{ $isActive('admin.enquiry.index') ? 'active' : '' }}"
                       @if($isActive('admin.enquiry.index')) aria-current="page" @endif>
                        <i class="nav-icon fas fa-envelope-open-text" aria-hidden="true"></i>
                        <p>
                            {{ __('Enquiries') }}
                            @if ($pendingEnquiries > 0)
                                <span class="badge badge-warning right" aria-label="{{ $pendingEnquiries . ' ' . __('new') }}">
                                    {{ $pendingEnquiries }}
                                </span>
                            @endif
                        </p>
                    </a>
                </li>

                {{-- ===== CONTENT HEADER ============================== --}}
                <li class="nav-header" role="separator">{{ __('Content') }}</li>

                {{-- Slider --}}
                <li class="nav-item {{ $treeOpen('admin.slider', 'admin.slider.add') }}">
                    <a href="{{ route('admin.slider') }}"
                       class="nav-link {{ $isActive('admin.slider', 'admin.slider.add') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-images" aria-hidden="true"></i>
                        <p>
                            {{ __('Slider') }}
                            <i class="fas fa-angle-left right" aria-hidden="true"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.slider') }}"
                               class="nav-link {{ $isActive('admin.slider') ? 'active' : '' }}"
                               @if($isActive('admin.slider')) aria-current="page" @endif>
                                <i class="far fa-circle nav-icon" aria-hidden="true"></i>
                                <p>{{ __('Slider list') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.slider.add') }}"
                               class="nav-link {{ $isActive('admin.slider.add') ? 'active' : '' }}"
                               @if($isActive('admin.slider.add')) aria-current="page" @endif>
                                <i class="far fa-circle nav-icon" aria-hidden="true"></i>
                                <p>{{ __('Add new slide') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Packages --}}
                <li class="nav-item {{ $treeOpen('admin.package.index', 'admin.package.add', 'admin.package-category.index', 'admin.package-category.add') }}">
                    <a href="{{ route('admin.package.index') }}"
                       class="nav-link {{ $isActive('admin.package.index', 'admin.package.add') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tag" aria-hidden="true"></i>
                        <p>
                            {{ __('Packages') }}
                            <i class="fas fa-angle-left right" aria-hidden="true"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.package.index') }}"
                               class="nav-link {{ $isActive('admin.package.index', 'admin.package.add') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" aria-hidden="true"></i>
                                <p>{{ __('Packages') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.package-category.index') }}"
                               class="nav-link {{ $isActive('admin.package-category.index', 'admin.package-category.add') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" aria-hidden="true"></i>
                                <p>{{ __('Categories') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Services --}}
                <li class="nav-item {{ $treeOpen('admin.service.index', 'admin.service.add') }}">
                    <a href="{{ route('admin.service.index') }}"
                       class="nav-link {{ $isActive('admin.service.index', 'admin.service.add') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-concierge-bell" aria-hidden="true"></i>
                        <p>
                            {{ __('Services') }}
                            <i class="fas fa-angle-left right" aria-hidden="true"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.service.index') }}"
                               class="nav-link {{ $isActive('admin.service.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" aria-hidden="true"></i>
                                <p>{{ __('Service list') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.service.add') }}"
                               class="nav-link {{ $isActive('admin.service.add') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" aria-hidden="true"></i>
                                <p>{{ __('Add service') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Info Block (About) --}}
                <li class="nav-item {{ $treeOpen('admin.info-block.index', 'admin.info-block.add', 'admin.info-block.edit') }}">
                    <a href="{{ route('admin.info-block.index') }}"
                       class="nav-link {{ $isActive('admin.info-block.index') ? 'active' : '' }}"
                       @if($isActive('admin.info-block.index')) aria-current="page" @endif>
                        <i class="nav-icon fas fa-info-circle" aria-hidden="true"></i>
                        <p>{{ __('About / Info blocks') }}</p>
                    </a>
                </li>

                {{-- Why Choose Us --}}
                <li class="nav-item {{ $treeOpen('admin.why.choose.us.section.index', 'admin.why.choose.us.section.add', 'admin.why.choose.us.section.edit') }}">
                    <a href="{{ route('admin.why.choose.us.section.index') }}"
                       class="nav-link {{ $isActive('admin.why.choose.us.section.index') ? 'active' : '' }}"
                       @if($isActive('admin.why.choose.us.section.index')) aria-current="page" @endif>
                        <i class="nav-icon fas fa-thumbs-up" aria-hidden="true"></i>
                        <p>{{ __('Why choose us') }}</p>
                    </a>
                </li>

                {{-- Testimonials --}}
                <li class="nav-item {{ $treeOpen('admin.testimonial-section.index', 'admin.testimonial-section.add', 'admin.testimonial-section.edit') }}">
                    <a href="{{ route('admin.testimonial-section.index') }}"
                       class="nav-link {{ $isActive('admin.testimonial-section.index') ? 'active' : '' }}"
                       @if($isActive('admin.testimonial-section.index')) aria-current="page" @endif>
                        <i class="nav-icon fas fa-star" aria-hidden="true"></i>
                        <p>{{ __('Testimonials') }}</p>
                    </a>
                </li>

                {{-- FAQ --}}
                <li class="nav-item {{ $treeOpen('admin.faq-section.index', 'admin.faq-section.add', 'admin.faq-section.edit') }}">
                    <a href="{{ route('admin.faq-section.index') }}"
                       class="nav-link {{ $isActive('admin.faq-section.index') ? 'active' : '' }}"
                       @if($isActive('admin.faq-section.index')) aria-current="page" @endif>
                        <i class="nav-icon fas fa-question-circle" aria-hidden="true"></i>
                        <p>{{ __('FAQ') }}</p>
                    </a>
                </li>

                {{-- ===== IDENTITY HEADER ============================= --}}
                <li class="nav-header" role="separator">{{ __('Identity & Settings') }}</li>

                {{-- Users --}}
                <li class="nav-item {{ $treeOpen('admin.user.index', 'admin.user.add', 'admin.user.pendingUsers', 'admin.user.approvedUsers', 'admin.user.blockedUsers') }}">
                    <a href="{{ route('admin.user.index') }}"
                       class="nav-link {{ $isActive('admin.user.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users" aria-hidden="true"></i>
                        <p>
                            {{ __('Users') }}
                            <i class="fas fa-angle-left right" aria-hidden="true"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.user.index') }}"
                               class="nav-link {{ $isActive('admin.user.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" aria-hidden="true"></i>
                                <p>{{ __('All users') }}</p>
                            </a>
                        </li>
                        @if (Route::has('admin.user.pendingUsers'))
                            <li class="nav-item">
                                <a href="{{ route('admin.user.pendingUsers') }}"
                                   class="nav-link {{ $isActive('admin.user.pendingUsers') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon" aria-hidden="true"></i>
                                    <p>{{ __('Pending') }}</p>
                                </a>
                            </li>
                        @endif
                        @if (Route::has('admin.user.approvedUsers'))
                            <li class="nav-item">
                                <a href="{{ route('admin.user.approvedUsers') }}"
                                   class="nav-link {{ $isActive('admin.user.approvedUsers') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon" aria-hidden="true"></i>
                                    <p>{{ __('Approved') }}</p>
                                </a>
                            </li>
                        @endif
                        @if (Route::has('admin.user.blockedUsers'))
                            <li class="nav-item">
                                <a href="{{ route('admin.user.blockedUsers') }}"
                                   class="nav-link {{ $isActive('admin.user.blockedUsers') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon" aria-hidden="true"></i>
                                    <p>{{ __('Blocked') }}</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>

                {{-- Profile --}}
                <li class="nav-item">
                    <a href="{{ route('admin.profile.edit') }}"
                       class="nav-link {{ $isActive('admin.profile.edit') ? 'active' : '' }}"
                       @if($isActive('admin.profile.edit')) aria-current="page" @endif>
                        <i class="nav-icon fas fa-user-circle" aria-hidden="true"></i>
                        <p>{{ __('Profile') }}</p>
                    </a>
                </li>

                {{-- Settings --}}
                <li class="nav-item">
                    <a href="{{ route('admin.setting.edit') }}"
                       class="nav-link {{ $isActive('admin.setting.edit') ? 'active' : '' }}"
                       @if($isActive('admin.setting.edit')) aria-current="page" @endif>
                        <i class="nav-icon fas fa-cog" aria-hidden="true"></i>
                        <p>{{ __('Settings') }}</p>
                    </a>
                </li>

                {{-- Trash (only render if at least one trash route exists) --}}
                @php
                    $hasTrash = Route::has('admin.enquiry.restore.page');
                @endphp
                @if ($hasTrash)
                    <li class="nav-header" role="separator">{{ __('Maintenance') }}</li>
                    <li class="nav-item {{ $treeOpen('admin.enquiry.restore.page') }}">
                        <a href="#" class="nav-link" onclick="event.preventDefault(); this.parentElement.classList.toggle('menu-open');">
                            <i class="nav-icon fas fa-trash" aria-hidden="true"></i>
                            <p>
                                {{ __('Trash') }}
                                <i class="fas fa-angle-left right" aria-hidden="true"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.enquiry.restore.page') }}"
                                   class="nav-link {{ $isActive('admin.enquiry.restore.page') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon" aria-hidden="true"></i>
                                    <p>{{ __('Deleted enquiries') }}</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

            </ul>
        </nav>
    </div>
</aside>

<style>
    /* Sidebar polish — keeps the AdminLTE base but adds a few sane defaults */
    .main-sidebar .nav-header {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .04em;
        font-weight: 700;
        color: rgba(255,255,255,0.55);
        padding: 14px 16px 6px;
        margin-top: 6px;
    }
    .main-sidebar .nav-link[aria-current="page"] {
        background-color: rgba(255,255,255,0.10) !important;
    }
    .main-sidebar .badge.right {
        position: absolute;
        right: 8px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 10px;
        padding: 3px 7px;
    }
</style>

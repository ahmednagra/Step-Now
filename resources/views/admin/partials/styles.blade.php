
{{-- ===== Plugin CSS (forms, tables, pickers) ===== --}}
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/bootstrap-taginput/bootstrap-tagsinput.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/bootstrap-datepicker/bootstrap-datepicker.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/bootstrap-iconpicker/bootstrap-iconpicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/summernote/summernote-bs4.css') }}">

{{-- ===== DataTables (single source — local plugin path) ===== --}}
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/data-table/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/data-table/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/data-table/buttons.bootstrap4.min.css') }}">

{{-- ===== Icon fonts ===== --}}
{{-- Single Font Awesome load (was loaded 3 times: 2 from CDN + 1 local) --}}
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

{{-- ===== Toastr (notification toasts — used by master flash logic) ===== --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

{{-- ===== AdminLTE core + project polish ===== --}}
{{-- Single load each (was loaded twice in the previous version) --}}
<link rel="stylesheet" href="{{ asset('assets/admin/css/adminlte.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/css/custom.css') }}">

{{-- ===== Inline validation polish ===== --}}
<style>
    /* Bootstrap-style validation indicator with inline icon */
    .was-validated .form-control:invalid,
    .form-control.is-invalid {
        border-color: #dc3545;
        padding-right: calc(1.5em + 0.75rem);
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%23dc3545' viewBox='0 0 12 12'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right calc(0.375em + 0.1875rem) center;
        background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
    }
    .was-validated .form-control:invalid:focus,
    .form-control.is-invalid:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }

    /* Brand accent on primary buttons */
    .btn-primary {
        background-color: #0F4C81;
        border-color: #0F4C81;
    }
    .btn-primary:hover,
    .btn-primary:focus {
        background-color: #0d3f6b;
        border-color: #0d3f6b;
    }
    .btn-outline-primary {
        color: #0F4C81;
        border-color: #0F4C81;
    }
    .btn-outline-primary:hover {
        background-color: #0F4C81;
        border-color: #0F4C81;
    }

    /* Card outline + headers — brand colour */
    .card-primary.card-outline {
        border-top: 3px solid #0F4C81;
    }

    /* Footer polish */
    .main-footer {
        padding: 0.85rem 1.25rem;
        color: #475569;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
    }
    .main-footer strong { color: #0F4C81; }

    /* Top-navbar notification badge alignment */
    .navbar-badge {
        position: absolute;
        right: 5px;
        top: 9px;
        font-size: 9px;
        font-weight: 300;
        padding: 2px 4px;
    }
</style>
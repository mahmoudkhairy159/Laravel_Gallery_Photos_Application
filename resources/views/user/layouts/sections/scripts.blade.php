<!-- BEGIN: Vendor JS-->
<script src="{{ asset('assets/admin/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/libs/node-waves/node-waves.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/libs/hammer/hammer.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/libs/i18n/i18n.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/libs/typeahead-js/typeahead.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/js/menu.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/js/custom.js') }}"></script>

@yield('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset('assets/admin/js/main.js') }}"></script>

<!-- END: Theme JS-->
<!-- Pricing Modal JS-->
@stack('pricing-script')
<!-- END: Pricing Modal JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->

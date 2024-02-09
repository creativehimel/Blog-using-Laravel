<!-- JS Plugins -->
<script src="{{asset('frontendAssets/plugins/jQuery/jquery.min.js')}}"></script>

<script src="{{asset('frontendAssets/plugins/bootstrap/bootstrap.min.js')}}"></script>

<script src="{{asset('frontendAssets/plugins/slick/slick.min.js')}}"></script>

<script src="{{asset('frontendAssets/plugins/instafeed/instafeed.min.js')}}"></script>

    {{-- Toastr Js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- Toastr Script -->

    <script>
        @if (Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}"
        switch (type) {
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;
            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;
            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;
            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
        @endif
    </script>
<!-- Main Script -->
<script src="{{asset('frontendAssets/js/script.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
  $('.summernote').summernote({
    height: 200,
  });
});
</script>

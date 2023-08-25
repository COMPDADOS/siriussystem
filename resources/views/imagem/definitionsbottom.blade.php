<script src="{{asset('album/js/jquery.js')}}"></script>
<script src="{{asset('album/js/popper.min.js')}}"></script>
<script src="{{asset('album/js/bootstrap.min.js')}}"></script>
<!--Revolution Slider-->
<script src="{{asset('album/plugins/revolution/js/jquery.themepunch.revolution.min.js')}}"></script>
<script src="{{asset('album/plugins/revolution/js/jquery.themepunch.tools.min.js')}}"></script>
<script src="{{asset('album/plugins/revolution/js/extensions/revolution.extension.actions.min.js')}}"></script>
<script src="{{asset('album/plugins/revolution/js/extensions/revolution.extension.carousel.min.js')}}"></script>
<script src="{{asset('album/plugins/revolution/js/extensions/revolution.extension.kenburn.min.js')}}"></script>
<script src="{{asset('album/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
<script src="{{asset('album/plugins/revolution/js/extensions/revolution.extension.migration.min.js')}}"></script>
<script src="{{asset('album/plugins/revolution/js/extensions/revolution.extension.navigation.min.js')}}"></script>
<script src="{{asset('album/plugins/revolution/js/extensions/revolution.extension.parallax.min.js')}}"></script>
<script src="{{asset('album/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
<script src="{{asset('album/plugins/revolution/js/extensions/revolution.extension.video.min.js')}}"></script>
<script src="{{asset('album/js/main-slider-script.js')}}"></script>
<!--End Revolution Slider-->
<script src="{{asset('album/js/jquery-ui.js')}}"></script>
<script src="{{asset('album/js/jquery.fancybox.js')}}"></script>
<script src="{{asset('album/js/owl.js')}}"></script>
<script src="{{asset('album/js/wow.js')}}"></script>
<script src="{{asset('album/js/isotope.js')}}"></script>
<script src="{{asset('album/js/mixitup.js')}}"></script>
<script src="{{asset('album/js/appear.js')}}"></script>
<script src="{{asset('album/js/script.js')}}"></script>
<script src="{{asset('album/js/map-script.js'}))"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
<script>
        $('.select2').select2();
        $('.valor').inputmask('decimal',
      {
        radixPoint:",",
        groupSeparator: ".",
        autoGroup: true,
        digits: 2,
        digitsOptional: false,
        placeholder: '0',
        rightAlign: false,
        onBeforeMask: function (value, opts)
        {
          return value;
        }
      });


</script>

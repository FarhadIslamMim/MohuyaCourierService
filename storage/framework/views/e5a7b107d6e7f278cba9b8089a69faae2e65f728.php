       <!--jquery cdn-->
       <script src="https://code.jquery.com/jquery-3.6.0.min.js"
           integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

       <!-- JAVASCRIPT -->
       <script src="<?php echo e(asset('assets/backend/libs/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
       <script src="<?php echo e(asset('assets/backend/libs/simplebar/simplebar.min.js')); ?>"></script>
       <script src="<?php echo e(asset('assets/backend/libs/node-waves/waves.min.js')); ?>"></script>
       <script src="<?php echo e(asset('assets/backend/libs/feather-icons/feather.min.js')); ?>"></script>
       <script src="<?php echo e(asset('assets/backend/js/pages/plugins/lord-icon-2.1.0.js')); ?>"></script>
       <script src="<?php echo e(asset('assets/backend/js/plugins.js')); ?>"></script>


       <!-- App js -->
       <script src="<?php echo e(asset('assets/backend/js/app.js')); ?>"></script>

       <!--select2 cdn-->
       <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
       <script src="<?php echo e(asset('assets/backend/js/pages/select2.init.js')); ?>"></script>
       <script>
           $(document).ready(function() {
               $('.setlanguage').click(function() {
                   var url = "<?php echo e(route('lang.change')); ?>";
                   let lang_code = $(this).attr('data-lang');
                   window.location.href = url + "?lang=" + lang_code;
               });
           });
       </script>
<?php /**PATH /home3/sensorbd/public_html/resources/views/backend/layouts/scripts.blade.php ENDPATH**/ ?>
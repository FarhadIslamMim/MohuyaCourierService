<footer class="custom-footer bg-dark py-5 position-relative">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mt-4">
                <div>
                    <div>
                        <img src="<?php echo e(asset($setting->logo)); ?>" alt="logo light" height="80">
                    </div>
                    <div class="mt-4 fs-13">
                        <h5>Address</h5>
                        <p><?php echo e($setting->address); ?></p>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 ms-lg-auto">
                <div class="row">
                    <div class="col-sm-4 mt-4">
                        <h5 class="text-dark mb-0">Company</h5>
                        <div class="text-muted mt-3">
                            <ul class="list-unstyled ff-secondary footer-list fs-14">
                                <li><a href="<?php echo e(route('home')); ?>#about-us">About Us</a></li>
                                <li><a href="<?php echo e(route('home')); ?>#hubs">Hubs</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4 mt-4">
                        <h5 class="text-dark mb-0">Privacy & Policy</h5>
                        <div class="text-muted mt-3">
                            <ul class="list-unstyled ff-secondary footer-list fs-14">
                                <li><a href="<?php echo e(route('home.privacy')); ?>">Privacy & Policy</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4 mt-4">
                        <h5 class="text-dark mb-0">Download App</h5>
                        <div class="text-muted mt-3">
                            <ul class="list-unstyled ff-secondary footer-list fs-14">
                                <li><a target="_blank" href="https://play.google.com/store/apps/details?id=com.sensorcourier.scourier&hl=en&gl=US"><i class="lab la-google-play"></i> Download from Playstore</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row text-center text-sm-start align-items-center mt-5">
            <div class="col-sm-6">

                <div>
                    <p class="copy-rights mb-0">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © <?php echo e($setting->name); ?> - Developed by <a
                            href="https://www.onepointitbd.com/">One Point It Soultions</a>
                    </p>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end mt-3 mt-sm-0">
                    <ul class="list-inline mb-0 footer-social-link">
                        <li class="list-inline-item">
                            <a href="<?php echo e($setting->facebook); ?>" class="avatar-xs d-block">
                                <div class="avatar-title rounded-circle">
                                    <i class="ri-facebook-fill"></i>
                                </div>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="<?php echo e($setting->instagram); ?>" class="avatar-xs d-block">
                                <div class="avatar-title rounded-circle">
                                    <i class="ri-instagram-fill"></i>
                                </div>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="<?php echo e($setting->twitter); ?>" class="avatar-xs d-block">
                                <div class="avatar-title rounded-circle">
                                    <i class="ri-twitter-fill"></i>
                                </div>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- end footer -->

<!--start back-to-top-->
<button onclick="topFunction()" class="btn btn-danger btn-icon landing-back-top" id="back-to-top">
    <i class="ri-arrow-up-line"></i>
</button>
<?php /**PATH /home3/sensorbd/public_html/resources/views/frontend/layouts/footer.blade.php ENDPATH**/ ?>
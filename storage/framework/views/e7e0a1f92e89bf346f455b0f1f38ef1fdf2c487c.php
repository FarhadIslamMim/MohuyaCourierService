
<?php $__env->startSection('title', 'Signin'); ?>
<?php $__env->startSection('main-content'); ?>
    <section class="section bg-light mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card mt-4">

                    <div class="card-body p-4">
                        <div class="text-center mt-2">
                            <a href="https://www.onepointitbd.com/"><img class="py-4" width="100px"
                                    src="<?php echo e(asset('assets/button_image.png')); ?>" alt=""></a>
                            <br>
                            <h5 class="text-primary">Welcome Back !</h5>
                            <p class="text-muted">Sign in to continue to <?php echo e($setting->name); ?>.</p>
                            <?php echo $__env->make('frontend.layouts.notifications', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <div class="p-2 mt-4">
                            <form action="<?php echo e(route('frontend.auth.check')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Select your role</label>
                                    <select name="role" class="form-control" required>
                                        <option value="">Select Role</option>
                                        <option value="1">Merchant</option>
                                        <option value="2">Deliveryman</option>
                                        <option value="3">Pickupman</option>
                                        <option value="4">Agent</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" name="users" class="form-control" id="phone"
                                        placeholder="Enter phone number">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="password-input">Password </label>
                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                        <input type="password" name="password" class="form-control pe-5 password-input"
                                            placeholder="Enter password"  id="passInput">
                                        <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="showPass"><i class="ri-eye-fill align-middle"></i></button>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button class="btn btn-success w-100" type="submit">Sigin</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

                <div class="mt-4 text-center">
                    <p class="mb-0">Don't have an merchant account ? <a href="<?php echo e(route('merchant.register.page')); ?>"
                            class="fw-semibold text-primary text-decoration-underline"> Signup as merchant </a> </p>
                </div>

            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-scripts'); ?>
    <script>
        $(document).ready(function(){

            $('#showPass').on('click', function(){
                var passInput=$("#passInput");
                if(passInput.attr('type')==='password')
                {
                    passInput.attr('type','text');
                }else{
                    passInput.attr('type','password');
                }
            })
        })
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\MIM Larvel\Mohuya\resources\views/frontend/pages/signin.blade.php ENDPATH**/ ?>
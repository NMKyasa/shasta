<!-- Contact Start -->
    <div class="container-fluid bg-light overflow-hidden px-lg-0">
        <div class="container contact px-lg-0">
            <div class="row g-0 mx-lg-0">
                <div class="col-lg-6 contact-text py-5 wow fadeIn" data-wow-delay="0.5s">
                    <div class="p-lg-5 ps-lg-0">
                        <div class="section-title text-start">
                            <h1 class="display-5 mb-4">Contact Us</h1>
                        </div>
                        <p class="mb-4">
                        At Shasta Company Limited, we are committed to providing reliable and professional 
                        security solutions. Contact us today to discuss your requirements, request additional 
                        information, or speak with a member of our team.
                        </p>
                        
                        <?php if (!empty($_SESSION['success'])): ?>

                            <div class="alert alert-success">

                                <?= $_SESSION['success'] ?>

                            </div>

                            <?php unset($_SESSION['success']); ?>

                        <?php endif; ?>

                        <form
                            method="POST"
                            action="<?= url('contact') ?>"
                        >
                            <input
                                type="hidden"
                                name="_token"
                                value="<?= csrf_token() ?>"
                            > 
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="name"
                                            placeholder="Your Name"
                                            required
                                        > 
                                        <label for="name">Your Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                                        <label for="email">Your Email</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" name="phone" placeholder="Phone Number">
                                        <label for="email">Phone Number</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="subject" placeholder="Subject">
                                        <label for="subject">Subject</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a message here" name="message" style="height: 100px"></textarea>
                                        <label for="message">Message</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- <div class="col-lg-6 pe-lg-0" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <iframe class="position-absolute w-100 h-100" style="object-fit: cover;"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
                        frameborder="0" allowfullscreen="" aria-hidden="false"
                        tabindex="0"></iframe>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <!-- Contact End -->
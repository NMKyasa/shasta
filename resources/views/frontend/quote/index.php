<!-- Quote Start -->
    <div class="container-fluid bg-light overflow-hidden px-lg-0">
        <div class="container quote px-lg-0">
            <div class="row g-0 mx-lg-0">
                <div class="col-lg-6 ps-lg-0" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute img-fluid w-100 h-100" src="assets/frontend/img/quote.jpg" style="object-fit: cover;" alt="">
                    </div>
                </div>
                <div class="col-lg-6 quote-text py-5 wow fadeIn" data-wow-delay="0.5s">
                    <div class="p-lg-5 pe-lg-0">
                        <div class="bg-primary mb-3" style="width: 60px; height: 2px;"></div>
                        <h1 class="display-5 mb-5">Free Quote</h1>
                        <p class="mb-4 pb-2">
                        Tell us about your security requirements and our team will prepare a tailored solution for your home, business, institution, or project. 
                        Submit your request and we will get back to you with a professional quotation.
                        </p>

                        <?php if (!empty($_SESSION['success'])): ?>

                            <div class="alert alert-success">

                                <?= $_SESSION['success'] ?>

                            </div>

                            <?php unset($_SESSION['success']); ?>

                        <?php endif; ?>

                        <form
                            method="POST"
                            action="<?= url('quote') ?>"
                        >

                            <input
                                type="hidden"
                                name="_token"
                                value="<?= csrf_token() ?>"
                            >

                            <div class="row g-3">

                                <div class="col-12 col-sm-6">

                                    <input
                                        type="text"
                                        name="name"
                                        class="form-control border-0"
                                        placeholder="Your Name"
                                        required
                                        style="height:55px;"
                                    >

                                </div>

                                <div class="col-12 col-sm-6">

                                    <input
                                        type="email"
                                        name="email"
                                        class="form-control border-0"
                                        placeholder="Your Email"
                                        required
                                        style="height:55px;"
                                    >

                                </div>

                                <div class="col-12 col-sm-6">

                                    <input
                                        type="number"
                                        name="phone"
                                        class="form-control border-0"
                                        placeholder="Your Mobile"
                                        style="height:55px;"
                                    >

                                </div>

                                <div class="col-12 col-sm-6">

                                    <select
                                        name="service_id"
                                        class="form-select border-0"
                                        required
                                        style="height:55px;"
                                    >

                                        <option value="">
                                            Select A Service
                                        </option>

                                        <?php foreach ($services as $service): ?>

                                            <option
                                                value="<?= $service['id'] ?>"
                                            >

                                                <?= htmlspecialchars(
                                                    $service['title']
                                                ) ?>

                                            </option>

                                        <?php endforeach; ?>

                                    </select>

                                </div>

                                <div class="col-12">

                                    <textarea
                                        name="message"
                                        class="form-control border-0"
                                        placeholder="Describe your requirements"
                                        rows="5"
                                    ></textarea>

                                </div>

                                <div class="col-12">

                                    <button
                                        class="btn btn-primary w-100 py-3"
                                        type="submit"
                                    >

                                        Request Free Quote

                                    </button>

                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quote End -->
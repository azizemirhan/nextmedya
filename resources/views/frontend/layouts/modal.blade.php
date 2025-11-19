
<div class="modal fade popups est-popup" id="exampleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="estimated-price popup">
                    <div class="est-form">
                        <h3>Estimatied Price</h3>
                        <p>To get the cost estimation of your house please select from the following:</p>
                        <form>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="inputState-1">House Area</label>
                                    <select id="inputState-1" class="form-control">
                                        <option selected>Choose Area</option>
                                        <option>...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 space">
                                    <label for="inputState-2">Room</label>
                                    <select id="inputState-2" class="form-control">
                                        <option selected>Select Room</option>
                                        <option>...</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputState-3">Bathroom</label>
                                    <div class="gg">
                                        <select id="inputState-3" class="form-control">
                                            <option selected>Select Bathroom</option>
                                            <option>...</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row checkk g-0">
                                <p>Building Materials</p>
                                <div class="form-group col-md-6">
                                    <div class="custom-control custom-radio">
                                        <input checked type="radio" id="customRadio1" name="customRadio"
                                               class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio1">A+ Grey Structure</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio2" name="customRadio"
                                               class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio2">Premium Finishing</label>
                                    </div>
                                </div>
                            </div>
                            <div class="est-main">
                                <p>A+ House Construction Tentative Amount</p>
                                <div class="est-price">
                                    <p>Estimated Price:</p>
                                    <span class="price">$ 80000</span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade popups conslt-popup" id="exampleModal1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="contact-form-one popup">
                    <div class="c-form-2">
                        <h3>Start Consulting</h3>
                        <div class="parallax"
                             style="background-image: url({{ asset('site/assets/images/pattren.png') }});"></div>
                        <form>
                            <div class="row g-0">
                                <input type="text" class="form-control" id="exampleInputText1"
                                       placeholder="Complete Name">
                            </div>
                            <div class="row g-0">
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                       placeholder="Email Address">
                            </div>
                            <div class="row g-0">
                                <input type="number" class="form-control" id="exampleInputPassword1"
                                       placeholder="Phone No">
                            </div>
                            <div class="row g-0">
                                <select id="inputState-21" class="form-control">
                                    <option selected>Subject</option>
                                    <option>Subject 1</option>
                                    <option>Subject 2</option>
                                    <option>Subject 3</option>
                                </select>
                            </div>
                            <div class="row g-0">
                                <textarea placeholder="Question / Message?"></textarea>
                            </div>
                            <button type="submit" class="theme-btn">Submit Now <i class="fa-solid fa-angles-right"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

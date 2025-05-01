<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/apps/work/controllers/ServicesController.php';

$service = new ServicesController();

$service->authCheck();

//$home->notications();

$role = $_SESSION['role'];

include $path . '/apps/work/ui/layouts/nav.php';

?>

<section class="py-60">
    <div class="container-lg">
        <div class="row">
            <div class="d-block bg-white p-3 p-md-5 bg-white rounded-3 shadow">
                <form method="POST" action="/api/serviceAPI.php" enctype="multipart/form-data">
                    <input type="hidden" name="service_status" value="1">
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">

                    <div class="row gy-4">
                        <div class="col-md-6">
                            <input type="file" name="file" placeholder="" class="" />
                        
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-6">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">
                                        Service Title:
                                        <span class="fs-16 fw-900 text-danger">*</span>
                                    </label>
                                    <input type="text" name="title" required placeholder="Enter Job Title"
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row gy-3">
                        <div class="col-md-6">
                            <div class="d-flex flex-column gap-2">
                                <label for="" class="mytext-black fs-14 text-uppercase">
                                    Indusrty:
                                    <span class="fs-16 fw-900 text-danger">*</span>
                                </label>
                                <select name="industry" id=""
                                    class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2"
                                    required>
                                    <option value="">Select Industry</option>
                                    <option value="1">Accounting</option>
                                    <option value="2">Airlines/Aviation</option>
                                    <option value="3">Alternative Dispute Resolution</option>
                                    <option value="4">Alternative Medicine</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            
                                <div class="d-flex flex-column gap-2">
                                    <?php

                                   $service->select_countries();
                                    ?>
                            
                            </div>
                        </div>
                    </div>
                    <div class="row gy-4">
                        <div class="d-flex flex-column gap-2 mb-4">
                            <label for="" class="mytext-black fs-14 text-uppercase">
                                Service Description:
                                <span class="fs-16 fw-900 text-danger">*</span>
                            </label>
                            <textarea name="description" id="checkeyword" required cols="30" rows="7"
                                maxlength="5000"
                                class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2"></textarea>
                            <span class="fs-12 text-end countype">0/5000</span>
                        </div>
                    </div>
                    <div class="row gy-4">
                        <div class="col-12">
                            <label for="" class="mytext-black fs-14 text-uppercase">Service Options</label>
                            <div id="service-options-container">
                                <?php for ($i = 0; $i < 3; $i++) { ?>
                                    <div class="d-flex gap-2 service-option-wrapper">
                                        <input type="text" name="service_options[]" required
                                            placeholder="Option" class="bg-white flex-fill border border-seacondary border-opcity-25 p-2 fs-14 rounded-2" />
                                        <input type="text" name="option_prices[]" value=""
                                            placeholder="Price" class="bg-white flex-fill border border-seacondary border-opcity-25 p-2 fs-14 rounded-2" />
                                        <button type="button" class="btn btn-danger btn-remove-service-option">X</button>
                                    </div>
                                <?php } ?>
                            </div>
                            <button type="button" class="btn btn-secondary btn-add-service-option">Add Service
                                Option</button>
                        </div>
                    </div>
                    <div class="row gy-4">
                        <div class="col-12">
                            <div class="d-flex flex-column gap-2">
                                <label for="availability" class="mytext-black fs-14 text-uppercase">Availability</label>
                                <div class="d-flex flex-wrap">
                                    <div class="form-check flex-fill">
                                        <input class="form-check-input" type="checkbox" name="availability[]" id="monday" value="Monday">
                                        <label class="form-check-label" for="monday">
                                            Monday
                                        </label>
                                    </div>
                                    <div class="form-check flex-fill">
                                        <input class="form-check-input" type="checkbox" name="availability[]" id="tuesday" value="Tuesday">
                                        <label class="form-check-label" for="tuesday">
                                            Tuesday
                                        </label>
                                    </div>
                                    <div class="form-check flex-fill">
                                        <input class="form-check-input" type="checkbox" name="availability[]" id="wednesday" value="Wednesday">
                                        <label class="form-check-label" for="wednesday">
                                            Wednesday
                                        </label>
                                    </div>
                                    <div class="form-check flex-fill">
                                        <input class="form-check-input" type="checkbox" name="availability[]" id="thursday" value="Thursday">
                                        <label class="form-check-label" for="thursday">
                                            Thursday
                                        </label>
                                    </div>
                                    <div class="form-check flex-fill">
                                        <input class="form-check-input" type="checkbox" name="availability[]" id="friday" value="Friday">
                                        <label class="form-check-label" for="friday">
                                            Friday
                                        </label>
                                    </div>
                                    <div class="form-check flex-fill">
                                        <input class="form-check-input" type="checkbox" name="availability[]" id="saturday" value="Saturday">
                                        <label class="form-check-label" for="saturday">
                                            Saturday
                                        </label>
                                    </div>
                                    <div class="form-check flex-fill">
                                        <input class="form-check-input" type="checkbox" name="availability[]" id="sunday" value="Sunday">
                                        <label class="form-check-label" for="sunday">
                                            Sunday
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" name="post_service">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const serviceOptionsContainer = document.getElementById("service-options-container");
        const addServiceOptionButton = document.querySelector(".btn-add-service-option");

        addServiceOptionButton.addEventListener("click", function () {
            const optionInput = document.createElement("input");
            optionInput.type = "text";
            optionInput.name = "service_options[]";
            optionInput.required = true;
            optionInput.placeholder = "Option";
            optionInput.classList.add("bg-white", "flex-fill", "border", "border-seacondary", "border-opcity-25", "p-2", "fs-14", "rounded-2");

            const priceInput = document.createElement("input");
            priceInput.type = "text";
            priceInput.name = "option_prices[]";
            priceInput.value = "";
            priceInput.placeholder = "Price";
            priceInput.classList.add("bg-white", "flex-fill", "border", "border-seacondary", "border-opcity-25", "p-2", "fs-14", "rounded-2");

            const serviceOptionWrapper = document.createElement("div");
            serviceOptionWrapper.classList.add("d-flex", "gap-2", "service-option-wrapper");
            serviceOptionWrapper.appendChild(optionInput);
            serviceOptionWrapper.appendChild(priceInput);

            const removeServiceOptionButton = document.createElement("button");
            removeServiceOptionButton.type = "button";
            removeServiceOptionButton.classList.add("btn", "btn-danger", "btn-remove-service-option");
            removeServiceOptionButton.textContent = "X";
            removeServiceOptionButton.addEventListener("click", function () {
                serviceOptionWrapper.remove();
            });

            serviceOptionWrapper.appendChild(removeServiceOptionButton);
            serviceOptionsContainer.appendChild(serviceOptionWrapper);
        });

        const removeServiceOptionButtons = document.querySelectorAll(".btn-remove-service-option");
        removeServiceOptionButtons.forEach(function (button) {
            button.addEventListener("click", function () {
                button.closest(".service-option-wrapper").remove();
            });
        });
    });
</script>

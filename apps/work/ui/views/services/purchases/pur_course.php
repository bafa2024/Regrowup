<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/apps/work/controllers/ContractController.php';

$contract = new ContractController();

$contract->authCheck();

include $path.'/apps/work/ui/layouts/nav.php';

/*
get contract type if fixed or hourly
if fixed then show fixed contract form else show hourly contract form
*/

$contract = $contract->getContract($_GET['ct'])["type"];

if ($contract == "fixed") {
    ?>
<section class="py-60">
    <div class="container-lg">
        <div class="row border rounded-3 shadow bg-white p-4">
            <form method="POST" action="/api/contractAPI.php" enctype="multipart/form-data">
                <input type="hidden" name="contract_id" value="<?php echo $_GET['ct']; ?>">
                <input type="hidden" name="client_id" value="<?php echo $_GET['cl']; ?>">
                <input type="hidden" name="applicant_id" value="<?php echo $_SESSION['user_id']; ?>">
                <div class="col-12">
                    <div class="d-block bg-white p-4 rounded-3">
                        <div class="row gy-4">
                            <div class="col-12">
                                <h2 class="mytext-black fw-800 text-uppercase fs-28 fs-md-32">
                                    Application Details
                                </h2>
                            </div>
                            <div class="col-12">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Brief description of yourself</label>
                                    <textarea name="description" required id="" cols="30" rows="6" placeholder="Type here....." class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2"></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Duration</label>
                                    <select name="duration" id="" required class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2">
                                        <option value="">Select Duration</option>
                                        <option value="1 Month">1 Month</option>
                                        <option value="2 Months">2 Months</option>
                                        <option value="3 Months">3 Months</option>
                                        <option value="4 Months">4 Months</option>
                                        <option value="5 Months">5 Months</option>
                                        <option value="6 Months">6 Months</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Charges $</label>
                                    <input type="text" name="charges" required value="" placeholder="0.00$....." class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2" />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Milestones</label>
                                    <div id="milestones-container">
                                        <?php for ($i = 0; $i < 3; $i++) { ?>
                                            <div class="d-flex gap-2 milestone-wrapper">
                                                <input type="text" name="milestones[]" required placeholder="Milestone" class="bg-white flex-fill border border-seacondary border-opcity-25 p-2 fs-14 rounded-2" />
                                                <input type="text" name="milestone_prices[]" value="" placeholder="Price" class="bg-white flex-fill border border-seacondary border-opcity-25 p-2 fs-14 rounded-2" />
                                                <button type="button" class="btn btn-danger btn-remove-milestone">X</button>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <button type="button" class="btn btn-secondary btn-add-milestone">Add Milestone</button>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="d-flex flex-justify-end">
                                    <button type="submit" class="post-btn ms-auto" name="apply">Apply</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const milestonesContainer = document.getElementById("milestones-container");
        const addMilestoneButton = document.querySelector(".btn-add-milestone");
        const chargesInput = document.querySelector("input[name='charges']");

        addMilestoneButton.addEventListener("click", function () {
            const milestoneInput = document.createElement("input");
            milestoneInput.type = "text";
            milestoneInput.name = "milestones[]";
            milestoneInput.required = true;
            milestoneInput.placeholder = "Milestone";
            milestoneInput.classList.add("bg-white", "flex-fill", "border", "border-seacondary", "border-opcity-25", "p-2", "fs-14", "rounded-2");

            const priceInput = document.createElement("input");
            priceInput.type = "text";
            priceInput.name = "milestone_prices[]";
            priceInput.value = chargesInput.value !== "" ? (0.15 * parseFloat(chargesInput.value)).toFixed(2) : "";
            priceInput.placeholder = "Price";
            priceInput.classList.add("bg-white", "flex-fill", "border", "border-seacondary", "border-opcity-25", "p-2", "fs-14", "rounded-2");

            const milestoneWrapper = document.createElement("div");
            milestoneWrapper.classList.add("d-flex", "gap-2", "milestone-wrapper");
            milestoneWrapper.appendChild(milestoneInput);
            milestoneWrapper.appendChild(priceInput);

            const removeMilestoneButton = document.createElement("button");
            removeMilestoneButton.type = "button";
            removeMilestoneButton.classList.add("btn", "btn-danger", "btn-remove-milestone");
            removeMilestoneButton.textContent = "X";
            removeMilestoneButton.addEventListener("click", function () {
                milestoneWrapper.remove();
            });

            milestoneWrapper.appendChild(removeMilestoneButton);
            milestonesContainer.appendChild(milestoneWrapper);
        });

        const removeMilestoneButtons = document.querySelectorAll(".btn-remove-milestone");
        removeMilestoneButtons.forEach(function (button) {
            button.addEventListener("click", function () {
                button.closest(".milestone-wrapper").remove();
            });
        });
    });
</script>

    <?php
} else {
    ?>
<section class="py-60">
    <div class="container-lg">
        <div class="row border rounded-3 shadow bg-white p-4">
            <form method="POST" action="/api/contractAPI.php" enctype="multipart/form-data">
                <input type="hidden" name="contract_id" value="<?php echo $_GET['ct']; ?>">
                <input type="hidden" name="client_id" value="<?php echo $_GET['cl']; ?>">
                <input type="hidden" name="applicant_id" value="<?php echo $_SESSION['user_id']; ?>">
                <div class="col-12">
                    <div class="d-block bg-white p-4 rounded-3">
                        <div class="row gy-4">
                            <div class="col-12">
                                <h2 class="mytext-black fw-800 text-uppercase fs-28 fs-md-32">
                                    Application Details
                                </h2>
                            </div>
                            <div class="col-12">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Brief description of yourself</label>
                                    <textarea name="description" required id="" cols="30" rows="6" placeholder="Type here....." class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2"></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Delivery Time</label>
                                    <select name="delivery_time" id="" required class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2">
                                        <option value="">Select Delivery Time</option>
                                        <option value="1 Week">1 Week</option>
                                        <option value="2 Weeks">2 Weeks</option>
                                        <option value="3 Weeks">3 Weeks</option>
                                        <option value="1 Month">1 Month</option>
                                        <option value="2 Months">2 Months</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Charges per Hour $</label>
                                    <input type="text" name="charges" required value="" placeholder="0.00$....." class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2" />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Milestones</label>
                                    <div id="milestones-container">
                                        <?php for ($i = 0; $i < 3; $i++) { ?>
                                            <div class="d-flex gap-2 milestone-wrapper">
                                                <input type="text" name="milestones[]" required placeholder="Milestone" class="bg-white flex-fill border border-seacondary border-opcity-25 p-2 fs-14 rounded-2" />
                                                <input type="text" name="milestone_prices[]" value="" placeholder="Price" class="bg-white flex-fill border border-seacondary border-opcity-25 p-2 fs-14 rounded-2" />
                                                <button type="button" class="btn btn-danger btn-remove-milestone">X</button>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <button type="button" class="btn btn-secondary btn-add-milestone">Add Milestone</button>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="d-flex flex-justify-end">
                                    <button type="submit" class="post-btn ms-auto" name="apply">Apply</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const milestonesContainer = document.getElementById("milestones-container");
        const addMilestoneButton = document.querySelector(".btn-add-milestone");
        const chargesInput = document.querySelector("input[name='charges']");

        addMilestoneButton.addEventListener("click", function () {
            const milestoneInput = document.createElement("input");
            milestoneInput.type = "text";
            milestoneInput.name = "milestones[]";
            milestoneInput.required = true;
            milestoneInput.placeholder = "Milestone";
            milestoneInput.classList.add("bg-white", "flex-fill", "border", "border-seacondary", "border-opcity-25", "p-2", "fs-14", "rounded-2");

            const priceInput = document.createElement("input");
            priceInput.type = "text";
            priceInput.name = "milestone_prices[]";
            priceInput.value = "";
            priceInput.placeholder = "Price";
            priceInput.classList.add("bg-white", "flex-fill", "border", "border-seacondary", "border-opcity-25", "p-2", "fs-14", "rounded-2");

            const milestoneWrapper = document.createElement("div");
            milestoneWrapper.classList.add("d-flex", "gap-2", "milestone-wrapper");
            milestoneWrapper.appendChild(milestoneInput);
            milestoneWrapper.appendChild(priceInput);

            const removeMilestoneButton = document.createElement("button");
            removeMilestoneButton.type = "button";
            removeMilestoneButton.classList.add("btn", "btn-danger", "btn-remove-milestone");
            removeMilestoneButton.textContent = "X";
            removeMilestoneButton.addEventListener("click", function () {
                milestoneWrapper.remove();
            });

            milestoneWrapper.appendChild(removeMilestoneButton);
            milestonesContainer.appendChild(milestoneWrapper);
        });

        const removeMilestoneButtons = document.querySelectorAll(".btn-remove-milestone");
        removeMilestoneButtons.forEach(function (button) {
            button.addEventListener("click", function () {
                button.closest(".milestone-wrapper").remove();
            });
        });
    });
</script>


    <?php
}

?>


<?php
include $path.'/apps/work/ui/layouts/footer.php';
?>

<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'];

// Get contract controller
include $path.'/work/controllers/ContractController.php';

$ct = new ContractController();

$ct->authCheck();

include $path.'/work/ui/layouts/nav.php'; // Separate navigation scripts

?>

<section class="py-60">
    <div class="container-lg">
        <div class="row">
            <div class="d-flex border rounded-3 shadow bg-white p-4">
                <form method="POST" action="/api/contractAPI.php" enctype="multipart/form-data">
                    <div class="col-12">
                        <div class="d-block bg-white p-4 rounded-3">
                            <div class="row gy-4">
                                <div class="col-12">
                                    <h2 class="mytext-black fw-800 fs-28 fs-md-32">
                                        Post a Contract
                                    </h2>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex justify-content-start gap-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="contract_type" id="hourly" value="hourly" checked>
                                            <label class="form-check-label" for="hourly">
                                                Hourly
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="contract_type" id="fixed" value="fixed">
                                            <label class="form-check-label" for="fixed">
                                                Fixed
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex flex-column gap-2">
                                        <label for="title" class="mytext-black fs-14 text-uppercase">Contract Title</label>
                                        <input type="text" name="title" id="title" required placeholder="Title....." class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex flex-column gap-2">
                                        <label for="price" class="mytext-black fs-14 text-uppercase">Price $</label>
                                        <input type="text" name="price" id="price" required value="" placeholder="Type here....." class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2" />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex flex-column gap-2">
                                        <label for="availability" class="mytext-black fs-14 text-uppercase">Availability</label>
                                        <div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="availability[]" id="monday" value="Monday">
                                                <label class="form-check-label" for="monday">
                                                    Monday
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="availability[]" id="tuesday" value="Tuesday">
                                                <label class="form-check-label" for="tuesday">
                                                    Tuesday
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="availability[]" id="wednesday" value="Wednesday">
                                                <label class="form-check-label" for="wednesday">
                                                    Wednesday
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="availability[]" id="thursday" value="Thursday">
                                                <label class="form-check-label" for="thursday">
                                                    Thursday
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="availability[]" id="friday" value="Friday">
                                                <label class="form-check-label" for="friday">
                                                    Friday
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="availability[]" id="saturday" value="Saturday">
                                                <label class="form-check-label" for="saturday">
                                                    Saturday
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="availability[]" id="sunday" value="Sunday">
                                                <label class="form-check-label" for="sunday">
                                                    Sunday
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6" id="hours_per_week">
                                    <div class="d-flex flex-column gap-2">
                                        <label for="hours" class="mytext-black fs-14 text-uppercase">Hours per Week</label>
                                        <input type="number" name="hours" id="hours" required class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2" />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex flex-column gap-2">
                                        <label for="duration" class="mytext-black fs-14 text-uppercase">Duration (month)</label>
                                        <input type="number" name="duration" id="duration" required class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2" />
                                    </div>
                                    <div class="d-flex flex-column gap-2">
                                        <label for="expertise" class="mytext-black fs-14 text-uppercase">Level of Expertise</label>
                                        <select name="expertise" id="expertise" required class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2">
                                            <option value="">Select</option>
                                            <option value="Beginner">Beginner</option>
                                            <option value="Intermediate">Intermediate</option>
                                            <option value="Advanced">Advanced</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex flex-column gap-2">
                                        <label for="skills" class="mytext-black fs-14 text-uppercase">Skills</label>
                                        <textarea name="skills" id="skills" required cols="30" rows="6" placeholder="Type Skills here....." class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2"></textarea>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex flex-column gap-2">
                                        <label for="description" class="mytext-black fs-14 text-uppercase">Brief description of your contract</label>
                                        <textarea name="description" id="description" required cols="30" rows="6" placeholder="Type here....." class="bg-white w-100 border border-secondary border-opacity-25 p-2 fs-14 rounded-2"></textarea>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="d-flex flex-justify-end">
                                        <button type="submit" class="post-btn ms-auto" name="post_contract">
                                            Post
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
include $path.'/work/ui/layouts/footer.php';
?>

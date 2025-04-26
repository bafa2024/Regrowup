<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/work/controllers/GigsController.php';

$gig = new GigsController();

$gig->authCheck();

//$home->notications();

$role = $_SESSION['role'];

include $path . '/work/ui/layouts/nav.php';

?>
<style>
.step3 {
    display: none;
}

.step2 {
    display: none;
}
</style>
<section class="d-block py-60">
    <div class="container-lg">
        <div class="row gy-4">
            <div class="col-12">
                <div class="d-block bg-white p-3 p-md-5 bg-white rounded-3 shadow">
                    <div class="d-flex flex-column mb-4">
                        <h2 class="mytext-black fw-800 text-uppercase fs-28 fs-md-32">
                            Create Gig
                        </h2>
                    </div>
                    <form method="POST" action="/api/gigsAPI.php" enctype="multipart/form-data">
                        <input type="hidden" name="" value="">        
                        <input type="hidden" name="" value="">                   
                          <div class="row gy-4">
                            <div class="col-12 step1">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Gig Title</label>
                                    <textarea name="gigtitle" required id="gigtitle" cols="30" rows="4"
                                        placeholder="I will do something I'm really good at"
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="" class="mytext-black fs-14 text-uppercase">Category</label>
                            </div>
                            <div class="col-md-6 step1">
                                <div class="d-flex flex-column gap-2">

                                    <select name="category" id="category" required
                                        onchange="return getsubcategory(this)"
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2">
                                        <option value="">Select</option>
  <option value="Local Jobs">Local Jobs</option>
  <option value="Writing">Writing</option>
  <option value="Web, Mobile &amp; Software Dev">Web, Mobile &amp; Software Dev</option>
  <option value="Translation">Translation</option>
  <option value="Sales &amp; Marketing">Sales &amp; Marketing</option>
  <option value="Legal">Legal</option>
  <option value="IT &amp; Networking">IT &amp; Networking</option>
  <option value="Engineering &amp; Architecture">Engineering &amp; Architecture</option>
  <option value="Design &amp; Creative">Design &amp; Creative</option>
  <option value="Data Science &amp; Analytics">Data Science &amp; Analytics</option>
  <option value="Customer Service">Customer Service</option>
  <option value="Admin Support">Admin Support</option>
  <option value="Accounting &amp; Consulting">Accounting &amp; Consulting</option>
                                </select>
</div>
                            </div>


                            <div class="col-md-6 step1">
                                <div class="d-flex flex-column gap-2">
                                    <select name="subcategory" id="subcategory" required
                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2">
                                        <option value="">Select SubCategory</option>
                                        
                                        <option value="Writing">Writing</option>
<option value="Web, Mobile & Software Dev">Web, Mobile & Software Dev</option>
<option value="Translation">Translation</option>
<option value="Sales & Marketing">Sales & Marketing</option>
<option value="Legal">Legal</option>
<option value="IT & Networking">IT & Networking</option>
<option value="Engineering & Architecture">Engineering & Architecture</option>
<option value="Design & Creative">Design & Creative</option>
<option value="Data Science & Analytics">Data Science & Analytics</option>
<option value="Customer Service">Customer Service</option>
<option value="Admin Support">Admin Support</option>
<option value="Accounting & Consulting">Accounting & Consulting</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 step1">
                                <div class="d-flex flex-column gap-2">
                                    <label for="" class="mytext-black fs-14 text-uppercase">Location</label>
                                    <?php
                                    $gig->select_countries();

                                    ?>
                            </div>
                            </div>
                            <div class="col-12 step1">
                                <div class="table-responsive">
                                    <table class="table ">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th class="text-black fs-16">Basic</th>
                                                <th class="text-black fs-16">Standard</th>
                                                <th class="text-black fs-16">Premium</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td rowspan="3">
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column gap-2">
                                                        <h6 class="text-black fs-14">Name your package</h6>
                                                        <input type="text" name="basicpackage" id="basicpackage"
                                                            required placeholder="Type here....."
                                                            class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column gap-2">
                                                        <h6 class="text-black fs-14">Name your package</h6>
                                                        <input type="text" placeholder="Type here....." required
                                                            name="standardpackage" id="standardpackage"
                                                            class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column gap-2">
                                                        <h6 class="text-black fs-14">Name your package</h6>
                                                        <input type="text" placeholder="Type here....." required
                                                            name="premiumpackage" id="premiumpackage"
                                                            class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2" />
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex flex-column gap-2">
                                                        <h6 class="text-black fs-14">Describe the details of
                                                            your offering
                                                        </h6>
                                                        <input type="text" id="basicdescribe" name="basicdescribe"
                                                            required placeholder="Type here....."
                                                            class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column gap-2">
                                                        <h6 class="text-black fs-14">Describe the details of
                                                            your offering
                                                        </h6>
                                                        <input type="text" name="standardescribe" id="standardescribe"
                                                            required placeholder="Type here....."
                                                            class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column gap-2">
                                                        <h6 class="text-black fs-14">Describe the details of
                                                            your offering
                                                        </h6>
                                                        <input type="text" name="premiumdescribe" id="premiumdescribe"
                                                            required placeholder="Type here....."
                                                            class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2" />
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <select name="basic_delieverytime" id="basic_delieverytime" required
                                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2">
                                                        <option value="">Delivery Time</option>
                                                         <option value="1">
                                                                                                                        1
                                                            Day
                                                                                                                        </option>
                                                             <option value="2">
                                                                                                                        2
                                                            Days
                                                                                                                        </option>
                                                             <option value="3">
                                                                                                                        3
                                                            Days
                                                                                                                        </option>
                                                             <option value="4">
                                                                                                                        4
                                                            Days
                                                                                                                        </option>
                                                             <option value="5">
                                                                                                                        5
                                                            Days
                                                                                                                        </option>
                                                             <option value="6">
                                                                                                                        6
                                                            Days
                                                                                                                        </option>
                                                             <option value="7">
                                                                                                                        7
                                                            Days
                                                                                                                        </option>
                                                             <option value="8">
                                                                                                                        8
                                                            Days
                                                                                                                        </option>
                                                             <option value="9">
                                                                                                                        9
                                                            Days
                                                                                                                        </option>
                                                             <option value="10">
                                                                                                                        10
                                                            Days
                                                                                                                        </option>
                                                             <option value="11">
                                                                                                                        11
                                                            Days
                                                                                                                        </option>
                                                             <option value="12">
                                                                                                                        12
                                                            Days
                                                                                                                        </option>
                                                             <option value="13">
                                                                                                                        13
                                                            Days
                                                                                                                        </option>
                                                             <option value="14">
                                                                                                                        14
                                                            Days
                                                                                                                        </option>
                                                             <option value="15">
                                                                                                                        15
                                                            Days
                                                                                                                        </option>
                                                             <option value="16">
                                                                                                                        16
                                                            Days
                                                                                                                        </option>
                                                             <option value="17">
                                                                                                                        17
                                                            Days
                                                                                                                        </option>
                                                             <option value="18">
                                                                                                                        18
                                                            Days
                                                                                                                        </option>
                                                             <option value="19">
                                                                                                                        19
                                                            Days
                                                                                                                        </option>
                                                             <option value="20">
                                                                                                                        20
                                                            Days
                                                                                                                        </option>
                                                             <option value="21">
                                                                                                                        21
                                                            Days
                                                                                                                        </option>
                                                             <option value="22">
                                                                                                                        22
                                                            Days
                                                                                                                        </option>
                                                             <option value="23">
                                                                                                                        23
                                                            Days
                                                                                                                        </option>
                                                             <option value="24">
                                                                                                                        24
                                                            Days
                                                                                                                        </option>
                                                             <option value="25">
                                                                                                                        25
                                                            Days
                                                                                                                        </option>
                                                             <option value="26">
                                                                                                                        26
                                                            Days
                                                                                                                        </option>
                                                             <option value="27">
                                                                                                                        27
                                                            Days
                                                                                                                        </option>
                                                             <option value="28">
                                                                                                                        28
                                                            Days
                                                                                                                        </option>
                                                             <option value="29">
                                                                                                                        29
                                                            Days
                                                                                                                        </option>
                                                             <option value="30">
                                                                                                                        30
                                                            Days
                                                                                                                        </option>
                                                             <option value="31">
                                                                                                                        31
                                                            Days
                                                                                                                        </option>
                                                             <option value="32">
                                                                                                                        32
                                                            Days
                                                                                                                        </option>
                                                             <option value="33">
                                                                                                                        33
                                                            Days
                                                                                                                        </option>
                                                             <option value="34">
                                                                                                                        34
                                                            Days
                                                                                                                        </option>
                                                             <option value="35">
                                                                                                                        35
                                                            Days
                                                                                                                        </option>
                                                             <option value="36">
                                                                                                                        36
                                                            Days
                                                                                                                        </option>
                                                             <option value="37">
                                                                                                                        37
                                                            Days
                                                                                                                        </option>
                                                             <option value="38">
                                                                                                                        38
                                                            Days
                                                                                                                        </option>
                                                             <option value="39">
                                                                                                                        39
                                                            Days
                                                                                                                        </option>
                                                             <option value="40">
                                                                                                                        40
                                                            Days
                                                                                                                        </option>
                                                             <option value="41">
                                                                                                                        41
                                                            Days
                                                                                                                        </option>
                                                             <option value="42">
                                                                                                                        42
                                                            Days
                                                                                                                        </option>
                                                             <option value="43">
                                                                                                                        43
                                                            Days
                                                                                                                        </option>
                                                             <option value="44">
                                                                                                                        44
                                                            Days
                                                                                                                        </option>
                                                             <option value="45">
                                                                                                                        45
                                                            Days
                                                                                                                        </option>
                                                             <option value="46">
                                                                                                                        46
                                                            Days
                                                                                                                        </option>
                                                             <option value="47">
                                                                                                                        47
                                                            Days
                                                                                                                        </option>
                                                             <option value="48">
                                                                                                                        48
                                                            Days
                                                                                                                        </option>
                                                             <option value="49">
                                                                                                                        49
                                                            Days
                                                                                                                        </option>
                                                             <option value="50">
                                                                                                                        50
                                                            Days
                                                                                                                        </option>
                                                             <option value="51">
                                                                                                                        51
                                                            Days
                                                                                                                        </option>
                                                             <option value="52">
                                                                                                                        52
                                                            Days
                                                                                                                        </option>
                                                             <option value="53">
                                                                                                                        53
                                                            Days
                                                                                                                        </option>
                                                             <option value="54">
                                                                                                                        54
                                                            Days
                                                                                                                        </option>
                                                             <option value="55">
                                                                                                                        55
                                                            Days
                                                                                                                        </option>
                                                             <option value="56">
                                                                                                                        56
                                                            Days
                                                                                                                        </option>
                                                             <option value="57">
                                                                                                                        57
                                                            Days
                                                                                                                        </option>
                                                             <option value="58">
                                                                                                                        58
                                                            Days
                                                                                                                        </option>
                                                             <option value="59">
                                                                                                                        59
                                                            Days
                                                                                                                        </option>
                                                             <option value="60">
                                                                                                                        60
                                                            Days
                                                                                                                        </option>
                                                             <option value="61">
                                                                                                                        61
                                                            Days
                                                                                                                        </option>
                                                             <option value="62">
                                                                                                                        62
                                                            Days
                                                                                                                        </option>
                                                             <option value="63">
                                                                                                                        63
                                                            Days
                                                                                                                        </option>
                                                             <option value="64">
                                                                                                                        64
                                                            Days
                                                                                                                        </option>
                                                             <option value="65">
                                                                                                                        65
                                                            Days
                                                                                                                        </option>
                                                             <option value="66">
                                                                                                                        66
                                                            Days
                                                                                                                        </option>
                                                             <option value="67">
                                                                                                                        67
                                                            Days
                                                                                                                        </option>
                                                             <option value="68">
                                                                                                                        68
                                                            Days
                                                                                                                        </option>
                                                             <option value="69">
                                                                                                                        69
                                                            Days
                                                                                                                        </option>
                                                             <option value="70">
                                                                                                                        70
                                                            Days
                                                                                                                        </option>
                                                             <option value="71">
                                                                                                                        71
                                                            Days
                                                                                                                        </option>
                                                             <option value="72">
                                                                                                                        72
                                                            Days
                                                                                                                        </option>
                                                             <option value="73">
                                                                                                                        73
                                                            Days
                                                                                                                        </option>
                                                             <option value="74">
                                                                                                                        74
                                                            Days
                                                                                                                        </option>
                                                             <option value="75">
                                                                                                                        75
                                                            Days
                                                                                                                        </option>
                                                             <option value="76">
                                                                                                                        76
                                                            Days
                                                                                                                        </option>
                                                             <option value="77">
                                                                                                                        77
                                                            Days
                                                                                                                        </option>
                                                             <option value="78">
                                                                                                                        78
                                                            Days
                                                                                                                        </option>
                                                             <option value="79">
                                                                                                                        79
                                                            Days
                                                                                                                        </option>
                                                             <option value="80">
                                                                                                                        80
                                                            Days
                                                                                                                        </option>
                                                             <option value="81">
                                                                                                                        81
                                                            Days
                                                                                                                        </option>
                                                             <option value="82">
                                                                                                                        82
                                                            Days
                                                                                                                        </option>
                                                             <option value="83">
                                                                                                                        83
                                                            Days
                                                                                                                        </option>
                                                             <option value="84">
                                                                                                                        84
                                                            Days
                                                                                                                        </option>
                                                             <option value="85">
                                                                                                                        85
                                                            Days
                                                                                                                        </option>
                                                             <option value="86">
                                                                                                                        86
                                                            Days
                                                                                                                        </option>
                                                             <option value="87">
                                                                                                                        87
                                                            Days
                                                                                                                        </option>
                                                             <option value="88">
                                                                                                                        88
                                                            Days
                                                                                                                        </option>
                                                             <option value="89">
                                                                                                                        89
                                                            Days
                                                                                                                        </option>
                                                             <option value="90">
                                                                                                                        90
                                                            Days
                                                                                                                        </option>
                                                                                                                </select>
                                                </td>
                                                <td>
                                                    <select name="standard_deliverytime" id="standard_deliverytime"
                                                        required
                                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2">
                                                        <option value="">Delivery Time</option>
                                                         <option value="1">
                                                                                                                        1
                                                            Day
                                                                                                                        </option>
                                                             <option value="2">
                                                                                                                        2
                                                            Days
                                                                                                                        </option>
                                                             <option value="3">
                                                                                                                        3
                                                            Days
                                                                                                                        </option>
                                                             <option value="4">
                                                                                                                        4
                                                            Days
                                                                                                                        </option>
                                                             <option value="5">
                                                                                                                        5
                                                            Days
                                                                                                                        </option>
                                                             <option value="6">
                                                                                                                        6
                                                            Days
                                                                                                                        </option>
                                                             <option value="7">
                                                                                                                        7
                                                            Days
                                                                                                                        </option>
                                                             <option value="8">
                                                                                                                        8
                                                            Days
                                                                                                                        </option>
                                                             <option value="9">
                                                                                                                        9
                                                            Days
                                                                                                                        </option>
                                                             <option value="10">
                                                                                                                        10
                                                            Days
                                                                                                                        </option>
                                                             <option value="11">
                                                                                                                        11
                                                            Days
                                                                                                                        </option>
                                                             <option value="12">
                                                                                                                        12
                                                            Days
                                                                                                                        </option>
                                                             <option value="13">
                                                                                                                        13
                                                            Days
                                                                                                                        </option>
                                                             <option value="14">
                                                                                                                        14
                                                            Days
                                                                                                                        </option>
                                                             <option value="15">
                                                                                                                        15
                                                            Days
                                                                                                                        </option>
                                                             <option value="16">
                                                                                                                        16
                                                            Days
                                                                                                                        </option>
                                                             <option value="17">
                                                                                                                        17
                                                            Days
                                                                                                                        </option>
                                                             <option value="18">
                                                                                                                        18
                                                            Days
                                                                                                                        </option>
                                                             <option value="19">
                                                                                                                        19
                                                            Days
                                                                                                                        </option>
                                                             <option value="20">
                                                                                                                        20
                                                            Days
                                                                                                                        </option>
                                                             <option value="21">
                                                                                                                        21
                                                            Days
                                                                                                                        </option>
                                                             <option value="22">
                                                                                                                        22
                                                            Days
                                                                                                                        </option>
                                                             <option value="23">
                                                                                                                        23
                                                            Days
                                                                                                                        </option>
                                                             <option value="24">
                                                                                                                        24
                                                            Days
                                                                                                                        </option>
                                                             <option value="25">
                                                                                                                        25
                                                            Days
                                                                                                                        </option>
                                                             <option value="26">
                                                                                                                        26
                                                            Days
                                                                                                                        </option>
                                                             <option value="27">
                                                                                                                        27
                                                            Days
                                                                                                                        </option>
                                                             <option value="28">
                                                                                                                        28
                                                            Days
                                                                                                                        </option>
                                                             <option value="29">
                                                                                                                        29
                                                            Days
                                                                                                                        </option>
                                                             <option value="30">
                                                                                                                        30
                                                            Days
                                                                                                                        </option>
                                                             <option value="31">
                                                                                                                        31
                                                            Days
                                                                                                                        </option>
                                                             <option value="32">
                                                                                                                        32
                                                            Days
                                                                                                                        </option>
                                                             <option value="33">
                                                                                                                        33
                                                            Days
                                                                                                                        </option>
                                                             <option value="34">
                                                                                                                        34
                                                            Days
                                                                                                                        </option>
                                                             <option value="35">
                                                                                                                        35
                                                            Days
                                                                                                                        </option>
                                                             <option value="36">
                                                                                                                        36
                                                            Days
                                                                                                                        </option>
                                                             <option value="37">
                                                                                                                        37
                                                            Days
                                                                                                                        </option>
                                                             <option value="38">
                                                                                                                        38
                                                            Days
                                                                                                                        </option>
                                                             <option value="39">
                                                                                                                        39
                                                            Days
                                                                                                                        </option>
                                                             <option value="40">
                                                                                                                        40
                                                            Days
                                                                                                                        </option>
                                                             <option value="41">
                                                                                                                        41
                                                            Days
                                                                                                                        </option>
                                                             <option value="42">
                                                                                                                        42
                                                            Days
                                                                                                                        </option>
                                                             <option value="43">
                                                                                                                        43
                                                            Days
                                                                                                                        </option>
                                                             <option value="44">
                                                                                                                        44
                                                            Days
                                                                                                                        </option>
                                                             <option value="45">
                                                                                                                        45
                                                            Days
                                                                                                                        </option>
                                                             <option value="46">
                                                                                                                        46
                                                            Days
                                                                                                                        </option>
                                                             <option value="47">
                                                                                                                        47
                                                            Days
                                                                                                                        </option>
                                                             <option value="48">
                                                                                                                        48
                                                            Days
                                                                                                                        </option>
                                                             <option value="49">
                                                                                                                        49
                                                            Days
                                                                                                                        </option>
                                                             <option value="50">
                                                                                                                        50
                                                            Days
                                                                                                                        </option>
                                                             <option value="51">
                                                                                                                        51
                                                            Days
                                                                                                                        </option>
                                                             <option value="52">
                                                                                                                        52
                                                            Days
                                                                                                                        </option>
                                                             <option value="53">
                                                                                                                        53
                                                            Days
                                                                                                                        </option>
                                                             <option value="54">
                                                                                                                        54
                                                            Days
                                                                                                                        </option>
                                                             <option value="55">
                                                                                                                        55
                                                            Days
                                                                                                                        </option>
                                                             <option value="56">
                                                                                                                        56
                                                            Days
                                                                                                                        </option>
                                                             <option value="57">
                                                                                                                        57
                                                            Days
                                                                                                                        </option>
                                                             <option value="58">
                                                                                                                        58
                                                            Days
                                                                                                                        </option>
                                                             <option value="59">
                                                                                                                        59
                                                            Days
                                                                                                                        </option>
                                                             <option value="60">
                                                                                                                        60
                                                            Days
                                                                                                                        </option>
                                                             <option value="61">
                                                                                                                        61
                                                            Days
                                                                                                                        </option>
                                                             <option value="62">
                                                                                                                        62
                                                            Days
                                                                                                                        </option>
                                                             <option value="63">
                                                                                                                        63
                                                            Days
                                                                                                                        </option>
                                                             <option value="64">
                                                                                                                        64
                                                            Days
                                                                                                                        </option>
                                                             <option value="65">
                                                                                                                        65
                                                            Days
                                                                                                                        </option>
                                                             <option value="66">
                                                                                                                        66
                                                            Days
                                                                                                                        </option>
                                                             <option value="67">
                                                                                                                        67
                                                            Days
                                                                                                                        </option>
                                                             <option value="68">
                                                                                                                        68
                                                            Days
                                                                                                                        </option>
                                                             <option value="69">
                                                                                                                        69
                                                            Days
                                                                                                                        </option>
                                                             <option value="70">
                                                                                                                        70
                                                            Days
                                                                                                                        </option>
                                                             <option value="71">
                                                                                                                        71
                                                            Days
                                                                                                                        </option>
                                                             <option value="72">
                                                                                                                        72
                                                            Days
                                                                                                                        </option>
                                                             <option value="73">
                                                                                                                        73
                                                            Days
                                                                                                                        </option>
                                                             <option value="74">
                                                                                                                        74
                                                            Days
                                                                                                                        </option>
                                                             <option value="75">
                                                                                                                        75
                                                            Days
                                                                                                                        </option>
                                                             <option value="76">
                                                                                                                        76
                                                            Days
                                                                                                                        </option>
                                                             <option value="77">
                                                                                                                        77
                                                            Days
                                                                                                                        </option>
                                                             <option value="78">
                                                                                                                        78
                                                            Days
                                                                                                                        </option>
                                                             <option value="79">
                                                                                                                        79
                                                            Days
                                                                                                                        </option>
                                                             <option value="80">
                                                                                                                        80
                                                            Days
                                                                                                                        </option>
                                                             <option value="81">
                                                                                                                        81
                                                            Days
                                                                                                                        </option>
                                                             <option value="82">
                                                                                                                        82
                                                            Days
                                                                                                                        </option>
                                                             <option value="83">
                                                                                                                        83
                                                            Days
                                                                                                                        </option>
                                                             <option value="84">
                                                                                                                        84
                                                            Days
                                                                                                                        </option>
                                                             <option value="85">
                                                                                                                        85
                                                            Days
                                                                                                                        </option>
                                                             <option value="86">
                                                                                                                        86
                                                            Days
                                                                                                                        </option>
                                                             <option value="87">
                                                                                                                        87
                                                            Days
                                                                                                                        </option>
                                                             <option value="88">
                                                                                                                        88
                                                            Days
                                                                                                                        </option>
                                                             <option value="89">
                                                                                                                        89
                                                            Days
                                                                                                                        </option>
                                                             <option value="90">
                                                                                                                        90
                                                            Days
                                                                                                                        </option>
                                                                                                                </select>
                                                </td>
                                                <td>
                                                    <select name="premium_delieverytime" id="premium_delieverytime"
                                                        required
                                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2">
                                                        <option value="">Delivery Time</option>
                                                         <option value="1">
                                                                                                                        1
                                                            Day
                                                                                                                        </option>
                                                             <option value="2">
                                                                                                                        2
                                                            Days
                                                                                                                        </option>
                                                             <option value="3">
                                                                                                                        3
                                                            Days
                                                                                                                        </option>
                                                             <option value="4">
                                                                                                                        4
                                                            Days
                                                                                                                        </option>
                                                             <option value="5">
                                                                                                                        5
                                                            Days
                                                                                                                        </option>
                                                             <option value="6">
                                                                                                                        6
                                                            Days
                                                                                                                        </option>
                                                             <option value="7">
                                                                                                                        7
                                                            Days
                                                                                                                        </option>
                                                             <option value="8">
                                                                                                                        8
                                                            Days
                                                                                                                        </option>
                                                             <option value="9">
                                                                                                                        9
                                                            Days
                                                                                                                        </option>
                                                             <option value="10">
                                                                                                                        10
                                                            Days
                                                                                                                        </option>
                                                             <option value="11">
                                                                                                                        11
                                                            Days
                                                                                                                        </option>
                                                             <option value="12">
                                                                                                                        12
                                                            Days
                                                                                                                        </option>
                                                             <option value="13">
                                                                                                                        13
                                                            Days
                                                                                                                        </option>
                                                             <option value="14">
                                                                                                                        14
                                                            Days
                                                                                                                        </option>
                                                             <option value="15">
                                                                                                                        15
                                                            Days
                                                                                                                        </option>
                                                             <option value="16">
                                                                                                                        16
                                                            Days
                                                                                                                        </option>
                                                             <option value="17">
                                                                                                                        17
                                                            Days
                                                                                                                        </option>
                                                             <option value="18">
                                                                                                                        18
                                                            Days
                                                                                                                        </option>
                                                             <option value="19">
                                                                                                                        19
                                                            Days
                                                                                                                        </option>
                                                             <option value="20">
                                                                                                                        20
                                                            Days
                                                                                                                        </option>
                                                             <option value="21">
                                                                                                                        21
                                                            Days
                                                                                                                        </option>
                                                             <option value="22">
                                                                                                                        22
                                                            Days
                                                                                                                        </option>
                                                             <option value="23">
                                                                                                                        23
                                                            Days
                                                                                                                        </option>
                                                             <option value="24">
                                                                                                                        24
                                                            Days
                                                                                                                        </option>
                                                             <option value="25">
                                                                                                                        25
                                                            Days
                                                                                                                        </option>
                                                             <option value="26">
                                                                                                                        26
                                                            Days
                                                                                                                        </option>
                                                             <option value="27">
                                                                                                                        27
                                                            Days
                                                                                                                        </option>
                                                             <option value="28">
                                                                                                                        28
                                                            Days
                                                                                                                        </option>
                                                             <option value="29">
                                                                                                                        29
                                                            Days
                                                                                                                        </option>
                                                             <option value="30">
                                                                                                                        30
                                                            Days
                                                                                                                        </option>
                                                             <option value="31">
                                                                                                                        31
                                                            Days
                                                                                                                        </option>
                                                             <option value="32">
                                                                                                                        32
                                                            Days
                                                                                                                        </option>
                                                             <option value="33">
                                                                                                                        33
                                                            Days
                                                                                                                        </option>
                                                             <option value="34">
                                                                                                                        34
                                                            Days
                                                                                                                        </option>
                                                             <option value="35">
                                                                                                                        35
                                                            Days
                                                                                                                        </option>
                                                             <option value="36">
                                                                                                                        36
                                                            Days
                                                                                                                        </option>
                                                             <option value="37">
                                                                                                                        37
                                                            Days
                                                                                                                        </option>
                                                             <option value="38">
                                                                                                                        38
                                                            Days
                                                                                                                        </option>
                                                             <option value="39">
                                                                                                                        39
                                                            Days
                                                                                                                        </option>
                                                             <option value="40">
                                                                                                                        40
                                                            Days
                                                                                                                        </option>
                                                             <option value="41">
                                                                                                                        41
                                                            Days
                                                                                                                        </option>
                                                             <option value="42">
                                                                                                                        42
                                                            Days
                                                                                                                        </option>
                                                             <option value="43">
                                                                                                                        43
                                                            Days
                                                                                                                        </option>
                                                             <option value="44">
                                                                                                                        44
                                                            Days
                                                                                                                        </option>
                                                             <option value="45">
                                                                                                                        45
                                                            Days
                                                                                                                        </option>
                                                             <option value="46">
                                                                                                                        46
                                                            Days
                                                                                                                        </option>
                                                             <option value="47">
                                                                                                                        47
                                                            Days
                                                                                                                        </option>
                                                             <option value="48">
                                                                                                                        48
                                                            Days
                                                                                                                        </option>
                                                             <option value="49">
                                                                                                                        49
                                                            Days
                                                                                                                        </option>
                                                             <option value="50">
                                                                                                                        50
                                                            Days
                                                                                                                        </option>
                                                             <option value="51">
                                                                                                                        51
                                                            Days
                                                                                                                        </option>
                                                             <option value="52">
                                                                                                                        52
                                                            Days
                                                                                                                        </option>
                                                             <option value="53">
                                                                                                                        53
                                                            Days
                                                                                                                        </option>
                                                             <option value="54">
                                                                                                                        54
                                                            Days
                                                                                                                        </option>
                                                             <option value="55">
                                                                                                                        55
                                                            Days
                                                                                                                        </option>
                                                             <option value="56">
                                                                                                                        56
                                                            Days
                                                                                                                        </option>
                                                             <option value="57">
                                                                                                                        57
                                                            Days
                                                                                                                        </option>
                                                             <option value="58">
                                                                                                                        58
                                                            Days
                                                                                                                        </option>
                                                             <option value="59">
                                                                                                                        59
                                                            Days
                                                                                                                        </option>
                                                             <option value="60">
                                                                                                                        60
                                                            Days
                                                                                                                        </option>
                                                             <option value="61">
                                                                                                                        61
                                                            Days
                                                                                                                        </option>
                                                             <option value="62">
                                                                                                                        62
                                                            Days
                                                                                                                        </option>
                                                             <option value="63">
                                                                                                                        63
                                                            Days
                                                                                                                        </option>
                                                             <option value="64">
                                                                                                                        64
                                                            Days
                                                                                                                        </option>
                                                             <option value="65">
                                                                                                                        65
                                                            Days
                                                                                                                        </option>
                                                             <option value="66">
                                                                                                                        66
                                                            Days
                                                                                                                        </option>
                                                             <option value="67">
                                                                                                                        67
                                                            Days
                                                                                                                        </option>
                                                             <option value="68">
                                                                                                                        68
                                                            Days
                                                                                                                        </option>
                                                             <option value="69">
                                                                                                                        69
                                                            Days
                                                                                                                        </option>
                                                             <option value="70">
                                                                                                                        70
                                                            Days
                                                                                                                        </option>
                                                             <option value="71">
                                                                                                                        71
                                                            Days
                                                                                                                        </option>
                                                             <option value="72">
                                                                                                                        72
                                                            Days
                                                                                                                        </option>
                                                             <option value="73">
                                                                                                                        73
                                                            Days
                                                                                                                        </option>
                                                             <option value="74">
                                                                                                                        74
                                                            Days
                                                                                                                        </option>
                                                             <option value="75">
                                                                                                                        75
                                                            Days
                                                                                                                        </option>
                                                             <option value="76">
                                                                                                                        76
                                                            Days
                                                                                                                        </option>
                                                             <option value="77">
                                                                                                                        77
                                                            Days
                                                                                                                        </option>
                                                             <option value="78">
                                                                                                                        78
                                                            Days
                                                                                                                        </option>
                                                             <option value="79">
                                                                                                                        79
                                                            Days
                                                                                                                        </option>
                                                             <option value="80">
                                                                                                                        80
                                                            Days
                                                                                                                        </option>
                                                             <option value="81">
                                                                                                                        81
                                                            Days
                                                                                                                        </option>
                                                             <option value="82">
                                                                                                                        82
                                                            Days
                                                                                                                        </option>
                                                             <option value="83">
                                                                                                                        83
                                                            Days
                                                                                                                        </option>
                                                             <option value="84">
                                                                                                                        84
                                                            Days
                                                                                                                        </option>
                                                             <option value="85">
                                                                                                                        85
                                                            Days
                                                                                                                        </option>
                                                             <option value="86">
                                                                                                                        86
                                                            Days
                                                                                                                        </option>
                                                             <option value="87">
                                                                                                                        87
                                                            Days
                                                                                                                        </option>
                                                             <option value="88">
                                                                                                                        88
                                                            Days
                                                                                                                        </option>
                                                             <option value="89">
                                                                                                                        89
                                                            Days
                                                                                                                        </option>
                                                             <option value="90">
                                                                                                                        90
                                                            Days
                                                                                                                        </option>
                                                                                                                </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h3 class="text-black fs-14">Revisions</h3>
                                                </td>
                                                <td>
                                                    <select name="basic_revisions" id="basic_revisions" required
                                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2">
                                                        <option value="">--Select--</option>
                                                         <option value="1">1
                                                            </option>
                                                             <option value="2">2
                                                            </option>
                                                             <option value="3">3
                                                            </option>
                                                             <option value="4">4
                                                            </option>
                                                             <option value="5">5
                                                            </option>
                                                             <option value="6">6
                                                            </option>
                                                             <option value="7">7
                                                            </option>
                                                             <option value="8">8
                                                            </option>
                                                             <option value="9">9
                                                            </option>
                                                             <option value="10">10
                                                            </option>
                                                             <option value="11">11
                                                            </option>
                                                             <option value="12">12
                                                            </option>
                                                             <option value="13">13
                                                            </option>
                                                             <option value="14">14
                                                            </option>
                                                             <option value="15">15
                                                            </option>
                                                             <option value="16">16
                                                            </option>
                                                             <option value="17">17
                                                            </option>
                                                             <option value="18">18
                                                            </option>
                                                             <option value="19">19
                                                            </option>
                                                             <option value="20">20
                                                            </option>
                                                             <option value="21">21
                                                            </option>
                                                             <option value="22">22
                                                            </option>
                                                             <option value="23">23
                                                            </option>
                                                             <option value="24">24
                                                            </option>
                                                             <option value="25">25
                                                            </option>
                                                             <option value="26">26
                                                            </option>
                                                             <option value="27">27
                                                            </option>
                                                             <option value="28">28
                                                            </option>
                                                             <option value="29">29
                                                            </option>
                                                             <option value="30">30
                                                            </option>
                                                             <option value="31">31
                                                            </option>
                                                             <option value="32">32
                                                            </option>
                                                             <option value="33">33
                                                            </option>
                                                             <option value="34">34
                                                            </option>
                                                             <option value="35">35
                                                            </option>
                                                             <option value="36">36
                                                            </option>
                                                             <option value="37">37
                                                            </option>
                                                             <option value="38">38
                                                            </option>
                                                             <option value="39">39
                                                            </option>
                                                             <option value="40">40
                                                            </option>
                                                             <option value="41">41
                                                            </option>
                                                             <option value="42">42
                                                            </option>
                                                             <option value="43">43
                                                            </option>
                                                             <option value="44">44
                                                            </option>
                                                             <option value="45">45
                                                            </option>
                                                             <option value="46">46
                                                            </option>
                                                             <option value="47">47
                                                            </option>
                                                             <option value="48">48
                                                            </option>
                                                             <option value="49">49
                                                            </option>
                                                             <option value="50">50
                                                            </option>
                                                                                                                </select>
                                                </td>
                                                <td>
                                                    <select name="standard_revisions" id="standard_revisions" required
                                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2">
                                                        <option value="">--Select--</option>
                                                         <option value="1">1
                                                            </option>
                                                             <option value="2">2
                                                            </option>
                                                             <option value="3">3
                                                            </option>
                                                             <option value="4">4
                                                            </option>
                                                             <option value="5">5
                                                            </option>
                                                             <option value="6">6
                                                            </option>
                                                             <option value="7">7
                                                            </option>
                                                             <option value="8">8
                                                            </option>
                                                             <option value="9">9
                                                            </option>
                                                             <option value="10">10
                                                            </option>
                                                             <option value="11">11
                                                            </option>
                                                             <option value="12">12
                                                            </option>
                                                             <option value="13">13
                                                            </option>
                                                             <option value="14">14
                                                            </option>
                                                             <option value="15">15
                                                            </option>
                                                             <option value="16">16
                                                            </option>
                                                             <option value="17">17
                                                            </option>
                                                             <option value="18">18
                                                            </option>
                                                             <option value="19">19
                                                            </option>
                                                             <option value="20">20
                                                            </option>
                                                             <option value="21">21
                                                            </option>
                                                             <option value="22">22
                                                            </option>
                                                             <option value="23">23
                                                            </option>
                                                             <option value="24">24
                                                            </option>
                                                             <option value="25">25
                                                            </option>
                                                             <option value="26">26
                                                            </option>
                                                             <option value="27">27
                                                            </option>
                                                             <option value="28">28
                                                            </option>
                                                             <option value="29">29
                                                            </option>
                                                             <option value="30">30
                                                            </option>
                                                             <option value="31">31
                                                            </option>
                                                             <option value="32">32
                                                            </option>
                                                             <option value="33">33
                                                            </option>
                                                             <option value="34">34
                                                            </option>
                                                             <option value="35">35
                                                            </option>
                                                             <option value="36">36
                                                            </option>
                                                             <option value="37">37
                                                            </option>
                                                             <option value="38">38
                                                            </option>
                                                             <option value="39">39
                                                            </option>
                                                             <option value="40">40
                                                            </option>
                                                             <option value="41">41
                                                            </option>
                                                             <option value="42">42
                                                            </option>
                                                             <option value="43">43
                                                            </option>
                                                             <option value="44">44
                                                            </option>
                                                             <option value="45">45
                                                            </option>
                                                             <option value="46">46
                                                            </option>
                                                             <option value="47">47
                                                            </option>
                                                             <option value="48">48
                                                            </option>
                                                             <option value="49">49
                                                            </option>
                                                             <option value="50">50
                                                            </option>
                                                                                                                </select>
                                                </td>
                                                <td>
                                                    <select name="premium_revisions" id="premium_revisions" required
                                                        class="bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2">
                                                        <option value="">--Select--</option>
                                                         <option value="1">1
                                                            </option>
                                                             <option value="2">2
                                                            </option>
                                                             <option value="3">3
                                                            </option>
                                                             <option value="4">4
                                                            </option>
                                                             <option value="5">5
                                                            </option>
                                                             <option value="6">6
                                                            </option>
                                                             <option value="7">7
                                                            </option>
                                                             <option value="8">8
                                                            </option>
                                                             <option value="9">9
                                                            </option>
                                                             <option value="10">10
                                                            </option>
                                                             <option value="11">11
                                                            </option>
                                                             <option value="12">12
                                                            </option>
                                                             <option value="13">13
                                                            </option>
                                                             <option value="14">14
                                                            </option>
                                                             <option value="15">15
                                                            </option>
                                                             <option value="16">16
                                                            </option>
                                                             <option value="17">17
                                                            </option>
                                                             <option value="18">18
                                                            </option>
                                                             <option value="19">19
                                                            </option>
                                                             <option value="20">20
                                                            </option>
                                                             <option value="21">21
                                                            </option>
                                                             <option value="22">22
                                                            </option>
                                                             <option value="23">23
                                                            </option>
                                                             <option value="24">24
                                                            </option>
                                                             <option value="25">25
                                                            </option>
                                                             <option value="26">26
                                                            </option>
                                                             <option value="27">27
                                                            </option>
                                                             <option value="28">28
                                                            </option>
                                                             <option value="29">29
                                                            </option>
                                                             <option value="30">30
                                                            </option>
                                                             <option value="31">31
                                                            </option>
                                                             <option value="32">32
                                                            </option>
                                                             <option value="33">33
                                                            </option>
                                                             <option value="34">34
                                                            </option>
                                                             <option value="35">35
                                                            </option>
                                                             <option value="36">36
                                                            </option>
                                                             <option value="37">37
                                                            </option>
                                                             <option value="38">38
                                                            </option>
                                                             <option value="39">39
                                                            </option>
                                                             <option value="40">40
                                                            </option>
                                                             <option value="41">41
                                                            </option>
                                                             <option value="42">42
                                                            </option>
                                                             <option value="43">43
                                                            </option>
                                                             <option value="44">44
                                                            </option>
                                                             <option value="45">45
                                                            </option>
                                                             <option value="46">46
                                                            </option>
                                                             <option value="47">47
                                                            </option>
                                                             <option value="48">48
                                                            </option>
                                                             <option value="49">49
                                                            </option>
                                                             <option value="50">50
                                                            </option>
                                                                                                                </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h3 class="text-black fs-14">Double-Sided</h3>
                                                </td>
                                                <td>
                                                    <input class="form-check-input" type="checkbox" name="basicdouble"
                                                        required value="basicdouble" id="basicdouble">
                                                </td>
                                                <td>
                                                    <input class="form-check-input" type="checkbox"
                                                        name="standarddouble" value="standarddouble" required
                                                        id="standarddouble">
                                                </td>
                                                <td>
                                                    <input class="form-check-input" type="checkbox" name="premiumdouble"
                                                        required value="premiumdouble" id="premiumdouble">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h3 class="text-black fs-14">High Resolution</h3>
                                                </td>
                                                <td>
                                                    <input class="form-check-input" type="checkbox" name="basichigh"
                                                        required value="basichigh" id="basichigh">
                                                </td>
                                                <td>
                                                    <input class="form-check-input" type="checkbox" name="standardhigh"
                                                        required value="standardhigh" id="standardhigh">
                                                </td>
                                                <td>
                                                    <input class="form-check-input" type="checkbox" name="premiumhigh"
                                                        required value="premiumhigh" id="premiumhigh">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h3 class="text-black fs-14">Price</h3>
                                                </td>
                                                <td>
                                                    <input type="text" placeholder="Type here....." id="basic_price"
                                                        name="basic_price" required
                                                        class="numberonly bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2" />
                                                </td>
                                                <td>
                                                    <input type="text" placeholder="Type here....." id="standard_price"
                                                        name="standard_price" required
                                                        class="numberonly bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2" />
                                                </td>
                                                <td>
                                                    <input type="text" placeholder="Type here....." id="premium_price"
                                                        name="premium_price" required
                                                        class="numberonly bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2" />
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" name="create_gig_step1"
                                        class="formstep1 viewmore-btn border-0"> Submit</button>
                                </div>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include $path . '/work/ui/layouts/footer.php';
?>
<script>
function getsubcategory(_this) {
    var vl = _this.value;
    if (vl != "") {
        $.ajax({
            type: "post",
            dataType: "json",
            async: false,
            url: "http://itsugestion.com/dev/workhouse/getsubcat",
            data: {
                "_token": "I9Y0GWpiU9y6LB8j48wxwFKDZeO5041uwSxyYByW",
                "id": vl
            },
            success: function(response) {
                $('.addsubcat').html(response);
            }
        });
    }
}
$(document).ready(function() {

    $('.numberonly').keypress(function(e) {

        var charCode = (e.which) ? e.which : event.keyCode

        if (String.fromCharCode(charCode).match(/[^0-9]/g))

            return false;

    });

});

function formstep1() {
    var gigtitle = $('#gigtitle').val();
    var category = $('#category').val();
    var subcategory = $('#subcategory').val();
    var basicpackage = $('#basicpackage').val();
    var standardpackage = $('#standardpackage').val();
    var premiumpackage = $('#premiumpackage').val();
    var basicdescribe = $('#basicdescribe').val();
    var standardescribe = $('#standardescribe').val();
    var premiumdescribe = $('#premiumdescribe').val();
    var basic_delieverytime = $('#basic_delieverytime').val();
    var standard_deliverytime = $('#standard_deliverytime').val();
    var premium_delieverytime = $('#premium_delieverytime').val();
    var basic_revisions = $('#basic_revisions').val();
    var standard_revisions = $('#standard_revisions').val();
    var premium_revisions = $('#premium_revisions').val();

    var basicdouble = $('#basicdouble').val();
    var standarddouble = $('#standarddouble').val();
    var premiumdouble = $('#premiumdouble').val();
    var basichigh = $('#basichigh').val();
    var standardhigh = $('#standardhigh').val();
    var premiumhigh = $('#premiumhigh').val();

    var basic_price = $('#basic_price').val();
    var standard_price = $('#standard_price').val();
    var premium_price = $('#premium_price').val();
    if (gigtitle != "" && category != "" && subcategory != "" && standardpackage != "" && premiumpackage != "" &&
        basicdescribe != "" && standardescribe != "" && premiumdescribe != "" && basic_delieverytime != "" &&
        standard_deliverytime != "" && premium_delieverytime != "" && basic_revisions != "" && standard_revisions !=
        "" && premium_revisions != "" && basicdouble != "" && standarddouble != "" && premiumdouble != "" &&
        basichigh != "" && standardhigh != "" && premiumhigh != "" && basic_price != "" && standard_price != "" &&
        premium_price != ""
    ) {
        $('.formstep1').attr('type', 'button');
        $('.step2').css('display', 'block');
        $('.step1').css('display', 'none');
    }


}
var appendfaq = $('.appendfaq');
var addfaq = $('.addfaq');
var i = 2;
$(addfaq).click(function() {
    if (i <= 100) {
        i++;
        var html =
            ' <div class="rem_' + i +
            '"><li> <input type="text" placeholder="Type questions here....." class="question_' + i +
            ' bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2 mb-2 q_' +
            i +
            '" name="question[]" /> <textarea name="ans[]" id="" cols="30" rows="4" placeholder="Type answers here....." class="ans_' +
            i +
            ' bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2"></textarea> </li> <div class=""><button type="button" class="btn btn-danger" onclick="return removediv(' +
            i + ')">Remove</button></div></div>';
        $(appendfaq).append(html);
    }
});

function removediv(id) {
    $('.rem_' + id).remove();
}

function formstep2() {
    var step2_description = $('#step2_description').val();
    var question_1 = $('.question_1').val();
    var requirement = $('.requirement').val();
    var ans_1 = $('.ans_1').val();
    if (step2_description != "" && question_1 != "" && ans_1 != "" && requirement != "") {
        $('.formstep2').attr('type', 'button');
        $('.step2').css('display', 'none');
        $('.step3').css('display', 'block');
    }
}
var ix = 1;
var ii = 1;
var addimages = $('.addimages');
var addmoreimage = $('.addmoreimage');
$(addimages).click(function() {
    if (ii < 5) {
        ii++;

        var html =
            '<div class="col remoimage_' + ii +
            '"> <div class="d-grid-center p-3 rounded-3 shadow bg-white rel overflow-hidden"> <div class="text-center d-flex flex-column"> <i class="fal fa-image fs-40 text-secondary"></i> <h6 class="fs-14 text-secondary fw-400 ">Drag a photo or <span class="mytext-primary">Browse</span></h6> </div> <input type="file" required name="image[]" id="" class="file-upload images"> </div> <button type="button" class="mt-4 btn btn-danger" onclick="return removeimage(' +
            ii + ')">Remove</button></div>';
        $(addmoreimage).append(html);
    }
});

function removeimage(id) {
    $('.remoimage_' + id).remove();
}
var addvideos = $('.addvideos');
var addmorevideo = $('.addmorevideo');
$(addvideos).click(function() {
    if (ix < 5) {
        ix++;

        var html =
            '<div class="col remvideo_' + ix +
            '"> <div class="d-grid-center p-3 rounded-3 shadow bg-white rel overflow-hidden"> <div class="text-center d-flex flex-column"> <i class="fal fa-image fs-40 text-secondary"></i> <h6 class="fs-14 text-secondary fw-400 ">Drag a video or <span class="mytext-primary">Browse</span></h6> </div> <input type="file" name="file[]" id="" class="file-upload"> </div> <button type="button" class="mt-4 btn btn-danger" onclick="return removevideo(' +
            ix + ')">Remove</button> </div>';
        $(addmorevideo).append(html);
    }
});

function removevideo(id) {
    $('.remvideo_' + id).remove();
}
</script>
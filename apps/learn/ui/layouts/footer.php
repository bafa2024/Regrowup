





<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Support</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="javascript:void(0)">
                    <input type="hidden" name="_token" value="txxKPEpx1cgnpT1yGU7r4sEBJ7LOmzmFCuEajf7C">                    <div class="row gy-3">
                        <div class="col-12">
                            <div class="d-flex flex-column gap-2">
                                <h6 class="text-black fs-14">Name</h6>
                                <input type="text" name="name" required="" placeholder="Enter Name"
                                    class="name bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex flex-column gap-2">
                                <h6 class="text-black fs-14">Email</h6>
                                <input type="email" name="email" required="" placeholder="Enter Email"
                                    class="email bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-column gap-2">
                                <h6 class="text-black fs-14">Subject</h6>
                                <input type="text" name="subject" required="" placeholder="Enter Subject"
                                    class="subject bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-column gap-2">
                                <label for="" class="mytext-black fs-14 text-uppercase">Complaint Description</label>
                                <textarea name="complaint" required="" cols="20" rows="3" placeholder="Enter Complaint"
                                    class="complaint bg-white w-100 border border-seacondary border-opcity-25 p-2 fs-14 rounded-2"></textarea>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex justify-content-end">
                                <button type="submit" id="supportsbm" class="sendmail viewmore-btn border-0 fs-16 px-15"
                                    onclick="return sendmail()">
                                    Submit</button>
                            </div>
                        </div>

                    </div>

                </form>

            </div>
    
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>


</body>

</html>
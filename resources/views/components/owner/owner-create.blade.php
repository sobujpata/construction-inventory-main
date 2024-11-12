<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create owner</h5>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label mt-2">Name</label>
                                <input type="text" class="form-control" id="ownerName" placeholder="Owner name">

                                <label class="form-label mt-2">Email</label>
                                <input type="text" class="form-control" id="ownerEmail" placeholder="Email no">

                                <label class="form-label mt-2">Mobile No</label>
                                <input type="text" class="form-control" id="ownerMobile" placeholder="Mobile No">

                                <label class="form-label mt-2">Address</label>
                                <input type="text" class="form-control" id="ownerAddress" placeholder="Owner Address">

                                <br/>
                                <img class="w-15" id="newImg" src="{{asset('images/default.jpg')}}"/>
                                <br/>

                                <label class="form-label">Image</label>
                                <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="ownerImage">

                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn bg-gradient-primary mx-2" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="Save()" id="save-btn" class="btn bg-gradient-success" >Save</button>
                </div>
            </div>
    </div>
</div>


<script>

    async function Save() {

        let ownerName=document.getElementById('ownerName').value;
        let ownerEmail = document.getElementById('ownerEmail').value;
        let ownerMobile = document.getElementById('ownerMobile').value;
        let ownerAddress = document.getElementById('ownerAddress').value;
        let ownerImage = document.getElementById('ownerImage').files[0];

        if (ownerName.length === 0) {
            errorToast("Product Category Required !")
        }
        
        else if(ownerEmail.length===0){
            errorToast("Product Email No Required !")
        }
        else if(ownerMobile.length===0){
            errorToast("Product Mobile No Required !")
        }
        else if(ownerAddress.length===0){
            errorToast("Product Address Required !")
        }
        else if(!ownerImage){
            errorToast("Product Image Required !")
        }

        else {

            document.getElementById('modal-close').click();

            let formData=new FormData();
            formData.append('img',ownerImage)
            formData.append('name',ownerName)
            formData.append('email',ownerEmail)
            formData.append('mobile_no',ownerMobile)
            formData.append('address',ownerAddress)

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }

            showLoader();
            let res = await axios.post("/owner-create",formData,config)
            hideLoader();

            if(res.status===201){
                successToast('Request completed');
                document.getElementById("save-form").reset();
                await getList();
            }
            else{
                errorToast("Request fail !")
            }
        }
    }
</script>

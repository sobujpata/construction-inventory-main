<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update owner</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label mt-2">Name</label>
                                <input type="text" class="form-control" id="ownerNameUpdate" placeholder="owner name">

                                <label class="form-label mt-2">Email</label>
                                <input type="text" class="form-control" id="ownerEmailUpdate" placeholder="Email Address">

                                <label class="form-label mt-2">Mobile No</label>
                                <input type="text" class="form-control" id="ownerMobileUpdate" placeholder="Mobile No">

                                <label class="form-label mt-2">Address</label>
                                <input type="text" class="form-control" id="ownerAddressUpdate" placeholder="owner Address">
                                <br/>
                                <img class="w-15" id="oldImg" src="{{asset('images/default.jpg')}}"/>
                                <br/>
                                <label class="form-label mt-2">Image</label>
                                <input oninput="oldImg.src=window.URL.createObjectURL(this.files[0])"  type="file" class="form-control" id="ownerImgUpdate">

                                <input type="text" class="d-none" id="updateID">
                                <input type="text" class="d-none" id="filePath">


                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button id="update-modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="update()" id="update-btn" class="btn bg-gradient-success" >Update</button>
            </div>

        </div>
    </div>
</div>


<script>
    async function FillUpUpdateForm(id,filePath){

        document.getElementById('updateID').value=id;
        document.getElementById('filePath').value=filePath;
        document.getElementById('oldImg').src=filePath;


        showLoader();
        let res=await axios.post("/owner-by-id",{id:id})
        hideLoader();

        document.getElementById('ownerNameUpdate').value=res.data['name'];
        document.getElementById('ownerEmailUpdate').value=res.data['email'];
        document.getElementById('ownerMobileUpdate').value=res.data['mobile'];
        document.getElementById('ownerAddressUpdate').value=res.data['address'];

    }



    async function update() {

        let ownerNameUpdate=document.getElementById('ownerNameUpdate').value;
        let ownerEmailUpdate = document.getElementById('ownerEmailUpdate').value;
        let ownerMobileUpdate = document.getElementById('ownerMobileUpdate').value;
        let ownerAddressUpdate = document.getElementById('ownerAddressUpdate').value;
        let updateID=document.getElementById('updateID').value;
        let filePath=document.getElementById('filePath').value;
        let ownerImgUpdate = document.getElementById('ownerImgUpdate').files[0];


        if (ownerNameUpdate.length === 0) {
            errorToast("Product Name Required !")
        }

        else if(ownerEmailUpdate.length===0){
            errorToast("Product Email No Required !")
        }
        else if(ownerMobileUpdate.length===0){
            errorToast("Product Mobile No Required !")
        }

        else {

            document.getElementById('update-modal-close').click();

            let formData=new FormData();
            formData.append('img',ownerImgUpdate)
            formData.append('id',updateID)
            formData.append('name',ownerNameUpdate)
            formData.append('email',ownerEmailUpdate)
            formData.append('mobile_no',ownerMobileUpdate)
            formData.append('address',ownerAddressUpdate)
            formData.append('file_path',filePath)

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }

            showLoader();
            let res = await axios.post("/owners-update",formData,config)
            hideLoader();

            if(res.status===200 && res.data===1){
                successToast('Request completed');
                document.getElementById("update-form").reset();
                await getList();
            }
            else{
                errorToast("Request fail !")
            }
        }
    }
</script>

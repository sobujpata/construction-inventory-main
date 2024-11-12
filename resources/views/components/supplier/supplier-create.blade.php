<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Supplier</h5>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label mt-2">Name</label>
                                <input type="text" class="form-control" id="supplierName" placeholder="supplier name">

                                <label class="form-label mt-2">Company Name</label>
                                <input type="text" class="form-control" id="supplierCompanyName" placeholder="Company Name">

                                <label class="form-label mt-2">NID No</label>
                                <input type="text" class="form-control" id="supplierNid" placeholder="Nid no">

                                <label class="form-label mt-2">Mobile No</label>
                                <input type="text" class="form-control" id="supplierMobile" placeholder="Mobile No">

                                <label class="form-label mt-2">Address</label>
                                <input type="text" class="form-control" id="supplierAddress" placeholder="supplier Address">

                                <br/>
                                <img class="w-15" id="newImg" src="{{asset('images/default.jpg')}}"/>
                                <br/>

                                <label class="form-label">Image</label>
                                <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="supplierImage">

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

        let supplierName=document.getElementById('supplierName').value;
        let supplierCompanyName = document.getElementById('supplierCompanyName').value;
        let supplierNid = document.getElementById('supplierNid').value;
        let supplierMobile = document.getElementById('supplierMobile').value;
        let supplierAddress = document.getElementById('supplierAddress').value;
        let supplierImage = document.getElementById('supplierImage').files[0];

        if (supplierName.length === 0) {
            errorToast("Product Category Required !")
        }
        else if(supplierCompanyName.length===0){
            errorToast("Product Detailed For Required !")
        }
        else if(supplierNid.length===0){
            errorToast("Product Nid No Required !")
        }
        else if(supplierMobile.length===0){
            errorToast("Product Mobile No Required !")
        }
        else if(supplierAddress.length===0){
            errorToast("Product Address Required !")
        }
        else if(!supplierImage){
            errorToast("Product Image Required !")
        }

        else {

            document.getElementById('modal-close').click();

            let formData=new FormData();
            formData.append('img',supplierImage)
            formData.append('name',supplierName)
            formData.append('company_name',supplierCompanyName)
            formData.append('nid_no',supplierNid)
            formData.append('mobile_no',supplierMobile)
            formData.append('address',supplierAddress)

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }

            showLoader();
            let res = await axios.post("/supplier-create",formData,config)
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

<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Supplier</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label mt-2">Name</label>
                                <input type="text" class="form-control" id="supplierNameUpdate" placeholder="Supplier name">

                                <label class="form-label mt-2">Company Name</label>
                                <input type="text" class="form-control" id="supplierCompanyNameUpdate" placeholder="Company Name">

                                <label class="form-label mt-2">NID No</label>
                                <input type="text" class="form-control" id="supplierNidUpdate" placeholder="Nid no">

                                <label class="form-label mt-2">Mobile No</label>
                                <input type="text" class="form-control" id="supplierMobileUpdate" placeholder="Mobile No">

                                <label class="form-label mt-2">Address</label>
                                <input type="text" class="form-control" id="supplierAddressUpdate" placeholder="supplier Address">
                                <br/>
                                <img class="w-15" id="oldImg" src="{{asset('images/default.jpg')}}"/>
                                <br/>
                                <label class="form-label mt-2">Image</label>
                                <input oninput="oldImg.src=window.URL.createObjectURL(this.files[0])"  type="file" class="form-control" id="supplierImgUpdate">

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
        let res=await axios.post("/supplier-by-id",{id:id})
        hideLoader();

        document.getElementById('supplierNameUpdate').value=res.data['name'];
        document.getElementById('supplierCompanyNameUpdate').value=res.data['company_name'];
        document.getElementById('supplierNidUpdate').value=res.data['nid_no'];
        document.getElementById('supplierMobileUpdate').value=res.data['mobile'];
        document.getElementById('supplierAddressUpdate').value=res.data['address'];

    }



    async function update() {

        let supplierNameUpdate=document.getElementById('supplierNameUpdate').value;
        let supplierCompanyNameUpdate = document.getElementById('supplierCompanyNameUpdate').value;
        let supplierNidUpdate = document.getElementById('supplierNidUpdate').value;
        let supplierMobileUpdate = document.getElementById('supplierMobileUpdate').value;
        let supplierAddressUpdate = document.getElementById('supplierAddressUpdate').value;
        let updateID=document.getElementById('updateID').value;
        let filePath=document.getElementById('filePath').value;
        let supplierImgUpdate = document.getElementById('supplierImgUpdate').files[0];


        if (supplierNameUpdate.length === 0) {
            errorToast("Product Name Required !")
        }
        else if(supplierCompanyNameUpdate.length===0){
            errorToast("Product Detailed For Required !")
        }
        else if(supplierNidUpdate.length===0){
            errorToast("Product NID No Required !")
        }
        else if(supplierMobileUpdate.length===0){
            errorToast("Product Mobile No Required !")
        }

        else {

            document.getElementById('update-modal-close').click();

            let formData=new FormData();
            formData.append('img',supplierImgUpdate)
            formData.append('id',updateID)
            formData.append('name',supplierNameUpdate)
            formData.append('company_name',supplierCompanyNameUpdate)
            formData.append('nid_no',supplierNidUpdate)
            formData.append('mobile_no',supplierMobileUpdate)
            formData.append('address',supplierAddressUpdate)
            formData.append('file_path',filePath)

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }

            showLoader();
            let res = await axios.post("/supplier-update",formData,config)
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

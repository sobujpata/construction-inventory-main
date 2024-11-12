<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label mt-2">Name</label>
                                <input type="text" class="form-control" id="employeeNameUpdate" placeholder="Employee name">

                                <label class="form-label mt-2">Detailed For</label>
                                <input type="text" class="form-control" id="employeeDetailedForUpdate" placeholder="Details For">

                                <label class="form-label mt-2">NID No</label>
                                <input type="text" class="form-control" id="employeeNidUpdate" placeholder="Nid no">

                                <label class="form-label mt-2">Mobile No</label>
                                <input type="text" class="form-control" id="employeeMobileUpdate" placeholder="Mobile No">

                                <label class="form-label mt-2">Address</label>
                                <input type="text" class="form-control" id="employeeAddressUpdate" placeholder="Employee Address">
                                <br/>
                                <img class="w-15" id="oldImg" src="{{asset('images/default.jpg')}}"/>
                                <br/>
                                <label class="form-label mt-2">Image</label>
                                <input oninput="oldImg.src=window.URL.createObjectURL(this.files[0])"  type="file" class="form-control" id="employeeImgUpdate">

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
        let res=await axios.post("/employee-by-id",{id:id})
        hideLoader();

        document.getElementById('employeeNameUpdate').value=res.data['name'];
        document.getElementById('employeeDetailedForUpdate').value=res.data['detailed_for'];
        document.getElementById('employeeNidUpdate').value=res.data['nid_no'];
        document.getElementById('employeeMobileUpdate').value=res.data['mobile_no'];
        document.getElementById('employeeAddressUpdate').value=res.data['address'];

    }



    async function update() {

        let employeeNameUpdate=document.getElementById('employeeNameUpdate').value;
        let employeeDetailedForUpdate = document.getElementById('employeeDetailedForUpdate').value;
        let employeeNidUpdate = document.getElementById('employeeNidUpdate').value;
        let employeeMobileUpdate = document.getElementById('employeeMobileUpdate').value;
        let employeeAddressUpdate = document.getElementById('employeeAddressUpdate').value;
        let updateID=document.getElementById('updateID').value;
        let filePath=document.getElementById('filePath').value;
        let employeeImgUpdate = document.getElementById('employeeImgUpdate').files[0];


        if (employeeNameUpdate.length === 0) {
            errorToast("Product Name Required !")
        }
        else if(employeeDetailedForUpdate.length===0){
            errorToast("Product Detailed For Required !")
        }
        else if(employeeNidUpdate.length===0){
            errorToast("Product NID No Required !")
        }
        else if(employeeMobileUpdate.length===0){
            errorToast("Product Mobile No Required !")
        }

        else {

            document.getElementById('update-modal-close').click();

            let formData=new FormData();
            formData.append('img',employeeImgUpdate)
            formData.append('id',updateID)
            formData.append('name',employeeNameUpdate)
            formData.append('detailed_for',employeeDetailedForUpdate)
            formData.append('nid_no',employeeNidUpdate)
            formData.append('mobile_no',employeeMobileUpdate)
            formData.append('address',employeeAddressUpdate)
            formData.append('file_path',filePath)

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }

            showLoader();
            let res = await axios.post("/employees-update",formData,config)
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

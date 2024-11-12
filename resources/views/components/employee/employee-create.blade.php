<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Epmloyee</h5>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label mt-2">Name</label>
                                <input type="text" class="form-control" id="employeeName" placeholder="Employee name">

                                <label class="form-label mt-2">Detailed For</label>
                                <input type="text" class="form-control" id="employeeDetailedFor" placeholder="Details For">

                                <label class="form-label mt-2">NID No</label>
                                <input type="text" class="form-control" id="employeeNid" placeholder="Nid no">

                                <label class="form-label mt-2">Mobile No</label>
                                <input type="text" class="form-control" id="employeeMobile" placeholder="Mobile No">

                                <label class="form-label mt-2">Address</label>
                                <input type="text" class="form-control" id="employeeAddress" placeholder="Employee Address">

                                <br/>
                                <img class="w-15" id="newImg" src="{{asset('images/default.jpg')}}"/>
                                <br/>

                                <label class="form-label">Image</label>
                                <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="employeeImage">

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

        let employeeName=document.getElementById('employeeName').value;
        let employeeDetailedFor = document.getElementById('employeeDetailedFor').value;
        let employeeNid = document.getElementById('employeeNid').value;
        let employeeMobile = document.getElementById('employeeMobile').value;
        let employeeAddress = document.getElementById('employeeAddress').value;
        let employeeImage = document.getElementById('employeeImage').files[0];

        if (employeeName.length === 0) {
            errorToast("Product Category Required !")
        }
        else if(employeeDetailedFor.length===0){
            errorToast("Product Detailed For Required !")
        }
        else if(employeeNid.length===0){
            errorToast("Product Nid No Required !")
        }
        else if(employeeMobile.length===0){
            errorToast("Product Mobile No Required !")
        }
        else if(employeeAddress.length===0){
            errorToast("Product Address Required !")
        }
        else if(!employeeImage){
            errorToast("Product Image Required !")
        }

        else {

            document.getElementById('modal-close').click();

            let formData=new FormData();
            formData.append('img',employeeImage)
            formData.append('name',employeeName)
            formData.append('detailed_for',employeeDetailedFor)
            formData.append('nid_no',employeeNid)
            formData.append('mobile_no',employeeMobile)
            formData.append('address',employeeAddress)

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }

            showLoader();
            let res = await axios.post("/employee-create",formData,config)
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

<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Agent</h5>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label mt-2">Name</label>
                                <input type="text" class="form-control" id="agentName" placeholder="Agent name">

                                <label class="form-label mt-2">Company Name</label>
                                <input type="text" class="form-control" id="agentCompanyName" placeholder="Company Name">

                                <label class="form-label mt-2">NID No</label>
                                <input type="text" class="form-control" id="agentNid" placeholder="Nid no">

                                <label class="form-label mt-2">Mobile No</label>
                                <input type="text" class="form-control" id="agentMobile" placeholder="Mobile No">

                                <label class="form-label mt-2">Address</label>
                                <input type="text" class="form-control" id="agentAddress" placeholder="Agent Address">

                                <br/>
                                <img class="w-15" id="newImg" src="{{asset('images/default.jpg')}}"/>
                                <br/>

                                <label class="form-label">Image</label>
                                <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="agentImage">

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

        let agentName=document.getElementById('agentName').value;
        let agentCompanyName = document.getElementById('agentCompanyName').value;
        let agentNid = document.getElementById('agentNid').value;
        let agentMobile = document.getElementById('agentMobile').value;
        let agentAddress = document.getElementById('agentAddress').value;
        let agentImage = document.getElementById('agentImage').files[0];

        if (agentName.length === 0) {
            errorToast("Product Category Required !")
        }
        else if(agentCompanyName.length===0){
            errorToast("Product Detailed For Required !")
        }
        else if(agentNid.length===0){
            errorToast("Product Nid No Required !")
        }
        else if(agentMobile.length===0){
            errorToast("Product Mobile No Required !")
        }
        else if(agentAddress.length===0){
            errorToast("Product Address Required !")
        }
        else if(!agentImage){
            errorToast("Product Image Required !")
        }

        else {

            document.getElementById('modal-close').click();

            let formData=new FormData();
            formData.append('img',agentImage)
            formData.append('name',agentName)
            formData.append('company_name',agentCompanyName)
            formData.append('nid_no',agentNid)
            formData.append('mobile_no',agentMobile)
            formData.append('address',agentAddress)

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }

            showLoader();
            let res = await axios.post("/agent-create",formData,config)
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

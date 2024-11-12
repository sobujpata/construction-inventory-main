<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Agent</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label mt-2">Name</label>
                                <input type="text" class="form-control" id="agentNameUpdate" placeholder="Agent name">

                                <label class="form-label mt-2">Company Name</label>
                                <input type="text" class="form-control" id="agentCompanyNameUpdate" placeholder="Company Name">

                                <label class="form-label mt-2">NID No</label>
                                <input type="text" class="form-control" id="agentNidUpdate" placeholder="Nid no">

                                <label class="form-label mt-2">Mobile No</label>
                                <input type="text" class="form-control" id="agentMobileUpdate" placeholder="Mobile No">

                                <label class="form-label mt-2">Address</label>
                                <input type="text" class="form-control" id="agentAddressUpdate" placeholder="Agent Address">
                                <br/>
                                <img class="w-15" id="oldImg" src="{{asset('images/default.jpg')}}"/>
                                <br/>
                                <label class="form-label mt-2">Image</label>
                                <input oninput="oldImg.src=window.URL.createObjectURL(this.files[0])"  type="file" class="form-control" id="agentImgUpdate">

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
        let res=await axios.post("/agent-by-id",{id:id})
        hideLoader();

        document.getElementById('agentNameUpdate').value=res.data['name'];
        document.getElementById('agentCompanyNameUpdate').value=res.data['company_name'];
        document.getElementById('agentNidUpdate').value=res.data['nid_no'];
        document.getElementById('agentMobileUpdate').value=res.data['mobile'];
        document.getElementById('agentAddressUpdate').value=res.data['address'];

    }



    async function update() {

        let agentNameUpdate=document.getElementById('agentNameUpdate').value;
        let agentCompanyNameUpdate = document.getElementById('agentCompanyNameUpdate').value;
        let agentNidUpdate = document.getElementById('agentNidUpdate').value;
        let agentMobileUpdate = document.getElementById('agentMobileUpdate').value;
        let agentAddressUpdate = document.getElementById('agentAddressUpdate').value;
        let updateID=document.getElementById('updateID').value;
        let filePath=document.getElementById('filePath').value;
        let agentImgUpdate = document.getElementById('agentImgUpdate').files[0];


        if (agentNameUpdate.length === 0) {
            errorToast("Product Name Required !")
        }
        else if(agentCompanyNameUpdate.length===0){
            errorToast("Product Detailed For Required !")
        }
        else if(agentNidUpdate.length===0){
            errorToast("Product NID No Required !")
        }
        else if(agentMobileUpdate.length===0){
            errorToast("Product Mobile No Required !")
        }

        else {

            document.getElementById('update-modal-close').click();

            let formData=new FormData();
            formData.append('img',agentImgUpdate)
            formData.append('id',updateID)
            formData.append('name',agentNameUpdate)
            formData.append('detailed_for',agentCompanyNameUpdate)
            formData.append('nid_no',agentNidUpdate)
            formData.append('mobile_no',agentMobileUpdate)
            formData.append('address',agentAddressUpdate)
            formData.append('file_path',filePath)

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }

            showLoader();
            let res = await axios.post("/agents-update",formData,config)
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

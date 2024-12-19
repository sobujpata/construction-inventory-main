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
                                <label class="form-label mt-2">Recipient's Name</label>
                                <input type="text" class="form-control" id="recipientUpdate" placeholder="Recipient's name">

                                <label class="form-label mt-2">Expenditure Sector</label>
                                <select class="form-control form-select" name="sectorUpdate" id="sectorUpdate">
                                    <option value="">Select Sector</option>
                                    <option value="Salary">Salary</option>
                                    <option value="Stationary Item">Stationary Item</option>
                                    <option value="Remunaration of MeddleMan">Remunaration of MeddleMan</option>
                                    <option value="Other Cost">Other Cost</option>
                                </select>

                                <label class="form-label mt-2">Amount</label>
                                <input type="text" class="form-control" id="amountUpdate">

                                <label class="form-label mt-2">Remarks</label>
                                <input type="text" class="form-control" id="remarksUpdate" placeholder="Remarks">


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
        // document.getElementById('filePath').value=filePath;
        // document.getElementById('oldImg').src=filePath;


        showLoader();
        let res=await axios.post("/other-cost-by-id",{id:id})
        hideLoader();

        document.getElementById('recipientUpdate').value=res.data['recipient'];
        document.getElementById('sectorUpdate').value=res.data['sector'];
        document.getElementById('amountUpdate').value=res.data['amount'];
        document.getElementById('remarksUpdate').value=res.data['remarks'];

    }



    async function update() {

        let recipientUpdate=document.getElementById('recipientUpdate').value;
        let sectorUpdate = document.getElementById('sectorUpdate').value;
        let amountUpdate = document.getElementById('amountUpdate').value;
        let remarksUpdate = document.getElementById('remarksUpdate').value;
        let updateID=document.getElementById('updateID').value;


        if (recipientUpdate.length === 0) {
            errorToast("Recipient Required !")
        }
        else if(sectorUpdate.length===0){
            errorToast("Sector Required !")
        }
        else if(amountUpdate.length===0){
            errorToast("Amount Required !")
        }
        else if(remarksUpdate.length===0){
            errorToast("Remarks Required !")
        }
        else {
            document.getElementById('update-modal-close').click();

            let formData=new FormData();
            formData.append('id',updateID)
            formData.append('recipient',recipientUpdate)
            formData.append('sector',sectorUpdate)
            formData.append('amount',amountUpdate)
            formData.append('remarks',remarksUpdate)

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }

            showLoader();
            let res = await axios.post("/other-cost-update",formData,config)
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

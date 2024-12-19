<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Other Cost</h5>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label mt-2">Recipient Name</label>
                                <input type="text" class="form-control" id="recipientName" placeholder="Recipient name">

                                <label class="form-label mt-2">Expenditure Sector</label>
                                <select class="form-control form-select" name="sector" id="sector">
                                    <option value="">Select Sector</option>
                                    <option value="Salary">Salary</option>
                                    <option value="Stationary Item">Stationary Item</option>
                                    <option value="Remunaration of MeddleMan">Remunaration of MeddleMan</option>
                                    <option value="Other Cost">Other Cost</option>
                                </select>
                                {{-- <input type="text" class="form-control" id="sector" placeholder="Enter sector"> --}}

                                <label class="form-label mt-2">Amount</label>
                                <input type="text" class="form-control" id="amount" placeholder="Enter Amount">

                                <label class="form-label mt-2">Remarks</label>
                                <input type="text" class="form-control" id="remarks" placeholder="Remarks">

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

        let recipientName=document.getElementById('recipientName').value;
        let sector = document.getElementById('sector').value;
        let amount = document.getElementById('amount').value;
        let remarks = document.getElementById('remarks').value;


        if (recipientName.length === 0) {
            errorToast("Recipient Required !")
        }
        else if(sector.length===0){
            errorToast("Expenditure Sector Required !")
        }
        else if(amount.length===0){
            errorToast("Amount Required !")
        }
        else if(remarks.length===0){
            errorToast("Remarks Required !")
        }


        else {

            document.getElementById('modal-close').click();

            let formData=new FormData();
            formData.append('recipient',recipientName)
            formData.append('sector',sector)
            formData.append('amount',amount)
            formData.append('remarks',remarks)


            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }

            showLoader();
            let res = await axios.post("/other-cost-create",formData,config)
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

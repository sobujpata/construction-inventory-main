<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Expenditures</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Item Name</label>
                                <select type="text" class="form-control form-select" id="productCategoryUpdate">
                                    <option value="">Select Item</option>
                                </select>

                                <label class="form-label mt-2">Qty</label>
                                <input type="text" class="form-control" id="qtyUpdate">
                                <label class="form-label mt-2">Unit</label>
                                <input type="text" class="form-control" id="unitUpdate">
                                <label class="form-label mt-2">Rate</label>
                                <input type="text" class="form-control" id="rateUpdate">
                                
                                <label class="form-label mt-2">Item Cost</label>
                                <input type="text" class="form-control" id="productCostUpdate">

                                <label class="form-label mt-2">Payment</label>
                                <input type="text" class="form-control" id="paymentUpdate">

                                <label class="form-label mt-2">Due</label>
                                <input type="text" class="form-control" id="dueUpdate">


                                <br/>
                                <img class="w-15" id="oldImg" src="{{asset('images/default.jpg')}}"/>
                                <br/>
                                <label class="form-label mt-2">Invoice File Update</label>
                                <input oninput="oldImg.src=window.URL.createObjectURL(this.files[0])"  type="file" class="form-control" id="InvoiceImgUpdate">

                                <input type="text" class="d-none" id="updateID">
                                <input type="text" class="d-none" id="filePath">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button id="update-modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="update()" type="submit" id="update-btn" class="btn bg-gradient-success" >Update</button>
            </div>

        </div>
    </div>
</div>


<script>


    UpdateFillCategoryDropDown();
    async function UpdateFillCategoryDropDown(){
        let res = await axios.get("/list-category")
        res.data.forEach(function (item,i) {
            let option=`<option value="${item['id']}">${item['categoryName']}</option>`
            $("#productCategoryUpdate").append(option);
        })
    }



    async function FillUpUpdateForm(id,filePath){

        document.getElementById('updateID').value=id;
        document.getElementById('filePath').value=filePath;
        document.getElementById('oldImg').src=filePath;


        showLoader();
        // await UpdateFillCategoryDropDown();

        let res=await axios.post("/buying-details-by-id",{id:id})
        hideLoader();
        // console.log(res);

        document.getElementById('productCategoryUpdate').value=res.data['category_id'];
        document.getElementById('productCostUpdate').value=res.data['product_cost'];
        document.getElementById('qtyUpdate').value=res.data['qty'];
        document.getElementById('unitUpdate').value=res.data['unit'];
        document.getElementById('rateUpdate').value=res.data['rate'];
        document.getElementById('paymentUpdate').value=res.data['payment'];
        document.getElementById('dueUpdate').value=res.data['due'];
        }


        async function update() {
    let productCostUpdate = document.getElementById('productCostUpdate').value;
    
    let qtyUpdate = document.getElementById('qtyUpdate').value;
    let unitUpdate = document.getElementById('unitUpdate').value;
    let rateUpdate = document.getElementById('rateUpdate').value;
    let paymentUpdate = document.getElementById('paymentUpdate').value;
    let dueUpdate = document.getElementById('dueUpdate').value;

    let productCategoryUpdate = document.getElementById('productCategoryUpdate').value;
    let updateID = document.getElementById('updateID').value;
    let filePath = document.getElementById('filePath').value;
    let InvoiceImgUpdate = document.getElementById('InvoiceImgUpdate').files[0];

    // Debug logs
    // console.log("Category ID:", productCategoryUpdate);
    // console.log("Product Cost:", productCostUpdate);
    console.log("qty Cost:", qtyUpdate);

    // Validation
    if (productCategoryUpdate.length === 0) {
        errorToast("Product Category Required !");
        return;
    } else if (productCostUpdate.length === 0) {
        errorToast("Product Cost Required !");
        return;
    }
    // else if (carringCostUpdate.length === 0) {
    //     errorToast("Carring Cost Required !");
    //     return;
    // }
    else {
        document.getElementById('update-modal-close').click(); // Close modal if form is valid

        let formData = new FormData();
        formData.append('category_id', parseInt(productCategoryUpdate));
        formData.append('product_cost', productCostUpdate);
        formData.append('qty', qtyUpdate);
        formData.append('unit', unitUpdate);
        formData.append('rate', rateUpdate);
        formData.append('payment', paymentUpdate);
        formData.append('due', dueUpdate);

        if (InvoiceImgUpdate) {
            formData.append('invoice_url', InvoiceImgUpdate);
        }

        formData.append('id', updateID);
        formData.append('file_path', filePath);

        // Log FormData content for debugging
        for (let pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }

        const config = {
            headers: {
                'content-type': 'multipart/form-data'
            }
        };

        try {
            showLoader();
            let res = await axios.post(`/buying-details-update/${updateID}`, formData, config);
            hideLoader();

            if (res.status === 200) {
                successToast('Request completed');
                document.getElementById("update-form").reset();
                await getList();
            } else {
                errorToast("Request failed!");
            }
        } catch (error) {
            hideLoader();
            if (error.response) {
                console.error("Validation errors:", error.response.data.errors);
                console.error("Full Response:", error.response.data); // Log full response for more details
                if (error.response.status === 422) {
                    let validationErrors = error.response.data.errors;
                    for (const key in validationErrors) {
                        if (validationErrors.hasOwnProperty(key)) {
                            errorToast(validationErrors[key][0]);
                        }
                    }
                } else {
                    errorToast("An error occurred while processing the request.");
                }
            }
        }
    }
}



</script>

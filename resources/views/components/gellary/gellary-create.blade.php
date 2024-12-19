<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Gellary</h5>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">

                                <label class="form-label mt-2">Title</label>
                                <input type="text" class="form-control" id="gellaryTitle" placeholder="Title">

                                <label class="form-label mt-2">Short Discription</label>
                                <input type="text" class="form-control" id="gellarShortDiscription" placeholder="Short Discription">


                                <br/>
                                <img class="w-15" id="newImg" src="{{asset('images/default.jpg')}}"/>
                                <br/>

                                <label class="form-label">Image</label>
                                <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="gellaryImage">

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

        let gellaryTitle=document.getElementById('gellaryTitle').value;
        let gellarShortDiscription = document.getElementById('gellarShortDiscription').value;

        let gellaryImage = document.getElementById('gellaryImage').files[0];

        if (gellaryTitle.length === 0) {
            errorToast("Product Category Required !")
        }
        else if(gellarShortDiscription.length===0){
            errorToast("Product Detailed For Required !")
        }

        else if(!gellaryImage){
            errorToast("Product Image Required !")
        }

        else {

            document.getElementById('modal-close').click();

            let formData=new FormData();
            formData.append('img',gellaryImage)
            formData.append('title',gellaryTitle)
            formData.append('short_discription',gellarShortDiscription)
            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }

            showLoader();
            let res = await axios.post("/gellary-create",formData,config)
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

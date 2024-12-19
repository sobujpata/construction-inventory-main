<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update gellary</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label mt-2">Title</label>
                                <input type="text" class="form-control" id="gellaryTitleUpdate" placeholder="Enter Title">

                                <label class="form-label mt-2">Short Discription</label>
                                <input type="text" class="form-control" id="gellaryShortDiscriptionUpdate" placeholder="Short Discription">


                                <br/>
                                <img class="w-15" id="oldImg" src="{{asset('images/default.jpg')}}"/>
                                <br/>
                                <label class="form-label mt-2">Image</label>
                                <input oninput="oldImg.src=window.URL.createObjectURL(this.files[0])"  type="file" class="form-control" id="gellaryImgUpdate">

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
        let res=await axios.post("/gellary-by-id",{id:id})
        hideLoader();

        document.getElementById('gellaryTitleUpdate').value=res.data['title'];
        document.getElementById('gellaryShortDiscriptionUpdate').value=res.data['short_discription'];


    }



    async function update() {

        let gellaryTitleUpdate=document.getElementById('gellaryTitleUpdate').value;
        let gellaryShortDiscriptionUpdate = document.getElementById('gellaryShortDiscriptionUpdate').value;

        let updateID=document.getElementById('updateID').value;
        let filePath=document.getElementById('filePath').value;
        let gellaryImgUpdate = document.getElementById('gellaryImgUpdate').files[0];


        if (gellaryTitleUpdate.length === 0) {
            errorToast("Product Name Required !")
        }
        else if(gellaryShortDiscriptionUpdate.length===0){
            errorToast("Product Detailed For Required !")
        }


        else {

            document.getElementById('update-modal-close').click();

            let formData=new FormData();
            formData.append('img',gellaryImgUpdate)
            formData.append('id',updateID)
            formData.append('title',gellaryTitleUpdate)
            formData.append('short_discription',gellaryShortDiscriptionUpdate)

            formData.append('file_path',filePath)

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }

            showLoader();
            let res = await axios.post("/gellary-update",formData,config)
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

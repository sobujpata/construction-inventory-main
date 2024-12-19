<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update building</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label mt-2">Name</label>
                                <input type="text" class="form-control" id="buildingNameUpdate" placeholder="Building name">

                                <label class="form-label mt-2">Title</label>
                                <input type="text" class="form-control" id="buildingTitleUpdate" placeholder="Title no">

                                <label class="form-label mt-2">Distription</label>
                                <input type="text" class="form-control" id="discriptionUpdate" placeholder="Distription No">

                                <label class="form-label mt-2">Location</label>
                                <input type="text" class="form-control" id="locationUpdate" placeholder="Location">

                                <label class="form-label mt-2">Total Land</label>
                                <input type="text" class="form-control" id="totalLandUpdate" placeholder="totalLand">

                                <label class="form-label mt-2">No of Storied</label>
                                <input type="text" class="form-control" id="noOstoriedUpdate" placeholder="noOstoried">

                                <label class="form-label mt-2">Total Tower</label>
                                <input type="text" class="form-control" id="totalTowerUpdate" placeholder="Total Tower">

                                <label class="form-label mt-2">Map Location</label>
                                <input type="text" class="form-control" id="mapLocationUpdate" placeholder="Map Location">
                                <br/>
                                <img class="w-15" id="oldImg" src="{{asset('images/default.jpg')}}"/>
                                <br/>
                                <label class="form-label mt-2">Image</label>
                                <input oninput="oldImg.src=window.URL.createObjectURL(this.files[0])"  type="file" class="form-control" id="buildingImgUpdate">

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
        let res=await axios.post("/building-detail-by-id",{id:id})
        hideLoader();

        document.getElementById('buildingNameUpdate').value=res.data['name'];
        document.getElementById('discriptionUpdate').value=res.data['discription'];
        document.getElementById('buildingTitleUpdate').value=res.data['title'];
        document.getElementById('locationUpdate').value=res.data['location'];
        document.getElementById('totalLandUpdate').value=res.data['total_land'];
        document.getElementById('noOstoriedUpdate').value=res.data['no_of_storied'];
        document.getElementById('totalTowerUpdate').value=res.data['total_owner'];
        document.getElementById('mapLocationUpdate').value=res.data['map_location'];

    }



    async function update() {

        let buildingNameUpdate=document.getElementById('buildingNameUpdate').value;
        let discriptionUpdate = document.getElementById('discriptionUpdate').value;
        let buildingTitleUpdate = document.getElementById('buildingTitleUpdate').value;
        let locationUpdate = document.getElementById('locationUpdate').value;
        let totalLandUpdate = document.getElementById('totalLandUpdate').value;
        let noOstoriedUpdate = document.getElementById('noOstoriedUpdate').value;
        let totalTowerUpdate = document.getElementById('totalTowerUpdate').value;
        let mapLocationUpdate = document.getElementById('mapLocationUpdate').value;
        let updateID=document.getElementById('updateID').value;
        let filePath=document.getElementById('filePath').value;
        let buildingImgUpdate = document.getElementById('buildingImgUpdate').files[0];


        if (buildingNameUpdate.length === 0) {
            errorToast("Product Name Required !")
        }

        else if(discriptionUpdate.length===0){
            errorToast("Product discription Required !")
        }
        else if(buildingTitleUpdate.length===0){
            errorToast("Product Title Required !")
        }
        else if(locationUpdate.length===0){
            errorToast("Product Location Required !")
        }
        else if(totalLandUpdate.length===0){
            errorToast("Product total land Required !")
        }
        else if(noOstoriedUpdate.length===0){
            errorToast("Product storied Required !")
        }
        else if(totalTowerUpdate.length===0){
            errorToast("Product Tower Required !")
        }
        else if(mapLocationUpdate.length===0){
            errorToast("Product map location Required !")
        }

        else {

            document.getElementById('update-modal-close').click();

            let formData=new FormData();
            formData.append('img',buildingImgUpdate)
            formData.append('id',updateID)
            formData.append('name',buildingNameUpdate)
            formData.append('discription',discriptionUpdate)
            formData.append('title',buildingTitleUpdate)
            formData.append('location',locationUpdate)
            formData.append('total_land',totalLandUpdate)
            formData.append('no_of_storied',noOstoriedUpdate)
            formData.append('total_owner',totalTowerUpdate)
            formData.append('map_location',mapLocationUpdate)
            formData.append('file_path',filePath)

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }

            showLoader();
            let res = await axios.post("/buildings-detail-update",formData,config)
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

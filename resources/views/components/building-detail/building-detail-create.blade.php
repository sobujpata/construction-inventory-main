<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Builing Details</h5>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label mt-2">Name</label>
                                <input type="text" class="form-control" id="buildingName" placeholder="Building name">

                                <label class="form-label mt-2">Title</label>
                                <input type="text" class="form-control" id="buildingTitle" placeholder="Title no">

                                <label class="form-label mt-2">Distription</label>
                                <input type="text" class="form-control" id="discription" placeholder="Distription No">

                                <label class="form-label mt-2">Location</label>
                                <input type="text" class="form-control" id="location" placeholder="Location">

                                <label class="form-label mt-2">Total Land</label>
                                <input type="text" class="form-control" id="totalLand" placeholder="totalLand">

                                <label class="form-label mt-2">No of Storied</label>
                                <input type="text" class="form-control" id="noOstoried" placeholder="noOstoried">

                                <label class="form-label mt-2">Total Tower</label>
                                <input type="text" class="form-control" id="totalTower" placeholder="Total Tower">

                                <label class="form-label mt-2">Map Location</label>
                                <input type="text" class="form-control" id="mapLocation" placeholder="Map Location">

                                <br/>
                                <img class="w-15" id="newImg" src="{{asset('images/default.jpg')}}"/>
                                <br/>

                                <label class="form-label">Image</label>
                                <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="buildingImage">

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

        let buildingName=document.getElementById('buildingName').value;
        let buildingTitle = document.getElementById('buildingTitle').value;
        let discription = document.getElementById('discription').value;
        let location = document.getElementById('location').value;
        let totalLand = document.getElementById('totalLand').value;
        let noOstoried = document.getElementById('noOstoried').value;
        let totalTower = document.getElementById('totalTower').value;
        let mapLocation = document.getElementById('mapLocation').value;
        let buildingImage = document.getElementById('buildingImage').files[0];

        if (buildingName.length === 0) {
            errorToast("Product Category Required !")
        }

        else if(buildingTitle.length===0){
            errorToast("Product Email No Required !")
        }
        else if(discription.length===0){
            errorToast("Product Mobile No Required !")
        }
        else if(location.length===0){
            errorToast("Product Address Required !")
        }
        else if(!buildingImage){
            errorToast("Product Image Required !")
        }

        else {

            document.getElementById('modal-close').click();

            let formData=new FormData();
            formData.append('img',buildingImage)
            formData.append('name',buildingName)
            formData.append('title',buildingTitle)
            formData.append('discription',discription)
            formData.append('location',location)
            formData.append('total_land',totalLand)
            formData.append('no_of_storied',noOstoried)
            formData.append('total_owner',totalTower)
            formData.append('map_location',mapLocation)

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }

            showLoader();
                let res = await axios.post("/building-detail-create",formData,config)
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

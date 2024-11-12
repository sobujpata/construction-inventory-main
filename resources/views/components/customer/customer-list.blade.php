<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-5">
            <div class="row justify-content-between ">
                <div class="align-items-center col">
                    <h4>Members</h4>
                </div>
                <div class="align-items-center col">
                    <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-end btn m-0 bg-gradient-primary">Create</button>
                </div>
            </div>
            <hr class="bg-dark "/>
            <table class="table" id="tableData">
                <thead>
                <tr class="bg-light">
                    <th>No</th>
                    <th>Profile</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Permanent Addr</th>
                    <th>Present Addr</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="tableList">

                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<script>

getList();


async function getList() {
    showLoader();
    let res=await axios.get("/list-customer");
    hideLoader();
    // console.log(res);
    let tableList=$("#tableList");
    let tableData=$("#tableData");

    tableData.DataTable().destroy();
    tableList.empty();

    res.data.forEach(function (item,index) {
        let row=`<tr>
                    <td>${index+1}</td>
                    <td ><img class="w-40 rounded" src="${item['image']}"></td>
                    <td>${item['name']}</td>
                    <td>${item['email']}</td>
                    <td>${item['mobile']}</td>
                    <td>${item['village']}, ${item['postal_code']}, ${item['union']['name']}, <br> ${item['upazila']['name']}, ${item['district']['name']}, ${item['division']['name']}</td>
                    <td>${item['present_address']}</td>
                    <td>
                        <button data-path="${item['image']}" data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success">Edit</button>
                        <button data-path="${item['image']}" data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                    </td>
                 </tr>`
        tableList.append(row)
    })

    $('.editBtn').on('click', async function () {
           let id= $(this).data('id');
           let filePath= $(this).data('path');
           await FillUpUpdateForm(id,filePath)
           $("#update-modal").modal('show');
    })

    $('.deleteBtn').on('click',function () {
        let id= $(this).data('id');
        let path= $(this).data('path');
        $("#delete-modal").modal('show');
        $("#deleteID").val(id);
        $("#deleteFilePath").val(path)
    })

    new DataTable('#tableData',{
        order:[[0,'desc']],
        lengthMenu:[15,20,30,100]
    });

}


</script>


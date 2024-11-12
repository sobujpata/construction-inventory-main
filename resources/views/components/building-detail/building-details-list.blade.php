<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-2 py-4">
                <div class="row justify-content-between ">
                    <div class="align-items-center col">
                        <h4>Owner List</h4>
                    </div>
                    <div class="align-items-center col">
                        <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-end btn m-0  bg-gradient-primary">Create</button>
                    </div>
                </div>
                <hr class="bg-dark "/>
                <table class="table" id="tableData">
                    <thead>
                    <tr class="bg-light">
                        <th>Image</th>
                        <th>Name</th>
                        <th>Title</th>
                        <th>Distcription</th>
                        <th>Location</th>
                        <th>Total Land</th>
                        <th>No of Storied</th>
                        <th>Total Tower</th>
                        <th>Map Location</th>
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
        let res=await axios.get("building-detail-list");
        hideLoader();

        // console.log(res);



        let tableList=$("#tableList");
        let tableData=$("#tableData");

        tableData.DataTable().destroy();
        tableList.empty();

        res.data.forEach(function (item,index) {

            const createdAt = new Date(item.created_at);
            const formattedDate = createdAt.toLocaleString('en-GB', {
                    timeZone: 'Asia/Dhaka',
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit',
                });

            let row=`<tr>
                        <td><img src="${item['image']}" alt="${item['name']} image" class="w-50 rounded"> </td>
                        <td>${item['name']}</td>
                        <td>${item['title']}</td>
                        <td>${item['discription']}</td>
                        <td>${item['location']}</td>
                        <td>${item['total_land']}</td>
                        <td>${item['no_of_storied']}</td>
                        <td>${item['total_owner']}</td>
                        <td>${item['map_location']}</td>
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
            // console.log(id)
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
            lengthMenu:[10,15,20,30]
        });

    }


</script>


 const customerTable = $('#customerTable');
const deleteCustomeForm = $('#deleteCustomeForm');

$(document).on('click','.btn-delete',function(){
    var id = $(this).data('id');
    var check =  confirm('are you sure to delete this customer');
    if(check == true){
      deleteCustomeForm.submit();
    }
});
 const optionsDateTime = {
  year: "numeric",
  month: "short",
  day: "numeric",
  hour: "2-digit",
  minute: "2-digit",
};

$(document).ready(function () {
 customerTable.DataTable({
    lengthMenu: [
      [10, 25, 50, -1],
      ["10", "25", "50", "All"]
    ],
    order: [
      [0, "desc"]
    ],
    language: {
      searchPlaceholder: "Search Customer",
    },
    processing: true,
    serverSide: true,
    ajax: {
      url: customerUrl,
      data: function (d) {
        d.status = "all";
      },
    },
    columns: [{
      data: "name",
      name: "name",
      render: function (data) {
        return data;
      },
    },
    {
      data: "user_name",
      name: "user_name",
      render: function (data) {
        return data;
      },
    },
    {
      data: "email",
      name: "email",
      render: function (data) {
        return data;
      },
    },
    {
      data: "created_at",
      name: "created_at",
      render: function (data) {
        return new Date(data).toLocaleDateString("en-US", optionsDateTime);
      },
    },
    {
      data: "is_active",
      name: "is_active",
      render: function (data) {

        if (data === 1) {
          return `<span class="badge badge-success">Active</span>`;
        } else {
          return `<span class="badge badge-danger">inactive</span>`;
        }
      },
    },
    {
      data: "id",
      name: "id",
      orderable: false,
      render: function (data) {
        return `<a class="btn-action-table btn btn-info btn-edit text-white" href="${customerEditUrl +data+'/edit'}" >Edit</a>
                    `;
      },
    },
    ],
  });
});
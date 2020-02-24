$(document).ready(function () {
    window.data = $('#data').DataTable({
        stateSave: true,
        serverSide: true,
        bLengthChange: false,
        displayStart: $('#page').val() === '' ? 0 : (Number($('#page').val()) - 1) * 10,
        columnDefs: [{targets: '_all', className: 'text-center'}],
        ajax: {
            url: '/departments/get_table_data',
            type: "POST",
        },
        columns: [
            {data: 'id'},
            {data: 'name'},
            {
                data: 'id',
                orderable: false,
                render: function(data, type, row) {
                        return  '<a href="/departments/edit/'+data+'">Edit</a><br>'+
                                '<a href="/departments/destroy/'+data+'">Dell</a>';
                },
            }
        ]
    });
});

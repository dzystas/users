$(document).ready(function () {
    window.data = $('#data').DataTable({
        stateSave: true,
        serverSide: true,
        bLengthChange: false,
        displayStart: $('#page').val() === '' ? 0 : (Number($('#page').val()) - 1) * 10,
        columnDefs: [{targets: '_all', className: 'text-center'}],
        ajax: {
            url: '/users/show/get_table_data',
            type: "POST",
        },
        columns: [
            {data: 'id'},
            {data: 'full_name'},
            {data: 'email'},
            {data: 'department_id',
                render: function(data, type, row) {
                    if (!$.isEmptyObject(row.department)) {
                        return row.department.name;
                    } else {
                        return '';
                    }
                },
            },
            {data: 'salary'},
            {
                data: 'hiring_time',
                render: function(data, type, row) {
                    if (!$.isEmptyObject(row.hiring_time)) {
                        return row.hiring_time;
                    } else {
                        return '';
                    }
                },
            },
            {
                data: 'avatar',
                orderable: false,
                render: function(data, type, row) {
                    if (!$.isEmptyObject(row.avatar)) {
                        return '<img src="http://test1.loc/storage/' + row.avatar + '" class="img-fluid" alt="Cinque Terre">';
                    } else {
                        return '';
                    }
                },
            },
        ]
    });
});

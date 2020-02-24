"use strict";
$(document).ready(function () {

    $("#tree").jstree({
        "core": {
            "themes": {
                "responsive": false
            },
            "check_callback": function (operation, node, parent) {
                if (operation === "copy_node" || operation === "move_node") {
                    if (parent.id === "#") {
                        return false; // prevent moving a child above or below the root
                    }
                    if (node.parent === "#") {
                        return false; // prevent moving
                    }
                };
                return true; // allow everything else
            },
            'data': {
                'url': function (node) {
                    return '/users/tree/get_data';
                },
                'data': function (node) {
                    return {'parent': node};
                }
            }
        },
        "types": {
            "default": {
                "icon": "socicon-coderwall"
            },
        },
        "contextmenu": {
            "items": function ($node) {
                return {
                    "Remove": {
                        "separator_before": false,
                        "separator_after": false,
                        "label": "Remove",
                        "action": function (obj) {
                            $('#tree').jstree('delete_node', $node);
                        }
                    }
                };
            }
        },
        'plugins':
            [
                "contextmenu",
                "dnd",
                "types",
                "unique",
                "conditionalselect"
            ]
    }).bind("move_node.jstree", function (e, data) {
        let old_positions = data.old_instance._model.data[data.old_parent].children;
        let new_positions = data.old_instance._model.data[data.parent].children
        $.get('/users/tree/update_position', {
            id: data.node.id,
            old_parent: data.old_parent,
            new_parent: data.parent,
            old_positions: old_positions,
            new_positions: new_positions
        }, function (response) {
            if (response.success) {
                alert('Success! ' + response.message);
            } else {
                alert('Error! ' + response.message);
            }

        });
        console.log("id №" + data.node.id + " c родителя " + data.old_parent + " в " + data.parent + " позиция " + data.position);

    });

    $('#tree').on('delete_node.jstree', function (e, data) {
        $.get('/users/tree/destroy',
            {
                'id': data.node.id,
            })
            .done(function (response) {
                if (!response.success) {
                    alert('Error! ' + response.message);
                    document.location.reload(true);
                }

            })
            .fail(function () {
                data.instance.refresh();
            });
    });

    $('#tree').on("changed.jstree", function (e, data) {
        if (data.node) {
            console.log("select id №" + data.node.id);
            $('#input').removeClass('kt-hidden');
            $('#id').html('Edit № ' + data.node.id);
            $('#title').html(data.node.text);
            $.get('/users/tree/get_user/' + data.node.id, {'id': data.node.id}, function (data) {
                $('input[name="id"]').val(data.user.id);
                $('input[name="full_name"]').val(data.user.full_name);
                $('input[name="email"]').val(data.user.email);
                $('input[name="salary"]').val(data.user.salary);
                $('select[name="department_id"]').val(data.user.department_id);
                $('input[name="hiring_time"]').val(data.user.hiring_time);
                $('input[name="image"]').val(null);
                if (data.user.avatar) {
                    $('#avatar-img').css({
                        "backgroundImage": "url(http://test1.loc/storage/" + data.user.avatar + ")",
                        "background-repeat": "no-repeat",
                        "background-size": "contain",
                        "padding-top": "100px"
                    });
                } else {
                    $('#avatar-img').removeAttr("style");
                }
            });
        }
    });

    $('#avatar').on('change', function (e) {
        let files = e.target.files;

        if (FileReader && files && files.length) {

            let fr = new FileReader();
            fr.onload = function () {
                $('#avatar-img').css({
                    "backgroundImage": "url(" + fr.result + ")",
                    "background-repeat": "no-repeat",
                    "background-size": "contain",
                    "padding-top": "100px"
                });
            };
            fr.readAsDataURL(files[0]);
        }
    });

    $('form').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            enctype: 'multipart/form-data',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success) {
                    alert('Success! ' + response.message);
                    document.location.reload(true);
                } else {
                    alert('Error! ' + response.message);
                }
            }
        }).fail(function (json) {
            var errors = [];
            $.each(JSON.parse(json.responseText).errors, function (e, obj) {
                errors.push(obj);
            });
            alert('Warning! ' + errors);
        });
    })


});

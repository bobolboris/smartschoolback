const addChildToTable = (child, cb, id) => {
    let tr = document.createElement('tr');
    let td = document.createElement('td');

    td.innerText = child['id'];
    tr.appendChild(td);

    td = document.createElement('td');
    td.innerText = `${child['surname']} ${child['name']} ${child['patronymic']}`;
    tr.appendChild(td);

    td = document.createElement('td');
    td.innerText = child['school_class']['name'];
    tr.appendChild(td);

    td = document.createElement('td');
    td.innerText = child['school_class']['school']['name'];
    tr.appendChild(td);

    td = document.createElement('td');

    let form = document.createElement('form');
    let input = document.createElement('input');
    form.id = "removeChildForm";

    input.type = 'hidden';
    input.value = $('meta[name="csrf-token"]').attr('content');
    input.name = '_token';
    form.appendChild(input);

    input = document.createElement('input');
    input.type = 'hidden';
    input.value = child['id'];
    input.name = 'child_id';
    form.appendChild(input);

    input = document.createElement('input');
    input.type = 'hidden';
    input.value = id;
    input.name = 'parent_id';
    form.appendChild(input);

    let button = document.createElement('button');
    button.type = 'submit';
    let iNode = document.createElement('i');
    iNode.className = "fas fa-trash-alt";
    button.appendChild(iNode);
    form.appendChild(button);

    form.tr = tr;

    td.appendChild(form);
    tr.appendChild(td);
    cb.append(tr);

    form.onsubmit = onChildRemoveFormSubmit;
};

const errorHandler = (jqXHR, textStatus, errorThrown) => {
    console.log(jqXHR);
    console.log(textStatus);
    console.log(errorThrown);
};

const onChildRemoveFormSubmit = (event) => {
    event.preventDefault();
    let form = $(event.target);

    $.ajax({
        url: '/admin/parents/removeChild',
        method: 'POST',
        data: form.serialize(),
        success: (response) => {
            if (!response) {
                console.log('error response is null');
                return;
            }
            if (response['ok'] !== true) {
                console.log(response['errors']);
                return;
            }

            event.target.remove();
        },
        error: errorHandler
    });
};

const onResetChildPopup = () => {
    $('#childIdSelect').val(-1);
    $('#fioChild').text('-');
    $('#schoolClassChild').text('-');
    $('#schoolChild').text('-');
};

function loadChildren(id) {
    let cb = $('#childBody');
    cb.empty();

    $.ajax({
        url: '/admin/parents/getChildren',
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            id: id
        },
        success: (response) => {
            if (!response) {
                console.log('error response is null');
                return;
            }
            if (response['ok'] !== true) {
                console.log(response['errors']);
                return;
            }
            if (response['data']['children'].length === 0) {
                return;
            }

            response['data']['children'].forEach((child) => {
                addChildToTable(child, cb, id);
            });

        },
        error: errorHandler
    });
}


document.addEventListener("DOMContentLoaded", function () {
    $('.show_popup').click(function (event) {
        let popup_id = $('#' + $(this).attr("rel"));
        $(popup_id).show();
        $('.overlay_popup').show();
        let id = event.target.getAttribute('parentId');
        $('#parent_id_input').value = id;
        loadChildren(id);
    });

    $('tr').click(function () {
        let fio = $(this).find(".fio").html();
        $('#fioPlaceDelPar').text(fio);

        // $('#fioPlaceEditPar').val(fio);
        $('#fioPlaceShowChildPar').text(fio);
        $('#fioPlaceEditPar').attr("placeholder", fio);
    });

    $('.overlay_popup').click(() => {
        $('.overlay_popup, .popup').hide();
    });

    $('.closePP').click(() => {
        onResetChildPopup();
        $('.overlay_popup, .popup').hide();
    });


    $('#displayParent').click(() => {
        $('.content').hide();
        $('.content-parent').show();
    });

    $('#displayChild').click(() => {
        $('.content').hide();
        $('.content-child').show();
    });

    $('#childIdSelect').change((event) => {
        let id = event.target.value;

        $.ajax({
            url: '/admin/children/getById',
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: id
            },
            success: (response) => {
                if (!response) {
                    console.log('error response is null');
                    return;
                }

                if (response['ok'] !== true) {
                    console.log(response['errors']);
                    return;
                }

                let child = response['data']['child'];

                $('#fioChild').text(`${child['surname']} ${child['name']} ${child['patronymic']}`);
                $('#schoolClassChild').text(child['school_class']['name']);
                $('#schoolChild').text(child['school_class']['school']['name']);

            },
            errors: errorHandler
        });
    });


    $('#srcp').submit((event) => {
        alert(111);
        event.preventDefault();
        // $.ajax({
        //     url: '/admin/parents/saveRelationsChildParent',
        //     method: 'POST',
        //     data: $('#saveRelationsChildParent').serialize(),
        //     success: (response) => {
        //         if (!response) {
        //             console.log('error response is null');
        //             return;
        //         }
        //
        //         if (response['ok'] !== true) {
        //             console.log(response['errors']);
        //             alert(response['errors']);
        //             return;
        //         }
        //
        //         addChildToTable(response['child'], $('#childBody'), $('#parent_id_input').value);
        //
        //     },
        //     errors: errorHandler
        // });
    });

});

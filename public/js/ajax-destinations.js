function animalOwner() {
    var string2;
    $('#animalowner').change(function(){
        string2 = document.getElementById("ticket_id").value;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            type:"GET",
            url: "/animalowner/" + string2,
            success: function (data) {
                console.log(data);
                document.getElementById("name").value = data[0].reporter_name;
                document.getElementById("telephone_number").value = data[0].telephone;
            }
        });
    });
}

$(document).ready(function() {

    var string;
    $('#knownAddress').change(function(){
        string = $('#knownAddress').val()
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            type:"GET",
            url: "/knownusers/" + string,
            success: function (data) {
                console.log(data);
                document.getElementById("postal_code").value = data[0].postal_code;
                document.getElementById("house_number").value = data[0].house_number;
                document.getElementById("address").value = data[0].address;
                document.getElementById("city").value = data[0].city;
                document.getElementById("township").value = data[0].township;
            }
        });
    });
});

$(document).ready(function() {

    $('a[data-confirm]').click(function(ev) {
        var href = $(this).attr('href');
        if (!$('#dataConfirmModal').length) {
            $('body').append('<div id="dataConfirmModal" class="modal" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">?</button><h3 id="dataConfirmLabel">Please Confirm</h3></div><div class="modal-body"></div><div class="modal-footer"><button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button><a class="btn btn-primary" id="dataConfirmOK">OK</a></div></div>');
        }
        $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
        $('#dataConfirmOK').attr('href', href);
        $('#dataConfirmModal').modal({show:true});
        return false;
    });
});


$(document).ready(function(){
    var url = "/destination";

    //display modal form for creating new task
    $('#btn-add-destination').click(function(){
        $('#btn-save').val("add");
        $('#destination').trigger("reset");
        $('#destination_modal').modal('show');
    });

    //delete task and remove it from list

    $('.delete-task').click(function(){

        var task_id = $(this).val();

        if(confirm("Bestemming verwijderen?")) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({

                type: "DELETE",
                url: url + '/' + task_id,
                success: function (data) {
                    console.log(data);
                    //location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
        else
        {
            return false;
        }
    });


    //create new task / update existing task
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault();

        var formData = {
            ticket_id: $('#ticket_id').val(),
            postal_code: $('#postal_code').val(),
            address: $('#address').val(),
            house_number: $('#house_number').val(),
            city: $('#city').val(),
            township: $('#township').val(),
            milage: $('#milage').val(),
        };

        //used to determine the http verb to use [add=POST], [update=PUT]
        var type = "POST"; //for creating new resource
        var my_url = url;

        console.log(formData);

        $.ajax({

            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                // console.log(data);

                if(document.getElementById('postal_code').value === '') {
                    jQuery('.alert.alert-danger.destination').show();
                    jQuery('.alert.alert-danger.destination').append('<p>Geen postcode ingevoerd</p>');
                }

                if(document.getElementById('house_number').value === '') {
                    jQuery('.alert.alert-danger.destination').show();
                    jQuery('.alert.alert-danger.destination').append('<p>Geen huisnummer ingevoerd</p>');
                }

                if(document.getElementById('address').value === '') {
                    jQuery('.alert.alert-danger.destination').show();
                    jQuery('.alert.alert-danger.destination').append('<p>Geen straatnaam ingevoerd</p>');
                }

                if(document.getElementById('city').value === '') {
                    jQuery('.alert.alert-danger.destination').show();
                    jQuery('.alert.alert-danger.destination').append('<p>Geen plaats ingevoerd</p>');
                }

                if(document.getElementById('milage').value === '') {
                    jQuery('.alert.alert-danger.destination').show();
                    jQuery('.alert.alert-danger.destination').append('<p>Geen kilometerstand ingevoerd</p>');
                    return false;
                }

                else {
                    location.reload();
                }

                // $('#myModal').modal('hide')
            },
            complete: function(data) {
                if(data.status == 'success') {
                    location.reload();
                    $('#myModal').modal('hide')
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});


$(document).ready(function(){
    var url = "/finances";

    //display modal form for creating new task
    $('#btn-add-payment').click(function(){
        // $('#btn-save-payment').val("add");
        // $('#finances').trigger("reset");
        $('#myModal-payment').modal('show');
    });

    //delete task and remove it from list

    $('.delete-task-payment').click(function(){

        var task_id = $(this).val();

        if(confirm("Betaling verwijderen?")) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                type: "DELETE",
                url: url + '/' + task_id,
                success: function (data) {
                    console.log(data);
                    location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
        else
        {
            return false;
        }
    });

    //create new task / update existing task
    $("#btn-save-payment").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault();

        var formData = {
            ticket_id: $('#ticket_id').val(),
            payment_invoice: $('#payment_invoice').val(),
            payment_gifts: $('#payment_gifts').val(),
            payment_method: $('#payment_method').val()
        }

        //used to determine the http verb to use [add=POST], [update=PUT]
        var type = "POST"; //for creating new resource
        var my_url = url;

        console.log(formData);

        $.ajax({
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {


                if(document.getElementById('payment_invoice').value === '' && document.getElementById('payment_gifts').value === '') {
                    jQuery('.alert.alert-danger.payment').show();
                    jQuery('.alert.alert-danger.payment').append('<p>Betaling niet ingevoerd</p>');
                }

                else {
                    location.reload();
                }

            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});

$(document).ready(function(){

    var url = "/owners";

    //display modal form for task editing
    $('.open-modal-owner').click(function(){
        var task_id = $(this).val();

        $.get(url + '/' + task_id, function (data) {
            //success data
            console.log(data);
            $('#task_id').val(data.owner_id);
            $('#ticket_id').val(data.ticket_id);
            $('#name').val(data.name);
            $('#telephone_number').val(data.telephone_number);
            $('#owner_postal_code').val(data.owner_postal_code);
            $('#owner_address').val(data.owner_address);
            $('#owner_house_number').val(data.owner_house_number);
            $('#owner_city').val(data.owner_city);
            $('#owner_township').val(data.owner_township);
            $('#btn-save-owner').val("update");

            $('#myModal-owner').modal('show');
        })
    });

    //display modal form for creating new task
    $('#btn-add-owner').click(function(){
        $('#btn-save-owner').val("add");
        $('#owner').trigger("reset");
        $('#myModal-owner').modal('show');
    });

    //delete task and remove it from list

    $('.delete-task-owner').click(function(){

        var task_id = $(this).val();

        if(confirm("Eigenaar verwijderen?")) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                type: "DELETE",
                url: url + '/' + task_id,
                success: function (data) {
                    console.log(data);
                    location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
        else
        {
            return false;
        }
    });

    //create new task / update existing task
    $("#btn-save-owner").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault();

        var formData = {
            ticket_id: $('#ticket_id').val(),
            name: $('#name').val(),
            telephone_number: $('#telephone_number').val(),
            owner_postal_code: $('#owner_postal_code').val(),
            owner_address: $('#owner_address').val(),
            owner_house_number: $('#owner_house_number').val(),
            owner_city: $('#owner_city').val(),
            owner_township: $('#owner_township').val(),
        }

        //used to determine the http verb to use [add=POST], [update=PUT]
        var type = "POST"; //for creating new resource
        var my_url = url;

        console.log(formData);

        $.ajax({
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);

                if(document.getElementById('name').value === '') {
                    jQuery('.alert.alert-danger.owner').show();
                    jQuery('.alert.alert-danger.owner').append('<p>Geen naam ingevoerd</p>');
                }

                if(document.getElementById('telephone_number').value === '') {
                    jQuery('.alert.alert-danger.owner').show();
                    jQuery('.alert.alert-danger.owner').append('<p>Geen telefoon ingevoerd</p>');
                }

                if(document.getElementById('owner_postal_code').value === '') {
                    jQuery('.alert.alert-danger.owner').show();
                    jQuery('.alert.alert-danger.owner').append('<p>Geen postcode ingevoerd</p>');
                }

                if(document.getElementById('owner_house_number').value === '') {
                    jQuery('.alert.alert-danger.owner').show();
                    jQuery('.alert.alert-danger.owner').append('<p>Geen huisnummer ingevoerd</p>');
                }

                if(document.getElementById('owner_address').value === '') {
                    jQuery('.alert.alert-danger.owner').show();
                    jQuery('.alert.alert-danger.owner').append('<p>Geen straatnaam ingevoerd</p>');
                }

                if(document.getElementById('owner_city').value === '') {
                    jQuery('.alert.alert-danger.owner').show();
                    jQuery('.alert.alert-danger.owner').append('<p>Geen plaats ingevoerd</p>');
                }

                else {
                    location.reload();
                }

            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});

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


 $(document).ready(function(){
                var url = "/destination";

                //display modal form for task editing
                $('.open-modal').click(function(){
                var task_id = $(this).val();

                $.get(url + '/' + task_id, function (data) {
                //success data
                console.log(data);
                $('#task_id').val(data.destination_id);
                $('#ticket_id').val(data.ticket_id);
                $('#postal_code').val(data.postal_code);
                $('#address').val(data.address);
                $('#house_number').val(data.house_number);
                $('#city').val(data.city);
                $('#township').val(data.township);
                $('#verhicle').val(data.verhicle);
                $('#milage').val(data.milage);
                $('#btn-save').val("update");

                $('#myModal').modal('show');
                })
                });

                //display modal form for creating new task
                $('#btn-add').click(function(){
                $('#btn-save').val("add");
                $('#destination').trigger("reset");
                $('#myModal').modal('show');
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
                    location.reload();
                    $("#destination" + task_id).remove();
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
                    verhicle: $('#verhicle').val(),
                    milage: $('#milage').val(),
                }

                //used to determine the http verb to use [add=POST], [update=PUT]
                var state = $('#btn-save').val();

                var type = "POST"; //for creating new resource
                var task_id = $('#task_id').val();
                var my_url = url;
                var formMessages = $('#messages');

                console.log(formData);

                $.ajax({

                type: type,
                url: my_url,
                data: formData,
                dataType: 'json',
                success: function (data) {
                console.log(data);

                $empty = $('#myModal').find("input").filter(function() {
                        return this.value === "";
                    });

                if($empty.length) {
                    jQuery.each(data.errors, function(key, data){
        		    jQuery('.alert-danger').show();
        		    jQuery('.alert-danger').append('<p>'+data+'</p>');
                        });
                }

                if (state == "add"){ //if user added a new record
                    $('#tasks-list').append(destination);
                }else{ //if user updated an existing record
                    $("#destination" + task_id).replaceWith( destination );
                }

                $('#destination').trigger("reset");

                // $('#myModal').modal('hide')
                },
                complete: function(data) {
                    if(data.status == 'success') {
                    location.reload();
                    $('#myModal-payment').modal('hide')
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

                //display modal form for task editing
                $('.open-modal-payment').click(function(){
                var task_id = $(this).val();

                $.get(url + '/' + task_id, function (data) {
                //success data
                console.log(data);
                $('#task_id').val(data.finances_id);
                $('#ticket_id').val(data.ticket_id);
                $('#payment_invoice').val(data.payment_invoice);
                $('#payment_gift').val(data.payment_gift);
                $('#payment_method').val(data.payment_method);
                $('#btn-save-payment').val("update");

                $('#myModal-payment').modal('show');
                })
                });

                //display modal form for creating new task
                $('#btn-add-payment').click(function(){
                $('#btn-save-payment').val("add");
                $('#finances').trigger("reset");
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
                        $("#finances" + task_id).remove();
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
                    payment_method: $('#payment_method').val(),
                }

                //used to determine the http verb to use [add=POST], [update=PUT]
                var state = $('#btn-save-payment').val();
                var type = "POST"; //for creating new resource
                var task_id = $('#task_id').val();
                var my_url = url;
                var append = (append === undefined ? false : true);

                console.log(formData);

                $.ajax({
                    type: type,
                    url: my_url,
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                    console.log(data);

                $empty = $('#myModal').find("input").filter(function() {
                        return this.value === "";
                    });

                if($empty.length) {
                    jQuery.each(data.errors, function(key, data){
        		    jQuery('.alert-danger').show();
        		    jQuery('.alert-danger').append('<p>'+data+'</p>');
                        });
                }

                if (state == "add"){ //if user added a new record
                    //
                }else { //if user updated an existing record

                    $("#finances" + task_id).replaceWith( finances );
                }
                    $('#finances').trigger("reset");
                },
                complete: function(data) {
                    if(data.status == 'success') {
                    location.reload();
                    $('#myModal-payment').modal('hide')
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
                        $("#owner" + task_id).remove();
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
                var state = $('#btn-save-owner').val();
                var type = "POST"; //for creating new resource
                var task_id = $('#task_id').val();
                var my_url = url;
                var append = (append === undefined ? false : true);

                console.log(formData);

                $.ajax({
                    type: type,
                    url: my_url,
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                    console.log(data);

                $empty = $('#myModal').find("input").filter(function() {
                        return this.value === "";
                    });

                if($empty.length) {
                    jQuery.each(data.errors, function(key, data){
        		    jQuery('.alert-danger').show();
        		    jQuery('.alert-danger').append('<p>'+data+'</p>');
                        });
                }

                if (state == "add"){ //if user added a new record
                    //$('#owner-list').append(owner);
                }else { //if user updated an existing record

                    $("#owner" + task_id).replaceWith( owner );
                }
                    $('#owner').trigger("reset");
                },
                complete: function(data) {
                    if(data.status == 'success') {
                        location.reload();
                        $('#myModal-owner').modal('hide')
                    }
                },
                    error: function (data) {
                    console.log('Error:', data);
                }
                });
                });
                });





